<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tugas = Tugas::where('guru_id', Auth::id())->with('mapel')->latest()->get();
        return view('Guru.Tugas.index', compact('tugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mapel = Mapel::all();
        return view('Guru.Tugas.create', compact('mapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg',
            'deadline' => 'nullable|date'
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas', 'public');
        }

        Tugas::create([
            'mapel_id' => $request->mapel_id,
            'guru_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
            'deadline' => $request->deadline
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dibuat');
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
        $tugas = Tugas::findOrFail($id);

        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        $mapel = Mapel::all();
        return view('Guru.Tugas.edit', compact('tugas', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tugas = Tugas::findOrFail($id);

        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'mapel_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'file' => 'nullable|file',
            'deadline' => 'nullable|date'
        ]);

        if ($request->hasFile('file')) {
            if ($tugas->file) {
                Storage::disk('public')->delete($tugas->file);
            }

            $tugas->file = $request->file('file')->store('tugas', 'public');
        }

        $tugas->update($request->only(
            'mapel_id',
            'judul',
            'deskripsi',
            'deadline'
        ));

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tugas = Tugas::findOrFail($id);

        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($tugas->file) {
            Storage::disk('public')->delete($tugas->file);
        }

        $tugas->delete();

        return back()->with('success', 'Tugas berhasil dihapus');
    }
}
