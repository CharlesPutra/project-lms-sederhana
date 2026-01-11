@extends('Siswa.layout')

@section('navbar')
    <div class="container mt-4">

        <h4 class="mb-3">Materi Pembelajaran</h4>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Judul</th>
                            <th>Guru</th>
                            <th>Aksi</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->mapel->nama_mapel }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->guru->name }}</td>
                                <td>
                                    <a href="{{ route('siswa.materi.siswa.show', $item->id) }}" class="btn btn-sm btn-info">
                                        Lihat
                                    </a>

                                    <a href="{{ route('siswa.materi.siswa.download', $item->id) }}" class="btn btn-primary">
                                        Download Materi
                                    </a>

                                </td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
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
