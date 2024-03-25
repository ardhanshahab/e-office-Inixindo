<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    public function gantiFoto($id)
    {
        $users = karyawan::findOrFail($id);
        return view('karyawan.gantifoto', compact('users'));
    }

    public function edit($id)
    {
        $users = karyawan::findOrFail($id);
        return view('user.edit', compact('users'));
    }

    public function updateData(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $user = User::findOrFail($id);

        $data = $request->validate([
            'nama_lengkap' => ['required'],
            'nip' => ['nullable', 'numeric'],
            'jabatan' => ['required'],
            'divisi' => ['required'],
            'status_aktif' => ['required'],
        ]);

        $karyawan->jabatan = $data['jabatan'];
        $karyawan->update($request->all());

        $user->jabatan = $data['jabatan'];
        $user->save();

        if (Auth::user()->role == "Admin") {
            return redirect('/user')->with('success', 'Data Berhasil Diubah');
        } elseif (Auth::user()->role == "Admin" && Auth::user()->id == $user->id) {
            return redirect('/profile/' . $id)->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect('/profile/' . $id)->with('success', 'Data Berhasil Diubah');
        }
    }


    public function updateFoto(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'foto'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        $post = karyawan::findOrFail($id);

        if ($request->hasFile('foto')) {

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$post->image);

            //update post with new image
            $post->update([
                'foto'     => $image->hashName(),
            ]);

        } else {
            return redirect()->route('user.show', $id)->with(['error' => 'Foto Tidak Disimpan!']);
        }
        //redirect to index
        return redirect()->route('user.show', $id)->with(['success' => 'Foto Berhasil Disimpan!']);
    }
}
