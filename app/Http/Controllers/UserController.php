<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
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

    public function editPassword($id)
    {
        $users = User::findOrFail($id);
        return view('user.editpassword', compact('users'));
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
        $data['tanggal_lahir'] = Carbon::createFromFormat('Y-m-d', $data['tanggal_lahir'])->format('Y-m-d');
        $users->update($data);
        return redirect('/profile/'. $id)->with('success', 'Data Berhasil Diubah');
    }

    public function updatePassword(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $data = $request->validate([
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['same:password']
        ]);
        if ($request->password != ""){
            $data['password']=Hash::make($request->password);
        }
        $users->update($data);
        return redirect('/profile/'. $id)->with('success', 'Password Berhasil Diubah');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('/user')->with('success', 'User Berhasil Dihapus');
    }
}
