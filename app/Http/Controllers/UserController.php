<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('user.index', compact('users'));
    }

    public function show($id)
    {
        $users = User::findOrFail($id);
        return view('user.show', compact('users'));
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('user.edit', compact('users'));
    }

    public function updateData(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $data = $request->validate([
            'name' => ['required'],
            'nip' =>  ['nullable','numeric'],
            'role'=>['required'],
            'alamat'=>['required'],
            'jabatan'=>['required'],
            'divisi'=>['required'],
            'tempat_lahir'=>['required'],
            'tanggal_lahir'=>['required'],
        ]);
        $users->update($data);
        return redirect('/user')->with('success', 'Data Berhasil Diubah');
    }

    public function updatePassword(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $data = $request->validate([
            'password' => ['required'],
            'confirm_password' => ['same:password']
        ]);
        if ($request->password != ""){
            $data['password']=Hash::make($request->password);
        }
        $users->update($data);
        return back()->with('success', 'Password Berhasil Diubah');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('/user')->with('success', 'User Berhasil Dihapus');
    }


}
