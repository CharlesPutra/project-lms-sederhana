@extends('Admin.layout')

@section('content')
<div class="container mt-4">
    <h4>Tambah Akun Guru</h4>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('admin.akun-guru.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Guru</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.akun-guru.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
