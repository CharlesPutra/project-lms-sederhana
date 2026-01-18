<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = User::where('role', 'guru')->get();
        return view('Admin.AkunGuru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.AkunGuru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        return redirect()->route('admin.akun-guru.index')
            ->with('success', 'Akun guru berhasil ditambahkan');
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
        $guru = User::where('role', 'guru')->findOrFail($id);
        return view('Admin.AkunGuru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $guru->id,
            'password' => 'nullable|min:6',
        ]);

        $guru->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $guru->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.akun-guru.index')
            ->with('success', 'Akun guru berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);
        $guru->delete();

        return redirect()->route('admin.akun-guru.index')
            ->with('success', 'Akun guru berhasil dihapus');
    }
}
