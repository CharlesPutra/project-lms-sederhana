<?php

namespace App\Http\Controllers;

use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaTugasController extends Controller
{
    // =====================
    // 1. DAFTAR TUGAS
    // =====================
    public function index()
    {
        $tugas = Tugas::with('mapel', 'guru')
            ->latest()
            ->get();

        return view('Siswa.Tugas.index', compact('tugas'));
    }

    // =====================
    // 2. DETAIL TUGAS
    // =====================
    public function show($id)
    {
        $tugas = Tugas::with('mapel', 'guru')->findOrFail($id);

        $pengumpulan = PengumpulanTugas::where('tugas_id', $id)
            ->where('siswa_id', Auth::id())
            ->first();

        // cek deadline
        $terlambat = $tugas->deadline
            ? now()->gt($tugas->deadline)
            : false;

        return view('Siswa.Tugas.show', compact(
            'tugas',
            'pengumpulan',
            'terlambat'
        ));
    }

    // =====================
    // 3. KUMPUL TUGAS
    // =====================
    public function kumpul(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        // deadline check
        if ($tugas->deadline && now()->gt($tugas->deadline)) {
            return back()->with('error', 'Deadline sudah lewat');
        }

        // cegah submit ulang
        if (PengumpulanTugas::where('tugas_id', $id)
            ->where('siswa_id', Auth::id())
            ->exists()
        ) {
            return back()->with('error', 'Tugas sudah dikumpulkan');
        }

        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip'
        ]);

        $filePath = $request->file('file')
            ->store('pengumpulan', 'public');

        PengumpulanTugas::create([
            'tugas_id' => $id,
            'siswa_id' => Auth::id(),
            'file' => $filePath
        ]);

        return redirect()
            ->route('siswa.tugas.show', $id)
            ->with('success', 'Tugas berhasil dikumpulkan');
    }

    // =====================
    // 4. DOWNLOAD FILE TUGAS
    // =====================
    public function download($id)
    {
        $tugas = Tugas::findOrFail($id);

        if (!$tugas->file) {
            abort(404);
        }

        $namaFile = $tugas->judul . '.' .
            pathinfo($tugas->file, PATHINFO_EXTENSION);

        return response()->download(
            storage_path('app/public/' . $tugas->file),
            $namaFile
        );
    }
}
