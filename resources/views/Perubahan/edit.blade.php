<?php
use Carbon\Carbon;
?>

@extends('layouts.app')
<style>
    body {
                   overflow-x: hidden;
        }
</style>

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-pencil-square me-2"></i>Edit Dokumen {{ $perubahan->judul }}
            </h2>
            <p class="text-muted fs-6">Perbarui informasi dan metadata dokumen perubahan dengan mudah.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('perubahan.update', $perubahan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Informasi Dokumen -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="card-title mb-0"><i class="bi bi-file-earmark-text me-2"></i>Informasi Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label fw-semibold">Judul <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ old('judul', $perubahan->judul) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label fw-semibold">Tahun <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tahun" name="tahun"
                                    value="{{ old('tahun', $perubahan->tahun) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kata_kunci" class="form-label fw-semibold">Kata Kunci</label>
                                <input type="text" class="form-control" id="kata_kunci" name="kata_kunci"
                                    value="{{ old('kata_kunci', $perubahan->kata_kunci) }}">
                            </div>
                            <div class="mb-3">
                                <label for="abstrak" class="form-label fw-semibold">Abstrak</label>
                                <textarea class="form-control" id="abstrak" name="abstrak"
                                    rows="4">{{ old('abstrak', $perubahan->abstrak) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label fw-semibold">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan"
                                    rows="3">{{ old('catatan', $perubahan->catatan) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata & Lampiran -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-gradient-info text-white">
                            <h5 class="card-title mb-0"><i class="bi bi-info-circle-fill me-2"></i>Metadata & Lampiran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @php
                                    $metaFields = [
                                        ['label' => 'Tipe Dokumen', 'name' => 'tipe_dokumen'],
                                        ['label' => 'Judul Meta', 'name' => 'judul_meta'],
                                        ['label' => 'TEU', 'name' => 'teu'],
                                        ['label' => 'Nomor', 'name' => 'nomor'],
                                        ['label' => 'Bentuk', 'name' => 'bentuk'],
                                        ['label' => 'Bentuk Singkat', 'name' => 'bentuk_singkat'],
                                        ['label' => 'Tahun Meta', 'name' => 'tahun_meta', 'type' => 'number'],
                                        ['label' => 'Tempat Penetapan', 'name' => 'tempat_penetapan'],
                                        ['label' => 'Tanggal Penetapan', 'name' => 'tanggal_penetapan', 'type' => 'date'],
                                        ['label' => 'Tanggal Pengundangan', 'name' => 'tanggal_pengundangan', 'type' => 'date'],
                                        ['label' => 'Tanggal Berlaku', 'name' => 'tanggal_berlaku', 'type' => 'date'],
                                        ['label' => 'Sumber', 'name' => 'sumber'],
                                        ['label' => 'Subjek', 'name' => 'subjek'],
                                        ['label' => 'Status', 'name' => 'status'],
                                        ['label' => 'Bahasa', 'name' => 'bahasa'],
                                        ['label' => 'Lokasi', 'name' => 'lokasi'],
                                        ['label' => 'Bidang', 'name' => 'bidang']
                                    ];
                                @endphp

                                @foreach($metaFields as $field)
                                    <div class="col-md-6">
                                        <label for="{{ $field['name'] }}"
                                            class="form-label fw-semibold">{{ $field['label'] }}</label>
                                        <input type="{{ $field['type'] ?? 'text' }}" class="form-control"
                                            id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                            value="{{ old($field['name'], $perubahan->{$field['name']} && !is_string($perubahan->{$field['name']}) ? $perubahan->{$field['name']}->format('Y-m-d') : $perubahan->{$field['name']}) }}">
                                    </div>
                                @endforeach

                                <!-- File PDF -->
                                <div class="col-12">
                                    <label for="file_pdf" class="form-label fw-semibold">File PDF</label>
                                    <input type="file" class="form-control" id="file_pdf" name="file_pdf">
                                    @if($perubahan->file_pdf)
                                        <p class="mt-2 text-muted"><i class="bi bi-file-earmark-pdf me-1"></i>File saat ini:
                                            <a href="{{ asset('storage/' . $perubahan->file_pdf) }}"
                                                target="_blank">{{ $perubahan->file_pdf }}</a>
                                        </p>
                                    @endif
                                </div>

                                <!-- Mencabut -->
                                <div class="col-12">
                                    <label for="mencabut" class="form-label fw-semibold">Mencabut</label>
                                    <textarea class="form-control" id="mencabut" name="mencabut"
                                        rows="3">{{ old('mencabut', $perubahan->mencabut) }}</textarea>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-end mt-5">
                                <button type="submit" class="btn btn-gradient-primary me-3 fw-semibold">
                                    <i class="bi bi-save me-1"></i>Simpan Perubahan
                                </button>
                                <a href="{{ route('perubahan.index') }}"
                                    class="btn btn-outline-secondary fw-semibold">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>





    <!-- Gradient Buttons -->
    <style>
        .btn-gradient-primary {
            background: linear-gradient(90deg, #0d6efd 0%, #6610f2 100%);
            color: #fff;
            border: none;
        }

        .btn-gradient-primary:hover {
            opacity: 0.9;
        }

        .card-header.bg-gradient-primary {
            background: linear-gradient(90deg, #0d6efd 0%, #6610f2 100%);
        }

        .card-header.bg-gradient-info {
            background: linear-gradient(90deg, #0dcaf0 0%, #0d6efd 100%);
        }
    </style>
@endsection