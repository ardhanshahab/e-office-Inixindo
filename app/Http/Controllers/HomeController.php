<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RKM;
use App\Models\Registrasi;
use App\Models\notif;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $now = Carbon::now();
            $startOfWeek = $now->startOfWeek()->toDateString(); // Mengambil tanggal awal minggu ini
            $endOfWeek = $now->endOfWeek()->toDateString();
            $idInstruktur = auth()->user()->id_instruktur;
            $totalkaryawan = User::count();
            $kelasmingguini = RKM::where('instruktur_key', $idInstruktur)
            ->whereBetween('tanggal_awal', [$startOfWeek, $endOfWeek])
            ->count();
            $jumlahmengajar1 = RKM::where('instruktur_key', $idInstruktur)->count();
            $jumlahmengajar2 = RKM::where('instruktur_key2', $idInstruktur)->count();
            $jumlahmengajar = $jumlahmengajar1 + $jumlahmengajar2;
            $pesertaanda = Registrasi::with('rkm', 'peserta.perusahaan', 'materi')
            ->whereHas('rkm', function ($query) use ($idInstruktur) {
                $query->where('instruktur_key', $idInstruktur);
            })
            ->count();
            $kelasmingguini1 = RKM::where('instruktur_key', $idInstruktur)->whereBetween('tanggal_awal', [$startOfWeek, $endOfWeek])
            ->count();
            $kelasmingguini2 = RKM::where('instruktur_key', $idInstruktur)->whereBetween('tanggal_awal', [$startOfWeek, $endOfWeek])
            ->count();
            $kelasmingguini = $kelasmingguini1 + $kelasmingguini2;
            $runningclass = RKM::whereBetween('tanggal_awal', [$startOfWeek, $endOfWeek])
            ->count();
            // dd($kelasmingguini);
            $karyawanaktif = User::where('status_akun', '1')->count();
            // return $kelasmingguini;
            $pesertaaktif = Registrasi::all()->count();

            $startDate = Carbon::now()->startOfWeek(); // Mengambil tanggal awal minggu ini
            $endDate = Carbon::now()->endOfWeek(); // Mengambil tanggal akhir minggu ini
            $notifikasi = notif::with('users')
            ->whereBetween('tanggal_awal', [$startDate, $endDate])
            ->whereBetween('tanggal_akhir', [$startDate, $endDate])
            ->get();


            return view('newhome', compact(
                'totalkaryawan',
                'karyawanaktif',
                'jumlahmengajar',
                'pesertaanda',
                'runningclass',
                'kelasmingguini',
                'pesertaaktif',
                'notifikasi'
                ));

    }

}
