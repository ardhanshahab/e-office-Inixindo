<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Materi;
class MateriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        // Validate form
        // dd($request->all());
        $validatedData = $this->validate($request, [
            'nama_materi' => 'required',
            'kode_materi' => 'nullable',
            'kategori_materi' => 'nullable',
            'vendor' => 'nullable',
            'silabus' => 'nullable|file|mimes:pdf|max:2048' // tambahkan validasi untuk file PDF
        ]);

        $materi = new Materi([
            'nama_materi' => $validatedData['nama_materi'],
            'kode_materi' => $validatedData['kode_materi'],
            'kategori_materi' => $validatedData['kategori_materi'],
            'vendor' => $validatedData['vendor']
        ]);

        if ($request->hasFile('silabus')) {
            $file = $request->file('silabus');
            $filename = 'silabus_' . $validatedData['nama_materi'] . '.pdf';
            $path = $file->storeAs('silabus', $filename, 'public');

            $materi->silabus = $path;
        }

        $materi->save();

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
        // dd($request->all());
        $this->validate($request, [
            'nama_materi'     => 'required',
            'kode_materi'     => 'nullable',
            'kategori_materi' => 'required',
            'vendor'          => 'required',
            'silabus'         => 'nullable|file|mimes:pdf|max:2048' // tambahkan validasi untuk file PDF
        ]);

        $materi = Materi::findOrFail($id);
        // dd($materi);

        // Update attribut materi
        $materi->nama_materi = $request->nama_materi;
        $materi->kode_materi = $request->kode_materi;
        $materi->kategori_materi = $request->kategori_materi;
        $materi->vendor = $request->vendor;

        // Jika file silabus baru diunggah
        if ($request->hasFile('silabus')) {
            // Hapus file silabus lama jika ada
            if ($materi->silabus) {
                Storage::delete($materi->silabus);
            }

            $file = $request->file('silabus');
            $filename = 'silabus_' . $request->nama_materi . '.pdf';
            $path = $file->storeAs('silabus', $filename, 'public');
            $materi->silabus = $path;
        }

        // Simpan perubahan
        $materi->save();

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
