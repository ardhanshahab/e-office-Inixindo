<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::with('karyawan')->paginate(5);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        // $user = Karyawan::latest()->first();
        $user = User::max('id');

        $countuser = $user + 1;
        // dd($user);
        $jabatan = jabatan::all();

        return view('user.register', compact('countuser', 'jabatan'));
    }

    public function regist(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'divisi' => ['required', 'string', 'max:255'],
            'status_akun' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'karyawan_id' => ['required', 'string'],
            'kode_karyawan' => ['nullable', 'string'],
        ]);

        // dd($request->status_akun);
        try {
            $id_instruktur = $request->jabatan == 'Instruktur' ? $request->kode_karyawan : null;
            $id_sales = $request->jabatan == 'Sales' ? $request->kode_karyawan : null;

            // Gunakan ID dari users sebagai ID untuk karyawan
            $karyawanId = User::max('id') + 1;

            User::create([
                'username' => $request->username,
                'jabatan' => $request->jabatan,
                'status_akun' => '1',
                'karyawan_id' => $karyawanId, // Gunakan ID dari users sebagai ID untuk karyawan
                'password' => Hash::make($request->password),
                'id_instruktur' => $id_instruktur,
                'id_sales' => $id_sales,
            ]);

            Karyawan::create([
                'id' => $karyawanId, // Gunakan ID dari users sebagai ID untuk karyawan
                'nama_lengkap' => $request->nama_lengkap,
                'status_aktif' => '1',
                'jabatan' => $request->jabatan,
                'divisi' => $request->divisi,
                'kode_karyawan' => $request->kode_karyawan,
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
        $karyawan = karyawan::findOrFail($users->karyawan_id);
        // dd($users);
        $users->delete();
        $karyawan->delete();
        return redirect('/user')->with('success', 'User Berhasil Dihapus');
    }

    public function datas()
    {
        $users = User::with('karyawan')->get();
        return response()->json($users);
    }
}
