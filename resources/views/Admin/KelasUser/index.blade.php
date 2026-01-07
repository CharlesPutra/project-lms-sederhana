@extends('Admin.layout')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-3">👥 Kelas Siswa</h4>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.kelas-user.create') }}" class="btn btn-primary mb-3">
        + Tambah Kelas Siswa
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelasUser as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_siswa }}</td>
                            <td>{{ $item->nama_kelas }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.kelas-user.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
