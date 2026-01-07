<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasUserController extends Controller
{
    public function index()
    {
        $kelasUser = DB::table('kelassiswas')->join('users', 'kelassiswas.user_id', '=', 'users.id')->join('kelas', 'kelassiswas.kelas_id', '=', 'kelas.id')->select('kelassiswas.id', 'users.name as nama_siswa', 'kelas.nama_kelas')->get();

        return view('Admin.KelasUser.index', compact('kelasUser'));
    }

    public function create()
    {
        $siswa = User::where('role', 'siswa')->get();
        $kelas = Kelas::all();
        return view('Admin.KelasUser.create', compact('siswa', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'  => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Cegah duplikat
        $exists = DB::table('kelassiswas')
            ->where('user_id', $request->user_id)
            ->where('kelas_id', $request->kelas_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Siswa sudah terdaftar di kelas ini');
        }

        DB::table('kelassiswas')->insert([
            'user_id' => $request->user_id,
            'kelas_id' => $request->kelas_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.kelas-user.index')
            ->with('success', 'Siswa berhasil dimasukkan ke kelas');
    }

    public function destroy($id)
    {
        DB::table('kelassiswas')->where('id', $id)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
