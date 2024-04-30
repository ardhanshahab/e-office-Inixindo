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
        // $feedbacks = Nilaifeedback::with('rkm')->get();

        //     $groupedFeedbacks = $feedbacks->groupBy('id_rkm');
        //     $transformedFeedbacks = $groupedFeedbacks->map(function ($groupedFeedback) {
        //     $firstFeedback = $groupedFeedback->first();

        //     return [
        //         'id_rkm' => $firstFeedback->id_rkm,
        //         'nama_materi' => $firstFeedback->rkm->materi->nama_materi,
        //         'feedbacks' => $groupedFeedback->map(function ($feedback) {
        //             return [
        //                 'id' => $feedback->id,
        //                 'email' => $feedback->email,
        //                 'materi' => round(($feedback->M1 + $feedback->M2 + $feedback->M3 + $feedback->M4) / 4, 1),
        //                 'pelayanan' => round(($feedback->P1 + $feedback->P2 + $feedback->P3 + $feedback->P4 + $feedback->P5 + $feedback->P6 + $feedback->P7) / 7, 1),
        //                 'fasilitas' => round(($feedback->F1 + $feedback->F2 + $feedback->F3 + $feedback->F4 + $feedback->F5) / 5, 1),
        //                 'instruktur' => round(($feedback->I1 + $feedback->I2 + $feedback->I3 + $feedback->I4 + $feedback->I5 + $feedback->I6 + $feedback->I7 + $feedback->I8) / 8, 1),
        //                 'instruktur2' => round(($feedback->I1b + $feedback->I2b + $feedback->I3b + $feedback->I4b + $feedback->I5b + $feedback->I6b + $feedback->I7b + $feedback->I8b) / 8, 1),
        //                 'asisten' => round(($feedback->I1as + $feedback->I2as + $feedback->I3as + $feedback->I4as + $feedback->I5as + $feedback->I6as + $feedback->I7as + $feedback->I8as) / 8, 1),
        //                 'umum1' => $feedback->U1,
        //                 'umum2' => $feedback->U2,
        //             ];
        //         })
        //     ];
        // });
        // $feedbacks = Nilaifeedback::with('regist', 'rkm')->get();

        // $transformedFeedbacks = $feedbacks->map(function ($feedback) {
        //     return [
        //         'id_regist' => $feedback->id_regist,
        //         'id_rkm' => $feedback->id_rkm,
        //         'email' => $feedback->email,
        //         'materi' => round(($feedback->M1 + $feedback->M2 + $feedback->M3 + $feedback->M4) / 4, 1),
        //         'pelayanan' => round(($feedback->P1 + $feedback->P2 + $feedback->P3 + $feedback->P4 + $feedback->P5 + $feedback->P6 + $feedback->P7) / 7, 1),
        //         'fasilitas' => round(($feedback->F1 + $feedback->F2 + $feedback->F3 + $feedback->F4 + $feedback->F5) / 5, 1),
        //         'instruktur' => round(($feedback->I1 + $feedback->I2 + $feedback->I3 + $feedback->I4 + $feedback->I5 + $feedback->I6 + $feedback->I7 + $feedback->I8) / 8, 1),
        //         'instruktur2' => round(($feedback->I1b + $feedback->I2b + $feedback->I3b + $feedback->I4b + $feedback->I5b + $feedback->I6b + $feedback->I7b + $feedback->I8b) / 8, 1),
        //         'asisten' => round(($feedback->I1as + $feedback->I2as + $feedback->I3as + $feedback->I4as + $feedback->I5as + $feedback->I6as + $feedback->I7as + $feedback->I8as) / 8, 1),
        //         'umum1' => $feedback->U1,
        //         'umum2' => $feedback->U2,
        //         'regist' => [
        //             'id' => $feedback->regist->id,
        //             'nama' => $feedback->regist->peserta->nama, // contoh atribut yang ingin Anda tambahkan dari relasi regist
        //             // tambahkan atribut lainnya yang Anda perlukan
        //         ],
        //         'rkm' => [
        //             'id' => $feedback->rkm->id,
        //             'nama_materi' => $feedback->rkm->materi->nama_materi, // contoh atribut yang ingin Anda tambahkan dari relasi rkm
        //             // tambahkan atribut lainnya yang Anda perlukan
        //         ],
        //     ];
        // });

        // return response()->json([
        //     'success' => true,
        //     'message' => 'List Feedbacks',
        //     'data' => $feedbacks
        // ]);

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
        //get post by ID
        $feedbacks = Nilaifeedback::with('rkm', 'regist')->where('id_rkm', $id)->get();
        // return $feedbacks;
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
                    // 'rkm' => [
                    //     'id' => $feedback->rkm->id,
                    //     'nama_materi' => $feedback->rkm->materi->nama_materi, // contoh atribut yang ingin Anda tambahkan dari relasi rkm
                    //     // tambahkan atribut lainnya yang Anda perlukan
                    // ],
                ];
            });
            $post =  $transformedFeedbacks;
            // return $post;
            $feedbacks = Nilaifeedback::with('rkm', 'regist')->where('id_rkm', $id)->get();

        //render view with post
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
