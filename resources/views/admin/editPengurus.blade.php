@extends('layouts.app')
<style>
    body {
                   overflow-x: hidden;
        }
</style>
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card utama -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square me-2"></i>Edit Data Pengurus SPI
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <!-- Notifikasi sukses -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Edit -->
                        <form action="{{ route('pengurus.update', ['id' => $pengurus->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">Nama Pengurus</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control form-control-lg border-2 border-primary"
                                    value="{{ old('nama', $pengurus->nama) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan"
                                    class="form-control form-control-lg border-2 border-primary"
                                    value="{{ old('jabatan', $pengurus->jabatan) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label fw-semibold">Foto Baru (Opsional)</label>
                                <input type="file" name="foto" id="foto"
                                    class="form-control form-control-lg border-2 border-primary">
                                <small class="text-muted">Format: JPG, PNG. Maks 2MB.</small>
                            </div>

                            @if($pengurus->foto)
                                <div class="mb-3 text-center">
                                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                                    <div>
                                        <img src="{{ asset('images/pengurus/' . $pengurus->foto) }}" alt="Foto Pengurus"
                                            class="img-fluid rounded" style="max-height: 200px;">
                                    </div>
                                </div>
                            @endif

                            <div class="d-grid mb-2">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="bi bi-save2 me-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>

                        <!-- Tombol Batal -->
                        <div class="d-grid mb-2">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg shadow-sm">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>

                        <!-- Form Hapus (berdiri sendiri) -->
                        @csrf
                        @method('DELETE')
                        <!-- Tombol Hapus Trigger Modal -->
                        <div class="d-grid mb-2">
                            <button type="button" class="btn btn-danger btn-lg shadow-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-2"></i>Hapus Pengurus
                            </button>
                        </div>

                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow-sm">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi
                                            Hapus</h5>
                                        <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>Apakah Anda yakin ingin menghapus pengurus
                                            <strong>{{ $pengurus->nama }}</strong>?
                                        </p>
                                        <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('pengurus.destroy', ['id' => $pengurus->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus Sekarang</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Pastikan data dan foto terbaru sesuai dengan format yang disarankan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection