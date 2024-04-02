<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\CarbonImmutable;
use App\Models\RKM;
use Illuminate\Support\Facades\DB;
use App\Models\karyawan;
use App\Models\Materi;
use App\Models\Perusahaan;

class TestController extends Controller
{
    public function index()
    {
        // $startDate = CarbonImmutable::create(2020, 1, 1);
        // $endDate = CarbonImmutable::create(2030, 12, 31);
        // $now = CarbonImmutable::now()->locale('id_ID');

        // $monthRanges = [];
        // $date = $startDate;

        // while ($date->month <= $endDate->month && $date->year <= $endDate->year) {
        //     $startOfMonth = $date->startOfMonth();
        //     $endOfMonth = $date->endOfMonth();

        //     $weekRanges = [];
        //     $startOfWeek = $startOfMonth->startOfWeek();
        //     while ($startOfWeek->lte($endOfMonth)) {
        //         $endOfWeek = $startOfWeek->copy()->endOfWeek();
        //         $start = $startOfWeek->format('Y-m-d');
        //         $end = $endOfWeek->format('Y-m-d');
        //         $startOfWeek = $startOfWeek->addWeek();
        //         $rows = RKM::with(['materi'])
        //             ->join('materis', 'r_k_m_s.materi_key', '=', 'materis.id')
        //             ->whereBetween('tanggal_awal', [$start, $end])
        //             ->whereBetween('tanggal_akhir', [$start, $end])
        //             ->select('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal',
        //                 DB::raw('GROUP_CONCAT(r_k_m_s.instruktur_key SEPARATOR ", ") AS instruktur_all'),
        //                 DB::raw('GROUP_CONCAT(r_k_m_s.perusahaan_key SEPARATOR ", ") AS perusahaan_all'),
        //                 DB::raw('GROUP_CONCAT(r_k_m_s.sales_key SEPARATOR ", ") AS sales_all'),
        //                 DB::raw('SUM(r_k_m_s.pax) AS total_pax'))
        //             ->groupBy('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal')
        //             ->get();

        //         foreach ($rows as $row) {
        //             if ($row->instruktur_all == null) {
        //                 $sales_ids = explode(', ', $row->sales_all);
        //                 $perusahaan_ids = explode(', ', $row->perusahaan_all);
        //                 $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
        //                 $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();
        //             } else {
        //                 $sales_ids = explode(', ', $row->sales_all);
        //                 $perusahaan_ids = explode(', ', $row->perusahaan_all);
        //                 $instruktur_ids = explode(', ', $row->instruktur_all);
        //                 $row->instruktur = Karyawan::whereIn('kode_karyawan', $instruktur_ids)->get();
        //                 $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
        //                 $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();
        //             }
        //         }
        //         $weekRanges[] = ['start' => $start, 'end' =>  $end, 'data' => $rows];

        //     }

        //     $monthRanges[] = ['month' => $startOfMonth->translatedFormat('F-Y'), 'weeksData' => $weekRanges];

        //     $date = $date->addMonth();
        // }

        // $json = $monthRanges;
        // return $json;

        // $monthRanges[] = '';

        // $rkm = RKM::with('materi')->get();
        // $sales = karyawan::where('jabatan', 'sales')->get();
        // $instruktur = Karyawan::whereIn('jabatan', ['Instruktur', 'Education Manager'])->get();
        // $materi = Materi::get();
        // $perusahaan = Perusahaan::get();
        // $monthRanges[] = ['rkm' => $rkm, 'sales' => $sales];
        // return $monthRanges;

        $daysOfWeek = [
            'Senin', // Monday
            'Selasa', // Tuesday
            'Rabu', // Wednesday
            'Kamis', // Thursday
            'Jumat', // Friday
            'Sabtu', // Saturday
            'Minggu' // Sunday
        ];

        $tanggal_awal = '2024-04-02';
        $tanggal_awal = '2024-04-03';
        $startDay = 'Selasa'; // Contoh hari mulai
        $endDay = 'Jumat'; // Contoh hari akhir

        $startIndex = array_search($startDay, $daysOfWeek); // Temukan indeks hari mulai
        $endIndex = array_search($endDay, $daysOfWeek); // Temukan indeks hari akhir

        // Jika indeks hari akhir lebih kecil dari indeks hari mulai, tambahkan 7 ke indeks hari akhir
        if ($endIndex < $startIndex) {
            $endIndex += 7;
        }

        // Buat array yang berisi hari-hari dari hari mulai hingga hari akhir
        $selectedDays = array_slice($daysOfWeek, $startIndex, $endIndex - $startIndex + 1);

        // Tampilkan array yang berisi hari-hari terpilih
        foreach ($selectedDays as $day) {
            echo $day . '<br>';
        }
    }
}
