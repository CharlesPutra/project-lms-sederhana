<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materi = Materi::with('mapel')
            ->where('guru_id', Auth::id())
            ->latest()
            ->get();

        return view('Guru.Materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mapel = Mapel::all();
        return view('Guru.Materi.create', compact('mapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mapel_id'  => 'required|exists:mapels,id',
            'judul'     => 'required|string|max:255',
            'file'      => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:5120',
            'deskripsi' => 'nullable|string'
        ]);

        $filePath = $request->file('file')->store('materi', 'public');

        Materi::create([
            'mapel_id'  => $request->mapel_id,
            'guru_id'   => Auth::id(),
            'judul'     => $request->judul,
            'file'      => $filePath,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan');
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
        $materi = Materi::findOrFail($id);
        // proteksi agar guru tidak edit materi guru lain
        if ($materi->guru_id !== Auth::id()) {
            abort(403);
        }

        $mapel = Mapel::all();
        return view('Guru.Materi.edit', compact('materi', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $materi = Materi::findOrFail($id);

        if ($materi->guru_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'mapel_id'  => 'required|exists:mapel,id',
            'judul'     => 'required|string|max:255',
            'file'      => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:5120',
            'deskripsi' => 'nullable|string'
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($materi->file);
            $materi->file = $request->file('file')->store('materi', 'public');
        }

        $materi->update([
            'mapel_id'  => $request->mapel_id,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materi = Materi::findOrFail($id);

        if ($materi->guru_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($materi->file);
        $materi->delete();

        return back()->with('success', 'Materi berhasil dihapus');
    }
}
