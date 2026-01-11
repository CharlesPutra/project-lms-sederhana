@extends('Siswa.layout')

@section('navbar')
    <div class="container">
        <h3 class="mb-4">Kelas Saya</h3>

        @if ($kelas->count() > 0)
            <div class="row">
                @foreach ($kelas as $k)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $k->nama_kelas }}</h5>
                                <p class="text-muted">Anda terdaftar di kelas ini</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning">
                Anda belum terdaftar di kelas manapun.
            </div>
        @endif
    </div>

@endsection
