@extends('Siswa.layout')

@section('navbar')
    <div class="container mt-4">
        <h4 class="mb-3">Daftar Tugas</h4>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Judul</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tugas as $item)
                            @php
                                $pengumpulan = $item->pengumpulan->where('siswa_id', auth()->id())->first();

                                $terlambat = $item->deadline && now()->gt($item->deadline);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->mapel->nama_mapel }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    {{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('d M Y H:i') : '-' }}
                                </td>
                                <td>
                                    @if ($pengumpulan)
                                        <span class="badge bg-success">Dikumpulkan</span>
                                    @elseif($terlambat)
                                        <span class="badge bg-danger">Terlambat</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('siswa.tugas.show', $item->id) }}" class="btn btn-sm btn-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Belum ada tugas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
