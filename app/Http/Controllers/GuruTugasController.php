<?php

namespace App\Http\Controllers;

use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;

class GuruTugasController extends Controller
{
    public function pengumpulan($id)
    {
        $tugas = Tugas::with(['pengumpulan.siswa'])->findOrFail($id);

        if ($tugas->guru_id !== auth()->id()) {
            abort(403);
        }

        return view('Guru.Tugas.show', compact('tugas'));
    }

    public function nilai($id)
    {
        $pengumpulan = PengumpulanTugas::with(['siswa', 'tugas'])->findOrFail($id);

        if ($pengumpulan->tugas->guru_id !== auth()->id()) {
            abort(403);
        }

        return view('Guru.Tugas.nilai', compact('pengumpulan'));
    }

    public function simpanNilai(Request $request, $id)
    {
        $pengumpulan = PengumpulanTugas::findOrFail($id);

        if ($pengumpulan->tugas->guru_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string'
        ]);

        $pengumpulan->update([
            'nilai' => $request->nilai,
            'catatan' => $request->catatan
        ]);

        return redirect()->route('guru.tugas.pengumpulan', $pengumpulan->tugas_id)->with('success', 'Nilai berhasil disimpan');
    }
}
