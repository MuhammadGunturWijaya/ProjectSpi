@extends('layouts.app')
<style>
    body {
                   overflow-x: hidden;
        }
</style>
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 600px; border-radius: 15px;">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Tambah Pengurus SPI</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama</label>
                    <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                    <input type="text" class="form-control form-control-lg" id="jabatan" name="jabatan" placeholder="Masukkan jabatan" required>
                </div>

                <div class="mb-4">
                    <label for="foto" class="form-label fw-bold">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <small class="text-muted">Format: jpeg, png, jpg, gif. Maks 2MB.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('struktur.index') }}" class="btn btn-secondary">❌ Batal</a>
                    <button type="submit" class="btn btn-success">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 5px rgba(37, 99, 235, 0.5);
    }
</style>
@endsection
