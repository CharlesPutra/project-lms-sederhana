@extends('Guru.layout')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Daftar Tugas</h4>
            <a href="{{ route('guru.tugas.create') }}" class="btn btn-primary">
                + Tambah Tugas
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Judul</th>
                            <th>Deadline</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tugas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->mapel->nama_mapel }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    {{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('d M Y H:i') : '-' }}
                                </td>
                                <td>
                                    @if ($item->file)
                                        <span class="badge bg-success">Ada</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Ada</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                        class="btn btn-secondary btn-sm">
                                        Lihat
                                    </a>
                                    <a href="{{ route('guru.tugas.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('guru.tugas.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus tugas?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada tugas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
