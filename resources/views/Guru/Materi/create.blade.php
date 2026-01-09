@extends('Guru.layout')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Tambah Materi</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('guru.materi.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- Mapel --}}
                <div class="mb-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <select name="mapel_id" class="form-select" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach ($mapel as $m)
                            <option value="{{ $m->id }}">
                                {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                    @error('mapel_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul Materi</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul') }}"
                           required>
                    @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- File --}}
                <div class="mb-3">
                    <label class="form-label">File Materi</label>
                    <input type="file" name="file" class="form-control" required>
                    @error('file')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('guru.materi.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
