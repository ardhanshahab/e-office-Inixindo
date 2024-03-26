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
use App\Models\User;
use Carbon\CarbonImmutable;

class RKMController extends Controller
{
    public function index(): View
    {
            $now = CarbonImmutable::now()->locale('id_ID');
            $startOfMonth = $now->startOfMonth();
            $endOfMonth = $now->endOfMonth();

            $weekRanges = [];
            $date = $startOfMonth;

            while ($date->lte($endOfMonth)) {
                $startOfWeek = $date->startOfWeek()->format('Y-m-d');
                $endOfWeek = $date->endOfWeek()->format('Y-m-d');
                $weekRanges[] = ['start' => $startOfWeek, 'end' => $endOfWeek];

                $date = $date->addWeek();
            }

            $json = json_encode($weekRanges, JSON_PRETTY_PRINT);

            $rkmsByWeek = [];
            foreach ($weekRanges as $weekRange) {
                $rkms = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])
                    ->whereBetween('tanggal_awal', [$weekRange['start'], $weekRange['end']])
                    ->get();

                $rkmsByWeek[] = ['weekRange' => $weekRange, 'rkms' => $rkms];
            }

            return view('rkm.index', compact('rkmsByWeek', 'json'));
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
        //get post by ID
        $post = RKM::findOrFail($id);

        //render view with post
        return view('rkm.show', compact('post'));
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
