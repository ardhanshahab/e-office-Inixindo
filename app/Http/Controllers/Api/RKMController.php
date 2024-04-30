<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use App\Models\RKM;
use App\Models\karyawan;
use Illuminate\Support\Carbon;
use App\Models\Perusahaan;
use App\Http\Resources\PostResource;
use App\Models\Nilaifeedback;

class RKMController extends Controller
{
    public function index()
    {
        $startDate = CarbonImmutable::create(2020, 1, 1);
        $endDate = CarbonImmutable::create(2030, 12, 31);
        $now = CarbonImmutable::now()->locale('id_ID');

        $monthRanges = [];
        $date = $startDate;

        while ($date->month <= $endDate->month && $date->year <= $endDate->year) {
            $startOfMonth = $date->startOfMonth();
            $endOfMonth = $date->endOfMonth();

            $weekRanges = [];
            $startOfWeek = $startOfMonth->startOfWeek();
            while ($startOfWeek->lte($endOfMonth)) {
                $endOfWeek = $startOfWeek->copy()->endOfWeek();
                $start = $startOfWeek->format('Y-m-d');
                $end = $endOfWeek->format('Y-m-d');
                $startOfWeek = $startOfWeek->addWeek();
                $rows = DB::table('r_k_m_s')
                    ->select('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal',
                        DB::raw('GROUP_CONCAT(r_k_m_s.instruktur_key SEPARATOR ", ") AS instruktur_all'),
                        DB::raw('GROUP_CONCAT(r_k_m_s.perusahaan_key SEPARATOR ", ") AS perusahaan_all'),
                        DB::raw('GROUP_CONCAT(r_k_m_s.sales_key SEPARATOR ", ") AS sales_all'),
                        DB::raw('GROUP_CONCAT(DISTINCT r_k_m_s.status ORDER BY r_k_m_s.status SEPARATOR ", ") AS status_all'),
                        DB::raw('SUM(r_k_m_s.pax) AS total_pax'))
                    ->join('materis', 'r_k_m_s.materi_key', '=', 'materis.id')
                    ->whereBetween('r_k_m_s.tanggal_awal', [$start, $end])
                    ->whereBetween('r_k_m_s.tanggal_akhir', [$start, $end])
                    ->groupBy('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal')
                    ->get();

                $rows = RKM::with(['materi'])
                    ->join('materis', 'r_k_m_s.materi_key', '=', 'materis.id')
                    ->whereBetween('tanggal_awal', [$start, $end])
                    ->whereBetween('tanggal_akhir', [$start, $end])
                    ->select('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal',
                        DB::raw('GROUP_CONCAT(r_k_m_s.instruktur_key SEPARATOR ", ") AS instruktur_all'),
                        DB::raw('GROUP_CONCAT(r_k_m_s.perusahaan_key SEPARATOR ", ") AS perusahaan_all'),
                        DB::raw('GROUP_CONCAT(r_k_m_s.sales_key SEPARATOR ", ") AS sales_all'),
                        DB::raw('SUM(r_k_m_s.pax) AS total_pax'))
                    ->addSelect(DB::raw('GROUP_CONCAT(DISTINCT r_k_m_s.status SEPARATOR ", ") AS statuses'))
                    ->groupBy('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal')
                    ->get();
                    // $statuses = RKM::select('status')->distinct()->pluck('status');


                foreach ($rows as $row) {
                    if ($row->instruktur_all == null) {
                        $sales_ids = explode(', ', $row->sales_all);
                        $perusahaan_ids = explode(', ', $row->perusahaan_all);
                        $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
                        $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();

                    } else {
                        $sales_ids = explode(', ', $row->sales_all);
                        $perusahaan_ids = explode(', ', $row->perusahaan_all);
                        $instruktur_ids = explode(', ', $row->instruktur_all);
                        $row->instruktur = Karyawan::whereIn('kode_karyawan', $instruktur_ids)->get();
                        $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
                        $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();
                    }
                }

                $weekRanges[] = ['start' => $start, 'end' =>  $end, 'data' => $rows];

            }

            $monthRanges[] = ['month' => $startOfMonth->translatedFormat('F-Y'), 'weeksData' => $weekRanges];

            $date = $date->addMonth();
        }

        $json = $monthRanges;
        return new PostResource(true, 'List Data RKM', $json);
    }
    public function showMonth($year, $month)
    {
        $startDate = CarbonImmutable::create($year, $month, 1);
        $endDate = CarbonImmutable::create($year, $month, 1)->endOfMonth();
        $now = CarbonImmutable::now()->locale('id_ID');

        $monthRanges = [];
        $date = $startDate;

        while ($date->month <= $endDate->month && $date->year <= $endDate->year) {
            $startOfMonth = $date->startOfMonth();
            $endOfMonth = $date->endOfMonth();

            $weekRanges = [];
            $startOfWeek = $startOfMonth->startOfWeek();
            while ($startOfWeek->lte($endOfMonth)) {
                $endOfWeek = $startOfWeek->copy()->endOfWeek();
                $start = $startOfWeek->format('Y-m-d');
                $end = $endOfWeek->format('Y-m-d');
                $startOfWeek = $startOfWeek->addWeek();
                $rows = RKM::with(['materi'])
                    ->join('materis', 'r_k_m_s.materi_key', '=', 'materis.id')
                    ->whereBetween('tanggal_awal', [$start, $end])
                    ->whereBetween('tanggal_akhir', [$start, $end])
                    ->select('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal',
                        DB::raw('GROUP_CONCAT(r_k_m_s.instruktur_key SEPARATOR ", ") AS instruktur_all'),
                        DB::raw('GROUP_CONCAT(r_k_m_s.perusahaan_key SEPARATOR ", ") AS perusahaan_all'),
                        DB::raw('GROUP_CONCAT(r_k_m_s.sales_key SEPARATOR ", ") AS sales_all'),
                        DB::raw('GROUP_CONCAT(DISTINCT r_k_m_s.status ORDER BY r_k_m_s.status SEPARATOR ", ") AS status_all'),
                        DB::raw('SUM(r_k_m_s.pax) AS total_pax'))
                    ->groupBy('r_k_m_s.materi_key', 'r_k_m_s.ruang', 'r_k_m_s.metode_kelas', 'r_k_m_s.event', 'r_k_m_s.tanggal_awal')
                    ->get();

                foreach ($rows as $row) {
                    if ($row->instruktur_all == null) {
                        $sales_ids = explode(', ', $row->sales_all);
                        $perusahaan_ids = explode(', ', $row->perusahaan_all);
                        $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
                        $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();
                    } else {
                        $sales_ids = explode(', ', $row->sales_all);
                        $perusahaan_ids = explode(', ', $row->perusahaan_all);
                        $instruktur_ids = explode(', ', $row->instruktur_all);
                        $row->instruktur = Karyawan::whereIn('kode_karyawan', $instruktur_ids)->get();
                        $row->sales = Karyawan::whereIn('kode_karyawan', $sales_ids)->get();
                        $row->perusahaan = Perusahaan::whereIn('id', $perusahaan_ids)->get();
                    }
                }
                $weekRanges[] = ['start' => $start, 'end' =>  $end, 'data' => $rows];

            }

            $monthRanges[] = ['month' => $startOfMonth->translatedFormat('F-Y'), 'weeksData' => $weekRanges];

            $date = $date->addMonth();
        }

        $json = $monthRanges;
        return new PostResource(true, 'List Detail Bulan RKM', $json);
    }
    public function getRKMRegist()
    {
        $today = Carbon::now();
        $startDate = $today->startOfWeek()->toDateString(); // Tanggal awal minggu ini
        $endDate = $today->endOfWeek()->toDateString(); // Tanggal akhir minggu ini

        $rows = RKM::with(['materi:id,nama_materi'])
            ->join('materis', 'r_k_m_s.materi_key', '=', 'materis.id')
            ->join('perusahaans', 'r_k_m_s.perusahaan_key', '=', 'perusahaans.id')
            ->whereBetween('r_k_m_s.tanggal_awal', [$startDate, $endDate])
            ->whereBetween('r_k_m_s.tanggal_akhir', [$startDate, $endDate])
            ->where('materis.nama_materi', 'LIKE', '%'.request('q').'%')
            ->select('r_k_m_s.*', 'perusahaans.nama_perusahaan')
            ->paginate(10);
        return response()->json($rows);


            // $perusahaans = Perusahaan::where('nama_perusahaan', 'LIKE', '%'.request('q').'%')->paginate(10);
    }

    public function getRKMDetail(Request $request)
    {
        $idRkm = $request->id_rkm;
        $rkm = RKM::with('materi')
            ->where('id', $idRkm)
            ->first();

        if ($rkm) {
            return response()->json(['rkm' => $rkm]);
        } else {
            return response()->json(['rkm' => null]);
        }
    }

    public function getRKMByMonthNow(Request $request)
    {
        $rkm = RKM::with(['sales', 'materi', 'instruktur', 'perusahaan', 'instruktur2', 'asisten'])
            ->whereYear('tanggal_awal', date("Y"))
            ->whereMonth('tanggal_awal', date("m"))
            ->get();

        if ($rkm->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No RKM found for the current month', 'data' => null]);
        } else {
            return response()->json(['success' => true, 'message' => 'List RKM Bulan ini', 'data' => $rkm]);
        }
    }



}
