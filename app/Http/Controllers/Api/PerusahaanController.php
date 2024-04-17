<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function getPerusahaan(){
        $perusahaans = Perusahaan::where('nama_perusahaan', 'LIKE', '%'.request('q').'%')->paginate(10);
        return response()->json($perusahaans);
    }

}
