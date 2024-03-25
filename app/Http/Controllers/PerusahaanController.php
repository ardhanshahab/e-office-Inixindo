<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Perusahaan;
use App\Models\User;

class PerusahaanController extends Controller
{
    public function index(): View
    {
        // $perusahaans = Perusahaan::latest()->paginate(25);
        $perusahaans = Perusahaan::with('karyawan')->paginate(25);


        return view('perusahaan.index', compact('perusahaans'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('perusahaan.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_perusahaan' => 'required',
            'kategori_perusahaan' => 'nullable',
            'lokasi' => 'nullable',
            'karyawan_key' => 'nullable',
            'status' => 'nullable',
            'npwp' => 'nullable',
            'alamat' => 'nullable',
            'cp' => 'nullable',
            'no_telp' => 'nullable',
            'foto_npwp' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        $filename = null;
        if ($request->hasFile('foto_npwp')) {
            $file = $request->file('foto_npwp');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->nama_perusahaan . '_npwp.' . $extension;
            $file->storeAs('public/npwp', $filename);
        }

        Perusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'kategori_perusahaan' => $request->kategori_perusahaan,
            'lokasi' => $request->lokasi,
            'karyawan_key' => $request->karyawan_key,
            'status' => $request->status,
            'npwp' => $request->npwp,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'cp' => $request->cp,
            'foto_npwp' => $filename,
        ]);

        return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $post = Perusahaan::findOrFail($id);

        //render view with post
        return view('perusahaan.show', compact('post'));
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
        $post = Perusahaan::findOrFail($id);

        //render view with post
        return view('perusahaan.edit', compact('post'));
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
            'nama_perusahaan' => 'required',
            'kategori_perusahaan' => 'nullable',
            'lokasi' => 'nullable',
            'karyawan_key' => 'nullable',
            'status' => 'nullable',
            'npwp' => 'nullable',
            'alamat' => 'nullable',
            'cp' => 'nullable',
            'no_telp' => 'nullable',
            'foto_npwp' => 'file|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        $post = Perusahaan::findOrFail($id);

        if ($request->hasFile('foto_npwp')) {

            $file = $request->file('foto_npwp');
            $filename = $request->nama_perusahaan . '_npwp.' . $file->getClientOriginalExtension();
            $file->storeAs('public/npwp', $filename);


            Storage::delete('public/npwp/'.$post->foto_npwp);

            //update post with new image
            $post->update([
                'nama_perusahaan' => $request->nama_perusahaan,
                'kategori_perusahaan' => $request->kategori_perusahaan,
                'lokasi' => $request->lokasi,
                'karyawan_key' => $request->karyawan_key,
                'status' => $request->status,
                'npwp' => $request->npwp,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'cp' => $request->cp,
                'foto_npwp' => $filename,
            ]);

        } else {
            $post->update([
                'nama_perusahaan' => $request->nama_perusahaan,
                'kategori_perusahaan' => $request->kategori_perusahaan,
                'lokasi' => $request->lokasi,
                'karyawan_key' => $request->karyawan_key,
                'status' => $request->status,
                'npwp' => $request->npwp,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'cp' => $request->cp,
            ]);
        }

        return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        $post = Perusahaan::findOrFail($id);

        Storage::delete('public/npwp/'. $post->foto_npwp);

        $post->delete();

        return redirect()->route('perusahaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function joinPerusahaanKaryawan()
    {
        $perusahaans = User::with('karyawan')->get();

        return $perusahaans;
    }
}
