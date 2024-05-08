<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PesertaController extends Controller
{
    public function index()
    {
        // $post = Peserta::with('perusahaan')->all();
        $post = Peserta::with('perusahaan')->get();

        // return $post;
        return view('peserta.index', compact('post'));
    }

    public function getPesertaall()
    {
        // $registrasi = Registrasi::with('rkm', 'peserta.perusahaan', 'materi')->get();
        $peserta = Peserta::with('perusahaan')->get();

        $jabatan = Auth::user()->jabatan;
        if ($jabatan == 'Sales'|| $jabatan == 'Adm Sales' || $jabatan == 'GM'|| $jabatan == 'SPV Sales'
        || $jabatan == 'Instruktur'|| $jabatan == 'Education Manager' || $jabatan == 'Accounting'
        || $jabatan == 'Customer Care' || $jabatan == 'Customer Service' || $jabatan == 'Finance & Accounting'
        || $jabatan == 'HRD' || $jabatan == 'Programmer' || $jabatan == 'Direktur Utama' || $jabatan == 'Direktur') {
            return response()->json([
                'success' => true,
                'message' => 'List Registrasi',
                'data' => $peserta,
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
    public function create(): View
    {
        $perusahaans = Perusahaan::all();
        return view('peserta.create', compact('perusahaans'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        // dd($request->all());
        $this->validate($request, [
            'nama'     => 'required',
            'jenis_kelamin'   => 'required',
            'email'   => 'required',
            'no_hp'   => 'required',
            'alamat'   => 'nullable',
            'perusahaan_key'   => 'required',
            'tanggal_lahir'   => 'nullable',

        ]);

        Peserta::create([
            'nama'     => $request->nama,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'email'     => $request->email,
            'no_hp'     => $request->no_hp,
            'alamat'     => $request->alamat,
            'perusahaan_key'     => $request->perusahaan_key,
            'tanggal_lahir'   => $request->tanggal_lahir
        ]);

        return redirect()->route('peserta.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        $post = Peserta::findOrFail($id);

        return view('peserta.show', compact('post'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $materis = Peserta::findOrFail($id);

        return view('peserta.edit', compact('materis'));
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
            'nama'     => 'required',
            'jenis_kelamin'   => 'required',
            'email'   => 'required',
            'no_hp'   => 'required',
            'alamat'   => 'required',
            'perusahaan_key'   => 'required',
            'tanggal_lahir'   => 'required',
        ]);

        $post = Peserta::findOrFail($id);

            $post->update([
                'nama'     => $request->nama,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'email'     => $request->email,
                'no_hp'     => $request->no_hp,
                'alamat'     => $request->alamat,
                'perusahaan_key'     => $request->perusahaan_key,
                'tanggal_lahir'   => $request->tanggal_lahir
            ]);

        return redirect()->route('peserta.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        $post = Peserta::findOrFail($id);

        $post->delete();

        return redirect()->route('peserta.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
