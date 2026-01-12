@extends('Guru.layout')

@section('content')
    <div class="container mt-4">
        <h4>Edit Tugas</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-control" required>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->id }}" {{ $tugas->mapel_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Tugas</label>
                        <input type="text" name="judul" class="form-control" value="{{ $tugas->judul }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required>{{ $tugas->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File (Opsional)</label>
                        <input type="file" name="file" class="form-control">
                        @if ($tugas->file)
                            <small class="text-muted">
                                File lama tersimpan
                            </small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="datetime-local" name="deadline" class="form-control"
                            value="{{ $tugas->deadline ? date('Y-m-d\TH:i', strtotime($tugas->deadline)) : '' }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
