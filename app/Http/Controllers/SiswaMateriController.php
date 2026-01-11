<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class SiswaMateriController extends Controller
{
    public function index()
    {
        $materi = Materi::with(['mapel', 'guru'])->latest()->get();
        return view('Siswa.Materi.index', compact('materi'));
    }

    public function show($id)
    {
        $materi = Materi::with(['mapel', 'guru'])
            ->findOrFail($id);

        return view('Siswa.Materi.show', compact('materi'));
    }


    public function unduh($id)
    {
        $materi = Materi::findOrFail($id);

        $path = storage_path('app/public/' . $materi->file);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $extension = pathinfo($materi->file, PATHINFO_EXTENSION);
        $filename  = Str::slug($materi->judul) . '.' . $extension;

        return response()->download(
            $path,
            $filename,
            [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }
}
