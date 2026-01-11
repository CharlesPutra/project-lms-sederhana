@php
    use Illuminate\Support\Str;
@endphp

@extends('Siswa.layout')

@section('navbar')
    <div class="container mt-4">

        <a href="{{ route('siswa.materi.siswa') }}" class="btn btn-secondary mb-3">
            ← Kembali
        </a>

        <div class="card shadow-sm">
            <div class="card-body">

                <h4>{{ $materi->judul }}</h4>

                <p class="text-muted">
                    Mapel: <strong>{{ $materi->mapel->nama_mapel }}</strong><br>
                    Guru: <strong>{{ $materi->guru->name }}</strong><br>
                    Tanggal: {{ $materi->created_at->format('d-m-Y') }}
                </p>

                @if ($materi->deskripsi)
                    <p>{{ $materi->deskripsi }}</p>
                @endif

                <hr>

                {{-- Preview PDF --}}
                @if (Str::endsWith($materi->file, '.pdf'))
                    <iframe src="{{ asset('storage/' . $materi->file) }}" width="100%" height="600" style="border:none;">
                    </iframe>
                @else
                    <div class="alert alert-info">
                        File tidak bisa dipratinjau. Silakan download.
                    </div>
                @endif

                <div class="mt-3">
                    <a href="{{ route('siswa.materi.siswa.download', $materi->id) }}" class="btn btn-primary">
                        Download Materi
                    </a>

                </div>

            </div>
        </div>

    </div>
@endsection
