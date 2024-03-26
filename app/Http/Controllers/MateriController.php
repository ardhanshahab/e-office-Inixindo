<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Materi;
class MateriController extends Controller
{
    public function index(): View
    {
        $materis = Materi::latest()->paginate(5);

        return view('materi.index', compact('materis'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('materi.create');
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
        $this->validate($request, [
            'nama_materi'     => 'required',
            'kategori_materi'   => 'required',
            'vendor'   => 'required'
        ]);

        Materi::create([
            'nama_materi'     => $request->nama_materi,
            'kategori_materi'     => $request->kategori_materi,
            'vendor'   => $request->vendor
        ]);

        return redirect()->route('materi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        $post = Materi::findOrFail($id);

        return view('materi.show', compact('post'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $materis = Materi::findOrFail($id);

        return view('materi.edit', compact('materis'));
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
            'nama_materi'     => 'required',
            'kategori_materi'   => 'required',
            'vendor'   => 'required'
        ]);

        $post = Materi::findOrFail($id);

            $post->update([
                'nama_materi'     => $request->nama_materi,
                'kategori_materi'     => $request->kategori_materi,
                'vendor'   => $request->vendor
            ]);

        return redirect()->route('materi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        $post = Materi::findOrFail($id);

        $post->delete();

        return redirect()->route('materi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
