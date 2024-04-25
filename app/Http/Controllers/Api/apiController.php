<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilaifeedback;
use App\Models\Materi;
use App\Models\Perusahaan;
use App\Models\Peserta;
use App\Models\Registrasi;
use App\Models\User;

class apiController extends Controller
{
    public function getFeedbacks()
    {
        $feedbacks = Nilaifeedback::with('regist', 'rkm')->get();

        $transformedFeedbacks = $feedbacks->map(function ($feedback) {
            return [
                'id_regist' => $feedback->id_regist,
                'id_rkm' => $feedback->id_rkm,
                'email' => $feedback->email,
                'materi' => round(($feedback->M1 + $feedback->M2 + $feedback->M3 + $feedback->M4) / 4, 1),
                'pelayanan' => round(($feedback->P1 + $feedback->P2 + $feedback->P3 + $feedback->P4 + $feedback->P5 + $feedback->P6 + $feedback->P7) / 7, 1),
                'fasilitas' => round(($feedback->F1 + $feedback->F2 + $feedback->F3 + $feedback->F4 + $feedback->F5) / 5, 1),
                'instruktur' => round(($feedback->I1 + $feedback->I2 + $feedback->I3 + $feedback->I4 + $feedback->I5 + $feedback->I6 + $feedback->I7 + $feedback->I8) / 8, 1),
                'instruktur2' => round(($feedback->I1b + $feedback->I2b + $feedback->I3b + $feedback->I4b + $feedback->I5b + $feedback->I6b + $feedback->I7b + $feedback->I8b) / 8, 1),
                'asisten' => round(($feedback->I1as + $feedback->I2as + $feedback->I3as + $feedback->I4as + $feedback->I5as + $feedback->I6as + $feedback->I7as + $feedback->I8as) / 8, 1),
                'umum1' => $feedback->U1,
                'umum2' => $feedback->U2,
                'regist' => [
                    'id' => $feedback->regist->id,
                    'nama' => $feedback->regist->peserta->nama, // contoh atribut yang ingin Anda tambahkan dari relasi regist
                    // tambahkan atribut lainnya yang Anda perlukan
                ],
                'rkm' => [
                    'id' => $feedback->rkm->id,
                    'nama_materi' => $feedback->rkm->materi->nama_materi, // contoh atribut yang ingin Anda tambahkan dari relasi rkm
                    // tambahkan atribut lainnya yang Anda perlukan
                ],
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'List Feedbacks',
            'data' => $transformedFeedbacks
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

    public function getPerusahaanall()
    {
        $perusahaan = Perusahaan::with('karyawan')->get();

        return response()->json([
            'success' => true,
            'message' => 'List perusahaan',
            'data' => $perusahaan
        ]);
    }

    public function getRegistrasiall()
    {
        $registrasi = Registrasi::with('rkm', 'peserta.perusahaan', 'materi')->get();

        return response()->json([
            'success' => true,
            'message' => 'List Registrasi',
            'data' => $registrasi,
        ]);
    }

    public function getPesertaall()
    {
        // $registrasi = Registrasi::with('rkm', 'peserta.perusahaan', 'materi')->get();
        $peserta = Peserta::with('perusahaan')->get();

        return response()->json([
            'success' => true,
            'message' => 'List perusahaan',
            'data' => $peserta,
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
}
