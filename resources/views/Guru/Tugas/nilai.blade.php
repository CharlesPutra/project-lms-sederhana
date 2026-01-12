@extends('Guru.layout')

@section('content')
    <div class="container mt-4">
        <h4>Nilai Tugas</h4>

        <p><strong>Siswa:</strong> {{ $pengumpulan->siswa->name }}</p>
        <p><strong>Tugas:</strong> {{ $pengumpulan->tugas->judul }}</p>

        <form method="POST" action="{{ route('guru.pengumpulan.nilai.simpan', $pengumpulan->id) }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nilai</label>
                <input type="number" name="nilai" class="form-control" min="0" max="100"
                    value="{{ $pengumpulan->nilai }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control" rows="3">{{ $pengumpulan->catatan }}</textarea>
            </div>
            {{-- <a href="{{route('guru.tugas.show')}}" class="btn btn-secondary"></a> --}}
            <button class="btn btn-success">Simpan Nilai</button>
        </form>
    </div>
@endsection
