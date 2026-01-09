@extends('Admin.layout')

@section('content')
<div class="container">
    <h4 class="mb-3">Tambah Mata Pelajaran</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.mapel.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Mapel</label>
                    <input type="text" name="nama_mapel"
                           class="form-control @error('nama_mapel') is-invalid @enderror"
                           value="{{ old('nama_mapel') }}">

                    @error('nama_mapel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary me-2">
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
