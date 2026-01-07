<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Kelas::all();
        return view('kelasadmin.index',compact('datas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelasadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nama_kelas' => 'required']);
        Kelas::create($request->all());
        return redirect()->route('admin.kelas.index')->with('success','data berhasil ditambahkan');
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
        $edit = Kelas::findOrFail($id);
        return view('Kelasadmin.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Kelas::findOrFail($id);
        $request->validate(['nama_kelas']);
        $update->update($request->all());
        return redirect()->route('admin.kelas.index')->with('warning', 'data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Kelas::findOrFail($id);
        $delete->delete();
        return redirect()->route('admin.kelas.index')->with('danger','data berhasil di hapus');
    }
}
