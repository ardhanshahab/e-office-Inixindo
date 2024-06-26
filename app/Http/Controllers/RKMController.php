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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view('rkm.index');

    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        // $sales = karyawan::where('jabatan', 'sales')->get();
        $sales = Karyawan::whereIn('jabatan', ['Sales', 'SPV Sales'])->get();
        $instruktur = Karyawan::whereIn('jabatan', ['Instruktur', 'Education Manager'])->get();
        $materi = Materi::get();
        $perusahaan = Perusahaan::get();
        return view('rkm.tambahrkm', compact('sales', 'materi', 'perusahaan', 'instruktur'));
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
            'harga_jual' => 'nullable',
            'pax' => 'nullable',
            'tanggal_awal' => 'nullable',
            'tanggal_akhir' => 'nullable',
            'metode_kelas' => 'nullable',
            'event' => 'nullable',
            'exam' => 'nullable',
            'authorize' => 'nullable',
            // 'ruang' => 'nullable',
            'status' => 'nullable',
        ]);
        $exam = $request->exam ? '1' : '0';
        $authorize = $request->authorize ? '1' : '0';

        RKM::create([
            'sales_key' => $request->sales_key,
            'materi_key' => $request->materi_key,
            'perusahaan_key' => $request->perusahaan_key,
            'harga_jual' => $request->harga_jual,
            'pax' => $request->pax,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'metode_kelas' => $request->metode_kelas,
            'event' => $request->event,
            'exam' => $exam,
            'authorize' => $authorize,
            'status' => $request->status,
            'isi_pax' => $request->pax,
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
        $array = explode('ixb', $id);
        $materi_key = $array[0];
        $bulans = $array[1];
        $tanggal_rkm = explode('ie', $bulans);
        $tahun = $tanggal_rkm[1];
        $bulan = str_pad($tanggal_rkm[2], 2, '0', STR_PAD_LEFT); // Menambahkan 0 di depan jika perlu
        $hari = str_pad($tanggal_rkm[0], 2, '0', STR_PAD_LEFT); // Menambahkan 0 di depan jika perlu
        $tanggal_awal = $tahun . '-' . $bulan . '-' . $hari;
        $params = $id;
        $rkm = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan', 'instruktur2', 'asisten'])
            ->where('materi_key', $materi_key)
            ->where('tanggal_awal', $tanggal_awal)
            ->get();
            // return $tanggal_awal;
            // dd($rkm);

            $datas = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan', 'comments'])->where('materi_key', $materi_key)->get();
            $ids = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])->where('materi_key', $materi_key)->firstOrFail();

            $comments = collect();
            foreach ($datas as $data) {
                $comments = $comments->merge($data->comments);
            }
        return view('rkm.show', compact('rkm', 'comments', 'ids', 'params', 'materi_key'));
    }

    public function edit(string $id)
    {
        // Get post by ID
        $post = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])->findOrFail($id);
        $sales = karyawan::where('jabatan', 'sales')->get();
        $instruktur = Karyawan::whereIn('jabatan', ['Instruktur', 'Education Manager'])->get();
        $materi = Materi::get();
        $perusahaan = Perusahaan::get();
        // return $post;
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

    public function editInstruktur($id)
    {
        // return $id;
        $karyawan = Karyawan::whereIn('jabatan', ['Instruktur', 'Education Manager'])->get();

        $array = explode('ixb', $id);
        $materi_key = $array[0];
        $bulans = $array[1];
        $tanggal_rkm = explode('ie', $bulans);
        $tahun = $tanggal_rkm[1];
        $bulan = str_pad($tanggal_rkm[2], 2, '0', STR_PAD_LEFT); // Menambahkan 0 di depan jika perlu
        $hari = str_pad($tanggal_rkm[0], 2, '0', STR_PAD_LEFT); // Menambahkan 0 di depan jika perlu
        $tanggal_awal = $tahun . '-' . $bulan . '-' . $hari;
        $params = $id;
        $rkm = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan', 'instruktur2', 'asisten'])
            ->where('materi_key', $materi_key)
            ->where('tanggal_awal', $tanggal_awal)
            ->firstOrFail();
        // return $rkm;

        return view('rkm.editinstruktur', compact('rkm', 'karyawan'));
    }
    public function updateInstruktur(Request $request)
    {

        // dd($request->all());
        $this->validate($request, [
            'instruktur_key' => 'required',
            'instruktur_key2' => 'nullable',
            'asisten_key' => 'nullable',
            'ruang' => 'nullable',
        ]);

        $materiKey = $request->materi_key;
        $tanggalAwal = $request->tanggal_awal;
        $ids = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan'])
        ->where('materi_key', $materiKey)
        ->where('tanggal_awal', $tanggalAwal)
        ->get();
        // return $ids;
        // $ids = $request->ids;

        foreach ($ids as $rkm) {
            $rkm = RKM::findOrFail($rkm->id);
            $rkm->update([
                'instruktur_key' => $request->instruktur_key,
                'instruktur_key2' => $request->instruktur_key2,
                'asisten_key' => $request->asisten_key,
                'ruang' => $request->ruang,
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
        // Validate form
        $this->validate($request, [
            'sales_key' => 'required',
            'materi_key' => 'nullable',
            'harga_jual' => 'nullable',
            'pax' => 'nullable',
            'tanggal_awal' => 'nullable',
            'tanggal_akhir' => 'nullable',
            'metode_kelas' => 'nullable',
            'event' => 'nullable',
            'ruang' => 'nullable',
            'exam' => 'nullable',
            'authorize' => 'nullable',
            'status' => 'nullable',
        ]);

        $post = RKM::findOrFail($id);

        $exam = $request->exam ? '1' : '0';
        $authorize = $request->authorize ? '1' : '0';

        $post->update([
            'sales_key' => $request->sales_key,
            'materi_key' => $request->materi_key,
            'harga_jual' => $request->harga_jual,
            'pax' => $request->pax,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'metode_kelas' => $request->metode_kelas,
            'event' => $request->event,
            'ruang' => $request->ruang,
            'exam' => $exam,
            'authorize' => $authorize,
            'status' => $request->status,
            'isi_pax' => $request->pax,
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
        // dd($id);
        $post = RKM::findOrFail($id);

        // Storage::delete('public/npwp/'. $post->foto_npwp);

        $post->delete();

        return redirect()->route('rkm.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}
