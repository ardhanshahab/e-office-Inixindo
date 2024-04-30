<?php

namespace App\Http\Controllers;

use App\Models\RKM;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Feedback;
use App\Models\Nilaifeedback;
use App\Models\Registrasi;

class nilaifeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $month = Carbon::now()->month;
        $post = RKM::whereMonth('tanggal_awal', $month)->get();
        $materi = Feedback::where('kategori_feedback', 'Materi')->get();
        $pelayanan = Feedback::where('kategori_feedback', 'Pelayanan')->get();
        $fasilitas = Feedback::where('kategori_feedback', 'Fasilitas Laboratium')->get();
        $instruktur = Feedback::where('kategori_feedback', 'Instruktur')->get();
        // $jmlInstruktur = RKM::with('instruktur');
        $umum = Feedback::where('kategori_feedback', 'Umum')->get();
        return view('nilaifeedback.create', compact('post', 'materi', 'fasilitas', 'instruktur', 'umum', 'pelayanan'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $regist = Registrasi::with('peserta')->where('id', $request->id_regist)->first();
        $email = $regist->peserta->email;
        // return $email;
        $nilaiFeedback = Nilaifeedback::where('id_regist', $request->id_regist)
            ->where('id_rkm', $request->id_rkm)
            ->first();
        if($nilaiFeedback){
            return redirect()->route('feedback.index')->with(['error' => 'Mohon maaf anda sudah mengisi Feedback ini!']);
        } else {
            Nilaifeedback::create(array_merge($request->except('email'), ['email' => $email]));
            return redirect()->route('feedback.index')->with(['success' => 'Terimakasih sudah mengisi Feedback ini!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
