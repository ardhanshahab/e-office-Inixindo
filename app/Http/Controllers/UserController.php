<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index()
    {
        $users = User::with('karyawan')->paginate(5);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $user = User::count();
        $countuser = $user + 1;

        return view('user.register', compact('countuser'));
    }

    public function regist(Request $request)
    {

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'status_akun' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'karyawan_id' => ['required', 'string'],
        ]);
        // dd($data);


        try {
            DB::beginTransaction();

            User::create([
                'username' => $data['username'],
                'jabatan' => $data['jabatan'],
                'status_akun' => $data['status_akun'],
                'karyawan_id' => $data['karyawan_id'],
                'password' => Hash::make($data['password']),
            ]);

            Karyawan::create([
                'nama_lengkap' => $data['nama_lengkap'],
                'status_aktif' => $data['status_akun'],
                'jabatan' => $data['jabatan'],
            ]);

            DB::commit();

            return redirect()->route('user.index')->with('success', 'Akun Karyawan telah Ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan akun karyawan. Silakan coba lagi. Error: ' . $e->getMessage());
        }

    }

    public function show($id)
    {
        $users = User::with('karyawan')->findOrFail($id);
        $json = response()->json($users);
        // dd($json);
        // return $json;
        return view('user.show', compact('users'));
    }

    public function editPassword($id)
    {
        $users = User::findOrFail($id);
        $karyawan = karyawan::findOrFail($id);

        return view('user.editpassword', compact('users', 'karyawan'));
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

    public function datas()
    {
        $users = User::with('karyawan')->get();
        return response()->json($users);
    }
}
