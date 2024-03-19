<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('user.index', compact('users'));
    }

    public function show($id)
    {
        $users = User::with('karyawan')->findOrFail($id);
        $json = response()->json($users);
        // dd($json);
        // return $json;
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
        if (Auth::User()->role == "Admin"){
            return redirect('/user')->with('success', 'Data Berhasil Diubah');
        }
        elseif (Auth::User()->role == "Admin" &&  Auth::User()->id = $users->id){
            return redirect('/profile/'. $id)->with('success', 'Data Berhasil Diubah');
        }
        else{
        return redirect('/profile/'. $id)->with('success', 'Data Berhasil Diubah');

        }
    }

    public function updatePassword(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $data = $request->validate([
            'expassword' => ['required', 'min:8'],
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);

        if(password_verify($data['expassword'], $users->password)) {
            $data[ 'password']= Hash::make($data['password']);
            unset ($data['expassword']);
            $users->update($data);
        }else{
            return back()->with('error', 'Password Lama Anda Salah');
            // $test = 'gagal';
            // dd($data['password'],$data['password_confirmation']);
            // dd($test);
        }

        // dd($users->update($data));
        return redirect('/profile/'. $id)->with('success', 'Password Berhasil Diubah');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('/user')->with('success', 'User Berhasil Dihapus');
    }
}
