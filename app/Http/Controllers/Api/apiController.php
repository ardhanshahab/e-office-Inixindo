<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\jabatan;
use Illuminate\Http\Request;
use App\Models\Nilaifeedback;
use App\Models\Materi;
use App\Models\Perusahaan;
use App\Models\Peserta;
use App\Models\Registrasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class apiController extends Controller
{
    public function getFeedbacks()
    {
        $feedbacks = Nilaifeedback::with('rkm')->get();

        // $groupedFeedbacks = $feedbacks->groupBy('id_rkm');
        $groupedFeedbacks = $feedbacks->groupBy(function ($feedback) {
            return $feedback->rkm->materi->nama_materi . '/' . $feedback->rkm->tanggal_awal;
        });

        $averageFeedbacks = [];

        foreach ($groupedFeedbacks as $materi_key => $feedbackGroup) {
            $materi_key = $feedbackGroup->first()->rkm->materi_key;
            $nama_materi = $feedbackGroup->first()->rkm->materi->nama_materi;
            $instruktur_key = $feedbackGroup->first()->rkm->instruktur_key;
            $sales_key = $feedbackGroup->first()->rkm->sales_key;
            $tanggal_awal = Carbon::parse($feedbackGroup->first()->rkm->tanggal_awal);
            $bulan = $tanggal_awal->format('m');
            $tanggal_akhir = $feedbackGroup->first()->rkm->tanggal_akhir;
            $totalFeedbacks = $feedbackGroup->count();
            $totalM1 = $feedbackGroup->sum('M1');
            $totalM2 = $feedbackGroup->sum('M2');
            $totalM3 = $feedbackGroup->sum('M3');
            $totalM4 = $feedbackGroup->sum('M4');
            $totalP1 = $feedbackGroup->sum('P1');
            $totalP2 = $feedbackGroup->sum('P2');
            $totalP3 = $feedbackGroup->sum('P3');
            $totalP4 = $feedbackGroup->sum('P4');
            $totalP5 = $feedbackGroup->sum('P5');
            $totalP6 = $feedbackGroup->sum('P6');
            $totalP7 = $feedbackGroup->sum('P7');
            $totalF1 = $feedbackGroup->sum('F1');
            $totalF2 = $feedbackGroup->sum('F2');
            $totalF3 = $feedbackGroup->sum('F3');
            $totalF4 = $feedbackGroup->sum('F4');
            $totalF5 = $feedbackGroup->sum('F5');
            $totalI1 = $feedbackGroup->sum('I1');
            $totalI2 = $feedbackGroup->sum('I2');
            $totalI3 = $feedbackGroup->sum('I3');
            $totalI4 = $feedbackGroup->sum('I4');
            $totalI5 = $feedbackGroup->sum('I5');
            $totalI6 = $feedbackGroup->sum('I6');
            $totalI7 = $feedbackGroup->sum('I7');
            $totalI8 = $feedbackGroup->sum('I8');
            $totalI1b = $feedbackGroup->sum('I1b');
            $totalI2b = $feedbackGroup->sum('I2b');
            $totalI3b = $feedbackGroup->sum('I3b');
            $totalI4b = $feedbackGroup->sum('I4b');
            $totalI5b = $feedbackGroup->sum('I5b');
            $totalI6b = $feedbackGroup->sum('I6b');
            $totalI7b = $feedbackGroup->sum('I7b');
            $totalI8b = $feedbackGroup->sum('I8b');
            $totalI1as = $feedbackGroup->sum('I1as');
            $totalI2as = $feedbackGroup->sum('I2as');
            $totalI3as = $feedbackGroup->sum('I3as');
            $totalI4as = $feedbackGroup->sum('I4as');
            $totalI5as = $feedbackGroup->sum('I5as');
            $totalI6as = $feedbackGroup->sum('I6as');
            $totalI7as = $feedbackGroup->sum('I7as');
            $totalI8as = $feedbackGroup->sum('I8as');


            $averageFeedbacks[] = [
                'nama_materi' => $nama_materi,
                'materi_key' => $materi_key,
                'instruktur_key' => $instruktur_key,
                'bulan' => $bulan,
                'sales_key' => $sales_key,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' => $tanggal_akhir,
                'averageM1' => $totalM1 / $totalFeedbacks,
                'averageM2' => $totalM2 / $totalFeedbacks,
                'averageM3' => $totalM3 / $totalFeedbacks,
                'averageM4' => $totalM4 / $totalFeedbacks,
                'averageP1' => $totalP1 / $totalFeedbacks,
                'averageP2' => $totalP2 / $totalFeedbacks,
                'averageP3' => $totalP3 / $totalFeedbacks,
                'averageP4' => $totalP4 / $totalFeedbacks,
                'averageP5' => $totalP5 / $totalFeedbacks,
                'averageP6' => $totalP6 / $totalFeedbacks,
                'averageP7' => $totalP7 / $totalFeedbacks,
                'averageF1' => $totalF1 / $totalFeedbacks,
                'averageF2' => $totalF2 / $totalFeedbacks,
                'averageF3' => $totalF3 / $totalFeedbacks,
                'averageF4' => $totalF4 / $totalFeedbacks,
                'averageF5' => $totalF5 / $totalFeedbacks,
                'averageI1' => $totalI1 / $totalFeedbacks,
                'averageI2' => $totalI2 / $totalFeedbacks,
                'averageI3' => $totalI3 / $totalFeedbacks,
                'averageI4' => $totalI4 / $totalFeedbacks,
                'averageI5' => $totalI5 / $totalFeedbacks,
                'averageI6' => $totalI6 / $totalFeedbacks,
                'averageI7' => $totalI7 / $totalFeedbacks,
                'averageI8' => $totalI8 / $totalFeedbacks,
                'averageI1b' => $totalI1b / $totalFeedbacks,
                'averageI2b' => $totalI2b / $totalFeedbacks,
                'averageI3b' => $totalI3b / $totalFeedbacks,
                'averageI4b' => $totalI4b / $totalFeedbacks,
                'averageI5b' => $totalI5b / $totalFeedbacks,
                'averageI6b' => $totalI6b / $totalFeedbacks,
                'averageI7b' => $totalI7b / $totalFeedbacks,
                'averageI8b' => $totalI8b / $totalFeedbacks,
                'averageI1as' => $totalI1as / $totalFeedbacks,
                'averageI2as' => $totalI2as / $totalFeedbacks,
                'averageI3as' => $totalI3as / $totalFeedbacks,
                'averageI4as' => $totalI4as / $totalFeedbacks,
                'averageI5as' => $totalI5as / $totalFeedbacks,
                'averageI6as' => $totalI6as / $totalFeedbacks,
                'averageI7as' => $totalI7as / $totalFeedbacks,
                'averageI8as' => $totalI8as / $totalFeedbacks,
                'averageM' => round(($totalM1 + $totalM2 + $totalM3 + $totalM4) / ($totalFeedbacks * 4), 1),
                'averageP' => round(($totalP1 + $totalP2 + $totalP3 + $totalP4 + $totalP5 + $totalP6 + $totalP7) / ($totalFeedbacks * 7), 1),
                'averageF' => round(($totalF1 + $totalF2 + $totalF3 + $totalF4 + $totalF5) / ($totalFeedbacks * 5), 1),
                'averageI' => round(($totalI1 + $totalI2 + $totalI3 + $totalI4 + $totalI5 + $totalI6 + $totalI7 + $totalI8) / ($totalFeedbacks * 8), 1),
                'averageIb' => round(($totalI1b + $totalI2b + $totalI3b + $totalI4b + $totalI5b + $totalI6b + $totalI7b + $totalI8b) / ($totalFeedbacks * 8), 1),
                'averageIas' => round(($totalI1as + $totalI2as + $totalI3as + $totalI4as + $totalI5as + $totalI6as + $totalI7as + $totalI8as) / ($totalFeedbacks * 8), 1),
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'List Feedbacks',
            'data' => $averageFeedbacks
            // 'data' => $groupedFeedbacks
        ]);

    }

    public function getMateri()
    {
        $materi = Materi::all();

        return response()->json([
            'success' => true,
            'message' => 'List Materi',
            'data' => $materi
        ]);
    }

    public function getMateris(){
        $perusahaans = Materi::where('nama_materi', 'LIKE', '%'.request('q').'%')->paginate(20);
        return response()->json($perusahaans);
    }



    public function getJabatan()
    {
        $materi = jabatan::all();

        return response()->json([
            'success' => true,
            'message' => 'List Jabatan',
            'data' => $materi
        ]);
    }

    public function getPerusahaanall()
    {
        $perusahaan = Perusahaan::with('karyawan')->get();

        return response()->json([
            'success' => true,
            'message' => 'List perusahaan',
            'data' => $perusahaan
        ]);
    }


    public function getUserall()
    {
        // $registrasi = Registrasi::with('rkm', 'peserta.perusahaan', 'materi')->get();
        $user = User::with('karyawan')->get();

        return response()->json([
            'success' => true,
            'message' => 'List perusahaan',
            'data' => $user,
        ]);
    }
    public function getRegistrasi(Request $request)
    {
        $id_rkm = $request->id_rkm;
        // $registrasi = Registrasi::with('rkm', 'peserta.perusahaan', 'materi')->get();
        $user = Registrasi::with('peserta')->where('id_rkm', $id_rkm)->get();

        return response()->json([
            'data' => $user
        ]);

    }
}
