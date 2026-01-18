@extends('Admin.layout')

@section('content')
<div class="container mt-4">
    <h4>Edit Akun Guru</h4>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('admin.akun-guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Guru</label>
                    <input type="text" name="name"
                           value="{{ $guru->name }}"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email"
                           value="{{ $guru->email }}"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password (Opsional)</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti password
                    </small>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.akun-guru.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
