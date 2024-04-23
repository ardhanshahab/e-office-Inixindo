<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Feedback;
class feedbackController extends Controller
{
    public function index(): View
    {
        // $perusahaans = Feedback::latest()->paginate(25);
        // $perusahaans = Feedback::with('karyawan')->paginate(25);

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
    public function show(string $id): View
    {
        //get post by ID
        $post = Feedback::with('karyawan')->findOrFail($id);
        //render view with post
        return view('feedback.show', compact('post', 'peserta'));
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
