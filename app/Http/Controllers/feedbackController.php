<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Feedback;
use App\Models\Nilaifeedback;
class feedbackController extends Controller
{
    public function index()
    {

        return view('feedback.index');
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('feedback.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'kategori_feedback' => 'nullable',
            'pertanyaan' => 'nullable',
        ]);

        $kategori_feedback = $request->kategori_feedback;
        $huruf_pertama = substr($kategori_feedback, 0, 1);
        Feedback::create([
            'kategori_feedback' => $request->kategori_feedback,
            'pertanyaan' => $request->pertanyaan,
            'key' => $huruf_pertama,
        ]);

        return redirect()->route('feedback.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    //

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id)
    {
            $array = explode('0', $id);
            $materiKey = $array[0];
            $bulan = $array[1];

            $feedbacks = Nilaifeedback::with('rkm', 'regist')
            ->whereHas('rkm', function ($query) use ($materiKey, $bulan) {
                $query->where('materi_key', $materiKey)
                    ->whereMonth('tanggal_awal', $bulan);
            })
            ->get();

            $transformedFeedbacks = $feedbacks->map(function ($feedback) {
                return [
                    'id_regist' => $feedback->id_regist,
                    'id_rkm' => $feedback->id_rkm,
                    'nama_materi' => $feedback->rkm->materi->nama_materi,
                    'sales_key' => $feedback->rkm->sales_key,
                    'instruktur_key' => $feedback->rkm->instruktur_key,
                    'instruktur_key2' => $feedback->rkm->instruktur_key2,
                    'asisten_key' => $feedback->rkm->asisten_key,
                    'tanggal_awal' => $feedback->rkm->tanggal_awal,
                    'tanggal_akhir' => $feedback->rkm->tanggal_akhir,
                    'email' => $feedback->email,
                    'nama_perusahaan' => $feedback->rkm->perusahaan->nama_perusahaan,
                    'materi' => round(($feedback->M1 + $feedback->M2 + $feedback->M3 + $feedback->M4) / 4, 1),
                    'pelayanan' => round(($feedback->P1 + $feedback->P2 + $feedback->P3 + $feedback->P4 + $feedback->P5 + $feedback->P6 + $feedback->P7) / 7, 1),
                    'fasilitas' => round(($feedback->F1 + $feedback->F2 + $feedback->F3 + $feedback->F4 + $feedback->F5) / 5, 1),
                    'instruktur' => round(($feedback->I1 + $feedback->I2 + $feedback->I3 + $feedback->I4 + $feedback->I5 + $feedback->I6 + $feedback->I7 + $feedback->I8) / 8, 1),
                    'instruktur2' => round(($feedback->I1b + $feedback->I2b + $feedback->I3b + $feedback->I4b + $feedback->I5b + $feedback->I6b + $feedback->I7b + $feedback->I8b) / 8, 1),
                    'asisten' => round(($feedback->I1as + $feedback->I2as + $feedback->I3as + $feedback->I4as + $feedback->I5as + $feedback->I6as + $feedback->I7as + $feedback->I8as) / 8, 1),
                    'umum1' => $feedback->U1,
                    'umum2' => $feedback->U2,
                ];
            })->groupBy('nama_perusahaan')->map(function($groupedFeedbacks, $nama_perusahaan) {
                return [
                    'nama_perusahaan' => $nama_perusahaan,
                    'data' => $groupedFeedbacks
                ];
            });


            $post =  $transformedFeedbacks;
            // return $post;
            // return $feedbacks;

        return view('feedback.show', compact('post', 'feedbacks'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $perusahaans = Feedback::findOrFail($id);

        //render view with post
        return view('feedback.edit', compact('perusahaans'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'kategori_feedback' => 'required',
            'pertanyaan' => 'nullable',
        ]);

        $post = Feedback::findOrFail($id);

            $post->update([
                'kategori_feedback' => $request->kategori_feedback,
                'pertanyaan' => $request->pertanyaan,
            ]);

        return redirect()->route('feedback.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        $post = Feedback::findOrFail($id);

        $post->delete();

        return redirect()->route('feedback.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
