@extends('Admin.layout')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-3">➕ Tambah Kelas Siswa</h4>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card col-md-6 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.kelas-user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Siswa</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswa as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <select name="kelas_id" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('admin.kelas-user.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>

</div>
@endsection
