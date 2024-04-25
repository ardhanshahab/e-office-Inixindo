<?php

namespace App\Http\Controllers;

use App\Models\Registrasi;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
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

    /**
     * create
     *
     * @return View
     */
    public function create()
    {

        return view('registrasi.create');
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
            'id_rkm'     => 'required',
            'id_peserta'   => 'required',
            'id_materi'   => 'required',
        ]);

        Registrasi::create([
            'id_rkm'     => $request->id_rkm,
            'id_peserta'     => $request->id_peserta,
            'id_materi'     => $request->id_materi,
        ]);

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
