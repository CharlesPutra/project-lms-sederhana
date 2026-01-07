@extends('Admin.layout')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="mb-4">
            <h4 class="fw-bold">✏️ Edit Kelas</h4>
            <p class="text-muted">Perbarui nama kelas</p>
        </div>

        {{-- Card Form --}}
        <div class="card shadow-sm col-md-6">
            <div class="card-body">

                <form action="{{ route('admin.kelas.update', $edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama Kelas --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kelas</label>
                        <input type="text" name="nama_kelas"
                            class="form-control @error('nama_kelas') is-invalid @enderror"
                            value="{{ old('nama_kelas', $edit->nama_kelas) }}" required>

                        @error('nama_kelas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            Update
                        </button>

                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
