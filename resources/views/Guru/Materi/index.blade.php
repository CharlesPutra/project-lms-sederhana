@extends('Guru.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Materi</h4>
        <a href="{{ route('guru.materi.create') }}" class="btn btn-primary">
            + Tambah Materi
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Mapel</th>
                        <th>Judul</th>
                        <th>File</th>
                        <th>Dibuat</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mapel->nama_mapel }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                    Lihat
                                </a>
                            </td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('guru.materi.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('guru.materi.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus materi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada materi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
