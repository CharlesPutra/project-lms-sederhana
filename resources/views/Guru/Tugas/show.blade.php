@extends('Guru.layout')

@section('content')
    <div class="container mt-4">
        <h4>Pengumpulan Tugas: {{ $tugas->judul }}</h4>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>File</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tugas->pengumpulan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->siswa->name }}</td>

                        <td>
                            @if ($item->file)
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                    class="btn btn-secondary btn-sm">
                                    Lihat File
                                </a>
                            @else
                                <span class="badge bg-danger">Belum Mengumpulkan</span>
                            @endif
                        </td>

                        <td>
                            @if ($item->nilai !== null)
                                <span class="badge bg-success">
                                    {{ $item->nilai }}
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Belum Dinilai
                                </span>
                            @endif
                        </td>

                        <td>
                            @if ($item->file)
                                <a href="{{ route('guru.pengumpulan.nilai', $item->id) }}" class="btn btn-primary btn-sm">
                                    Nilai
                                </a>
                            @else
                                <button class="btn btn-primary btn-sm" disabled>
                                    Nilai
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada pengumpulan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection
