<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\Materi;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\RKM;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\CarbonImmutable;

class RKMController extends Controller
{
    public function index()
    {
        $startDate = CarbonImmutable::create(2020, 1, 1);
        $endDate = CarbonImmutable::create(2030, 12, 31);
        $now = CarbonImmutable::now()->locale('id_ID');

        $monthRanges = [];
        $date = $startDate;

        while ($date->month <= $endDate->month && $date->year <= $endDate->year) {
            $startOfMonth = $date->startOfMonth();
            $endOfMonth = $date->endOfMonth();

            $weekRanges = [];
            $startOfWeek = $startOfMonth->startOfWeek();
            while ($startOfWeek->lte($endOfMonth)) {
                $endOfWeek = $startOfWeek->copy()->endOfWeek();
                $weekRanges[] = ['start' => $startOfWeek->format('Y-m-d'), 'end' => $endOfWeek->format('Y-m-d')];
                $startOfWeek = $startOfWeek->addWeek();
            }

            $monthRanges[] = ['month' => $startOfMonth->translatedFormat('F-Y'), 'weeks' => $weekRanges];

            $date = $date->addMonth();
        }

        $years = [];
        $date = CarbonImmutable::create(2010, 1, 1); // Start from January 1, 2010

        while ($date->year <= 2030) { // Until the year 2030
            $years[] = $date->year;
            $date = $date->addYear(); // Add one year
        }

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $now->month($i)->translatedFormat('F');
        }

        $weekRanges = [];
        $date = $now->startOfMonth();

        while ($date->lte($endOfMonth) && $date->month == $now->month) {
            $startOfWeek = $date->startOfWeek()->format('Y-m-d');
            $endOfWeek = $date->endOfWeek()->format('Y-m-d');
            $weekRanges[] = ['start' => $startOfWeek, 'end' => $endOfWeek];

            $date = $date->addWeek();
        }

        $rkmsByWeek = [];
        foreach ($weekRanges as $weekRange) {
            $rows = RKM::with(['materi'])
            ->join('materis', 'r_k_m_s.materi_key', '=', 'materis.id')
            ->whereBetween('tanggal_awal', [$weekRange['start'], $weekRange['end']])
            ->whereBetween('tanggal_akhir', [$weekRange['start'], $weekRange['end']])
            ->select(
                'r_k_m_s.materi_key',
                'r_k_m_s.ruang',
                'r_k_m_s.metode_kelas',
                'r_k_m_s.event',
                'r_k_m_s.tanggal_awal',
                DB::raw('GROUP_CONCAT(r_k_m_s.instruktur_key SEPARATOR ", ") AS instruktur_all'),
                DB::raw('GROUP_CONCAT(r_k_m_s.perusahaan_key SEPARATOR ", ") AS perusahaan_all'),
                DB::raw('GROUP_CONCAT(r_k_m_s.sales_key SEPARATOR ", ") AS sales_all'),
                DB::raw('GROUP_CONCAT(DISTINCT r_k_m_s.status ORDER BY r_k_m_s.status SEPARATOR ", ") AS status_all'),
                DB::raw('SUM(r_k_m_s.pax) AS total_pax')
            )
            ->groupBy('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal')
            ->get();

                foreach ($rows as $row) {
                    if ($row->instruktur_all == null){
                        $sales_ids = explode(', ', $row->sales_all);
                        $perusahaan_ids = explode(', ', $row->perusahaan_all);
                        $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
                        $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();

                    }else{
                        $sales_ids = explode(', ', $row->sales_all);
                        $perusahaan_ids = explode(', ', $row->perusahaan_all);
                        $instruktur_ids = explode(', ', $row->instruktur_all);
                        $row->instruktur = Karyawan::whereIn('kode_karyawan', $instruktur_ids)->get();
                        $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
                        $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();
                    }
                    $statuses = RKM::join('materis', 'r_k_m_s.materi_key', '=', 'materis.id')
                    ->whereBetween('tanggal_awal', [$weekRange['start'], $weekRange['end']])
                    ->whereBetween('tanggal_akhir', [$weekRange['start'], $weekRange['end']])
                    ->select('r_k_m_s.status')
                    ->distinct()
                    ->orderBy('r_k_m_s.status')
                    ->get();
            }
            $rkmsByWeek[] = ['weekRange' => $weekRange, 'rkms' => $rows, 'status' => $statuses];
        }

        $json = $monthRanges;
        // return $monthRanges;

        return view('rkm.index', compact('monthRanges', 'now', 'years', 'months', 'rkmsByWeek'));

    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $sales = karyawan::where('jabatan', 'sales')->get();
        $instruktur = Karyawan::whereIn('jabatan', ['Instruktur', 'Education Manager'])->get();
        $materi = Materi::get();
        $perusahaan = Perusahaan::get();
        return view('rkm.create', compact('sales', 'materi', 'perusahaan', 'instruktur'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $this->validate($request, [
            'sales_key' => 'required',
            'materi_key' => 'nullable',
            'perusahaan_key' => 'nullable',
            'pax' => 'nullable',
            'tanggal_awal' => 'nullable',
            'tanggal_akhir' => 'nullable',
            'metode_kelas' => 'nullable',
            'event' => 'nullable',
            'ruang' => 'nullable',
            'status' => 'nullable',
        ]);

        RKM::create([
            'sales_key' => $request->sales_key,
            'materi_key' => $request->materi_key,
            'perusahaan_key' => $request->perusahaan_key,
            'pax' => $request->pax,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'metode_kelas' => $request->metode_kelas,
            'event' => $request->event,
            'ruang' => $request->ruang,
            'status' => $request->status,
        ]);

        return redirect()->route('rkm.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }



    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id)
    {
        $rkm = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan', 'instruktur2', 'asisten'])
            ->where('materi_key', $id)
            ->where('tanggal_awal', '=', function ($query) use ($id) {
                $query->select('tanggal_awal')
                    ->from('r_k_m_s')
                    ->where('materi_key', $id)
                    ->groupBy('tanggal_awal')
                    ->havingRaw('COUNT(tanggal_awal) > 1');
            })
            ->get();

            // return $rkm;

            $id = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])->where('materi_key', $id)->firstOrFail();
            $datas = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])->where('materi_key', $id)->get();

            $comments = $id->comments;

        // return $comments;
        // return $id;

        return view('rkm.show', compact('rkm', 'id', 'comments'));
    }

    public function edit(string $id)
    {
        // Get post by ID
        $post = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])->findOrFail($id);
        $sales = karyawan::where('jabatan', 'sales')->get();
        $instruktur = Karyawan::whereIn('jabatan', ['Instruktur', 'Education Manager'])->get();
        $materi = Materi::get();
        $perusahaan = Perusahaan::get();
        return view('rkm.edit', compact('post', 'sales', 'materi', 'perusahaan', 'instruktur'));
    }
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function editRKM(): View
    {
        //get post by ID
        $rkm = RKM::with('materi')->get();
        $sales = karyawan::where('jabatan', 'sales')->get();
        $instruktur = Karyawan::whereIn('jabatan', ['Instruktur', 'Education Manager'])->get();
        $materi = Materi::get();
        $perusahaan = Perusahaan::get();

        //render view with post
        return view('rkm.edit', compact('rkm', 'sales', 'materi', 'perusahaan', 'instruktur'));
    }
    public function updateRKM(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'rkm_key' => 'required',
            'sales_key' => 'required',
            'materi_key' => 'nullable',
            'pax' => 'nullable',
            'tanggal_awal' => 'nullable',
            'tanggal_akhir' => 'nullable',
            'metode_kelas' => 'nullable',
            'event' => 'nullable',
            'ruang' => 'nullable',
            // 'instruktur_key' => 'nullable',
            'status' => 'nullable',
        ]);

        $post = RKM::findOrFail($request->rkm_key);


            $post->update([
                'sales_key' => $request->sales_key,
                'materi_key' => $request->materi_key,
                'pax' => $request->pax,
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir,
                'metode_kelas' => $request->metode_kelas,
                'event' => $request->event,
                'ruang' => $request->ruang,
                // 'instruktur_key' => $request->instruktur_key,
                'status' => $request->status,
            ]);

        return redirect()->route('rkm.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function editInstruktur($id)
    {
        $karyawan = Karyawan::whereIn('jabatan', ['Instruktur', 'Education Manager'])->get();
        $rkm = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])->where('materi_key', $id)->firstOrFail();
        $allRKM = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])
            ->select('id') // Memilih kolom id
            ->where('materi_key', $id)
            ->get();
        $ids = $allRKM->pluck('id'); // Mengambil nilai id dari hasil query
        // return $ids;

        return view('rkm.editinstruktur', compact('rkm', 'karyawan', 'ids'));
    }
    public function updateInstruktur(Request $request)
    {
        $this->validate($request, [
            'instruktur_key' => 'required',
            'instruktur_key2' => 'required',
            'asisten_key' => 'nullable',
        ]);

        $ids = $request->ids;

        foreach ($ids as $id) {
            $rkm = RKM::findOrFail($id);
            $rkm->update([
                'instruktur_key' => $request->instruktur_key,
                'instruktur_key2' => $request->instruktur_key2,
                'asisten_key' => $request->asisten_key,
            ]);
        }

        return redirect()->route('rkm.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'sales_key' => 'required',
            'materi_key' => 'nullable',
            'pax' => 'nullable',
            'tanggal_awal' => 'nullable',
            'tanggal_akhir' => 'nullable',
            'metode_kelas' => 'nullable',
            'event' => 'nullable',
            'ruang' => 'nullable',
            // 'instruktur_key' => 'nullable',
            'status' => 'nullable',
        ]);

        $post = RKM::findOrFail($id);


            $post->update([
                'sales_key' => $request->sales_key,
                'materi_key' => $request->materi_key,
                'pax' => $request->pax,
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir,
                'metode_kelas' => $request->metode_kelas,
                'event' => $request->event,
                'ruang' => $request->ruang,
                // 'instruktur_key' => $request->instruktur_key,
                'status' => $request->status,
            ]);

        return redirect()->route('rkm.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        $post = RKM::findOrFail($id);

        // Storage::delete('public/npwp/'. $post->foto_npwp);

        $post->delete();

        return redirect()->route('rkm.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}
