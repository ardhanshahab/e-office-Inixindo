<?php

namespace App\Http\Controllers;

use App\Models\Registrasi;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Peserta;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\RKM;
use Illuminate\Support\Facades\Auth;

class RegistrasiController extends Controller
{
    public function index()
    {

        return view('registrasi.index');
    }

    public function getRegistrasiall()
    {

        $registrasi = Registrasi::with('rkm', 'peserta.perusahaan', 'materi', 'karyawan', 'sales')->get();
        $jabatan = Auth::user()->jabatan;
        if ($jabatan == 'Sales'|| $jabatan == 'Adm Sales' || $jabatan == 'GM'|| $jabatan == 'SPV Sales'
        || $jabatan == 'Instruktur'|| $jabatan == 'Education Manager' || $jabatan == 'Office Manager'
        || $jabatan == 'Customer Care' || $jabatan == 'Customer Service'  || $jabatan == 'Admin Holding' || $jabatan == 'Finance & Accounting'
        || $jabatan == 'HRD' || $jabatan == 'Programmer' || $jabatan == 'Direktur Utama' || $jabatan == 'Direktur') {
            return response()->json([
                'success' => true,
                'message' => 'List Registrasi',
                'data' => $registrasi,
            ]);
        }else{
            return response()->json([
                'success' => true,
                'message' => 'List Registrasi',
                'data' => '',
            ]);
        }
    }

    /**
     * create
     *
     * @return View
     */
    public function create()
    {
        $countPeserta = Peserta::get()->count() + 1;

        return view('registrasi.create', compact('countPeserta'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        //validate form
        // dd($request->all());
        $rkms = RKM::where('id', $request->id_rkm)->where('perusahaan_key', $request->perusahaan_key)->first();
        $peserta = Peserta::where('id', $request->id_peserta)->first();
        $registrasi = Registrasi::where('id_peserta', $request->id_peserta)->where('id_rkm', $request->id_rkm)->first();
        // dd($rkms);
        if ($registrasi === null) {
            if ($peserta === null) {
                $peserta = Peserta::create([
                    'nama'            => $request->nama,
                    'jenis_kelamin'   => $request->jenis_kelamin,
                    'email'           => $request->email,
                    'no_hp'           => $request->no_hp,
                    'alamat'          => $request->alamat,
                    'perusahaan_key'  => $request->perusahaan_key,
                    'tanggal_lahir'   => $request->tanggal_lahir
                ]);
            }
            if ($rkms === null) {
                return redirect()->route('registrasi.index')->with(['error' => 'Mohon maaf peserta ini daftar dikelas yang salah!']);
            }
            if ($rkms->isi_pax === '0') {
                return redirect()->route('registrasi.index')->with(['error' => 'Mohon maaf kapasitas kelas sudah penuh!']);
            }else{
                Registrasi::create([
                    'id_rkm'        => $request->id_rkm,
                    'id_peserta'    => $peserta->id,
                    'id_materi'     => $rkms->materi_key,
                    'id_instruktur' => $rkms->instruktur_key,
                    'id_sales'      => $rkms->sales_key,
                ]);

                $rkms->update([
                    'isi_pax' => $rkms->isi_pax - 1,
                ]);
            }
        } else {
            return redirect()->route('registrasi.index')->with(['error' => 'Mohon maaf anda sudah mendaftar kelas ini!']);
        }

        return redirect()->route('registrasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        $post = Registrasi::findOrFail($id);

        return view('registrasi.show', compact('post'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $materis = Registrasi::findOrFail($id);

        return view('registrasi.edit', compact('materis'));
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
        $this->validate($request, [
            'id_rkm'     => 'required',
            'id_peserta'   => 'required',
            'id_materi'   => 'required',
        ]);

        $post = Registrasi::findOrFail($id);

            $post->update([
                'id_rkm'     => $request->id_rkm,
                'id_peserta'     => $request->id_peserta,
                'id_materi'     => $request->id_materi,

            ]);

        return redirect()->route('registrasi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        $post = Registrasi::findOrFail($id);

        $post->delete();

        return redirect()->route('registrasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
