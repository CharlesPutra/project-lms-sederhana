<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Mapel::all();
        return view('Admin.Mapel.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nama_mapel' => 'required']);
        Mapel::create($request->all());
        return redirect()->route('admin.mapel.index')->with('success', 'data berhasil ditambahkan');
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
        $edit = Mapel::findOrFail($id);
        return view('Admin.Mapel.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Mapel::findOrFail($id);
        $request->validate(['nama_mapel']);
        $update->update($request->all());
        return redirect()->route('admin.mapel.index')->with('warning','data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Mapel::findOrFail($id);
        $delete->delete();
        return redirect()->route('admin.mapel.index')->with('danger', 'data berhasil di hapus');
    }
}
