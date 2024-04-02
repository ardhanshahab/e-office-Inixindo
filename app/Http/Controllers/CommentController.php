<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'karyawan_key' => 'required|exists:karyawans,id',
            'content' => 'required',
            'materi_key' => 'required',
            'rkm_key' => 'required|exists:r_k_m_s,id',
        ]);

        Comment::create($validatedData);

        return redirect()->back()->with('success', 'Komentar berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'karyawan_key' => 'required|exists:karyawans,id',
            'content' => 'required',
            'rkm_key' => 'required|exists:rkms,id',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validatedData);

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }


}
