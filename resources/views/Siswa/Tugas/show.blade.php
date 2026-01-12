@extends('Siswa.layout')

@section('navbar')
    <div class="container mt-4">
        <a href="{{ route('siswa.tugas.index') }}" class="btn btn-secondary mb-3">
            ← Kembali
        </a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <h4>{{ $tugas->judul }}</h4>
                <p class="mb-1"><strong>Mapel:</strong> {{ $tugas->mapel->nama_mapel }}</p>
                <p class="mb-1"><strong>Guru:</strong> {{ $tugas->guru->name }}</p>
                <p class="mb-1">
                    <strong>Deadline:</strong>
                    {{ $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('d M Y H:i') : 'Tidak ada deadline' }}
                </p>

                <hr>

                <p>{{ $tugas->deskripsi }}</p>

                @if ($tugas->file)
                    <a href="{{ route('siswa.tugas.download', $tugas->id) }}" class="btn btn-info btn-sm">
                        Download File Tugas
                    </a>
                @endif
            </div>
        </div>

        {{-- STATUS & PENGUMPULAN --}}
        <div class="card">
            <div class="card-body">
                @if ($pengumpulan)
                    <h5 class="text-success">Tugas Sudah Dikumpulkan</h5>
                    <p>
                        <strong>Waktu Kumpul:</strong>
                        {{ $pengumpulan->created_at->format('d M Y H:i') }}
                    </p>

                    @if (!is_null($pengumpulan->nilai))
                        <p><strong>Nilai:</strong> {{ $pengumpulan->nilai }}</p>
                        <p><strong>Catatan Guru:</strong> {{ $pengumpulan->catatan }}</p>
                    @else
                        <span class="badge bg-secondary">Belum Dinilai</span>
                    @endif
                @else
                    @if ($terlambat)
                        <div class="alert alert-danger">
                            Deadline sudah lewat, kamu tidak bisa mengumpulkan tugas.
                        </div>
                    @else
                        <h5>Kumpulkan Tugas</h5>

                        <form action="{{ route('siswa.tugas.kumpul', $tugas->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Upload File Jawaban</label>
                                <input type="file" name="file" class="form-control" required>
                                <small class="text-muted">
                                    PDF / DOC / DOCX / ZIP
                                </small>
                            </div>

                            <button class="btn btn-primary">
                                Kumpulkan
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
