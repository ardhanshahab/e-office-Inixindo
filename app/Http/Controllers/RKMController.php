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
    public function index(): View
    {
        $now = CarbonImmutable::now()->locale('id_ID');
        $startOfMonth = $now->startOfMonth();
        $endOfMonth = $now->endOfMonth();
        $startOfYear = $now->startOfYear();
        $endOfYear = $now->endOfYear();

        $weekRanges = [];
        $date = $startOfMonth;

        // Tambahkan parameter bulan ke penambahan minggu
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
                ->whereBetween('tanggal_awal', [$weekRange['start'],  $weekRange['end']])
                ->whereBetween('tanggal_akhir', [$weekRange['start'],  $weekRange['end']])
                ->select('r_k_m_s.materi_key', 'r_k_m_s.ruang','r_k_m_s.metode_kelas','r_k_m_s.event',
                    DB::raw('GROUP_CONCAT(r_k_m_s.instruktur_key SEPARATOR ", ") AS instruktur_all'),
                    DB::raw('GROUP_CONCAT(r_k_m_s.perusahaan_key SEPARATOR ", ") AS perusahaan_all'),
                    DB::raw('GROUP_CONCAT(r_k_m_s.sales_key SEPARATOR ", ") AS sales_all'),
                    DB::raw('SUM(r_k_m_s.pax) AS total_pax'))
                ->groupBy('r_k_m_s.materi_key', 'r_k_m_s.ruang','r_k_m_s.metode_kelas','r_k_m_s.event')
                ->get();

            foreach ($rows as $row) {
                $instruktur_ids = explode(', ', $row->instruktur_all);
                $sales_ids = explode(', ', $row->sales_all);
                $perusahaan_ids = explode(', ', $row->perusahaan_all);

                $row->instruktur = Karyawan::whereIn('kode_karyawan', $instruktur_ids)->get();
                $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
                $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();
            }
            // dd($weekRange);
            $rkmsByWeek[] = ['weekRange' => $weekRange, 'rkms' => $rows];
        }

        $years = [];
        $date = CarbonImmutable::create(2010, 1, 1); // Mulai dari 1 Januari 2010

        while ($date->year <= 2030) { // Selama tahun tidak lebih dari 2030
            $years[] = $date->year;
            $date = $date->addYear(); // Tambah satu tahun
        }

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $now->month($i)->translatedFormat('F');
        }

        // dd($weekRanges);

        return view('rkm.index', compact('rkmsByWeek', 'months', 'years', 'now'));

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
            'instruktur_key' => 'nullable',
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
            'instruktur_key' => $request->instruktur_key,
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
    public function show(string $id): View
    {
        // Get post by ID
        $post = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])->findOrFail($id);

        // Get comments related to the post
        $comments = $post->comments;

        // Render view with post and comments
        return view('rkm.show', compact('post', 'comments'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $perusahaans = RKM::findOrFail($id);

        //render view with post
        return view('rkm.edit', compact('perusahaans'));
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
            'instruktur_key' => 'nullable',
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
                'instruktur_key' => $request->instruktur_key,
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

        Storage::delete('public/npwp/'. $post->foto_npwp);

        $post->delete();

        return redirect()->route('rkm.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}
