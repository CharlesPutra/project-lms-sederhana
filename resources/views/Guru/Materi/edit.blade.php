@extends('Guru.layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Edit Materi</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('guru.materi.update', $materi->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Mapel --}}
                <div class="mb-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <select name="mapel_id" class="form-select" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach ($mapel as $m)
                            <option value="{{ $m->id }}"
                                {{ $materi->mapel_id == $m->id ? 'selected' : '' }}>
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
                           value="{{ old('judul', $materi->judul) }}"
                           required>
                    @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- File --}}
                <div class="mb-3">
                    <label class="form-label">File Materi</label>
                    <input type="file" name="file" class="form-control">

                    <small class="text-muted">
                        File saat ini:
                        <a href="{{ asset('storage/' . $materi->file) }}" target="_blank">
                            Lihat file
                        </a>
                    </small>

                    @error('file')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('guru.materi.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
