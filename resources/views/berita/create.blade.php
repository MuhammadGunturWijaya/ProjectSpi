@extends('layouts.app')
<style>
    body {
                   overflow-x: hidden;
        }
</style>
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card -->
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <h3 class="mb-4 fw-bold text-center text-primary" style="font-family: 'Poppins', sans-serif;">
                                    <i class="bi bi-file-earmark-plus"></i> Tambah Berita
                                </h3>
                            @endif
                        @endauth

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Judul -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul Berita</label>
                                <input type="text" name="judul" class="form-control rounded-3 shadow-sm"
                                    placeholder="Masukkan judul berita..." required>
                            </div>

                            <!-- Isi -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Isi Berita</label>
                                <textarea name="isi" rows="6" class="form-control rounded-3 shadow-sm"
                                    placeholder="Tulis isi berita di sini..." required></textarea>
                            </div>

                            <!-- Upload File -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload Gambar dari Folder</label>
                                <input type="file" id="gambar-file" name="gambar" class="form-control rounded-3 shadow-sm">
                                <small class="text-muted">Format: JPG, PNG | Max 2MB</small>
                            </div>

                            <!-- Atau URL -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Atau Masukkan Link Gambar</label>
                                <input type="url" id="gambar-url" name="gambar_url" class="form-control rounded-3 shadow-sm"
                                    placeholder="Masukkan URL gambar...">
                                <small class="text-muted">Jika diisi, upload file akan diabaikan.</small>
                            </div>

                            <!-- Preview Gambar -->
                            <div class="mb-3 text-center">
                                <img id="preview-gambar" src="#" alt="Preview Gambar"
                                    style="max-width: 100%; display: none; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.2);">
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control rounded-3 shadow-sm" required>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="bi bi-arrow-left-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection