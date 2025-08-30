@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card utama -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Struktur Organisasi</h4>
                </div>
                <div class="card-body p-4">
                    <!-- Notifikasi sukses -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Form upload -->
                    <form action="{{ route('struktur.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="struktur" class="form-label fw-semibold">Upload Struktur Baru</label>
                            <input type="file" name="struktur" id="struktur" class="form-control form-control-lg border-2 border-primary">
                            <small class="text-muted">Format: JPG, PNG, PDF. Maksimal ukuran 2MB.</small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="bi bi-save2 me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted text-center">
                    <small>Pastikan file terbaru sesuai dengan format yang disarankan</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
