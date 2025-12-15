@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-5">
        <!-- Header Section -->
        <div class="mb-5">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-box me-3">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                    <h1 class="page-title mb-1">Edit Dokumen</h1>
                    <p class="text-muted mb-0">{{ $kinerja->judul }}</p>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb custom-breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:history.back()">Kembali</a></li>
                    <li class="breadcrumb-item active">Edit Dokumen</li>
                </ol>
            </nav>
        </div>

        @if(session('success'))
            <div class="alert alert-success-custom alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                    <div class="flex-grow-1">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <form action="{{ route('kinerjaSPI.update', $kinerja->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Informasi Dokumen -->
                <div class="col-lg-6">
                    <div class="modern-card">
                        <div class="card-header-custom primary-gradient">
                            <i class="bi bi-file-earmark-text me-2"></i>
                            <span>Informasi Dokumen</span>
                        </div>
                        <div class="card-body-custom">
                            <div class="form-group-custom">
                                <label for="judul" class="form-label-custom">
                                    Judul <span class="required-mark">*</span>
                                </label>
                                <input type="text" class="form-control-custom" id="judul" name="judul"
                                    value="{{ old('judul', $kinerja->judul) }}" required
                                    placeholder="Masukkan judul dokumen">
                            </div>

                            <div class="form-group-custom">
                                <label for="tahun" class="form-label-custom">
                                    Tahun <span class="required-mark">*</span>
                                </label>
                                <input type="number" class="form-control-custom" id="tahun" name="tahun"
                                    value="{{ old('tahun', $kinerja->tahun) }}" required
                                    placeholder="YYYY">
                            </div>

                            <div class="form-group-custom">
                                <label for="kata_kunci" class="form-label-custom">Kata Kunci</label>
                                <input type="text" class="form-control-custom" id="kata_kunci" name="kata_kunci"
                                    value="{{ old('kata_kunci', $kinerja->kata_kunci) }}"
                                    placeholder="Pisahkan dengan koma">
                            </div>

                            <div class="form-group-custom">
                                <label for="abstrak" class="form-label-custom">Abstrak</label>
                                <textarea class="form-control-custom" id="abstrak" name="abstrak"
                                    rows="4" placeholder="Ringkasan singkat dokumen">{{ old('abstrak', $kinerja->abstrak) }}</textarea>
                                <small class="form-text-muted">Maksimal 500 karakter</small>
                            </div>

                            <div class="form-group-custom mb-0">
                                <label for="catatan" class="form-label-custom">Catatan</label>
                                <textarea class="form-control-custom" id="catatan" name="catatan"
                                    rows="3" placeholder="Catatan tambahan (opsional)">{{ old('catatan', $kinerja->catatan) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata & Lampiran -->
                <div class="col-lg-6">
                    <div class="modern-card">
                        <div class="card-header-custom info-gradient">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <span>Metadata & Lampiran</span>
                        </div>
                        <div class="card-body-custom">
                            <div class="row g-3">
                                @php
                                    $metaFields = [
                                        ['label' => 'Tipe Dokumen', 'name' => 'tipe_dokumen', 'icon' => 'file-text'],
                                        ['label' => 'Judul Meta', 'name' => 'judul_meta', 'icon' => 'tag'],
                                        ['label' => 'TEU', 'name' => 'teu', 'icon' => 'hash'],
                                        ['label' => 'Nomor', 'name' => 'nomor', 'icon' => 'hash'],
                                        ['label' => 'Bentuk', 'name' => 'bentuk', 'icon' => 'layout'],
                                        ['label' => 'Bentuk Singkat', 'name' => 'bentuk_singkat', 'icon' => 'layout'],
                                        ['label' => 'Tahun Meta', 'name' => 'tahun_meta', 'type' => 'number', 'icon' => 'calendar'],
                                        ['label' => 'Tempat Penetapan', 'name' => 'tempat_penetapan', 'icon' => 'geo-alt'],
                                        ['label' => 'Tanggal Penetapan', 'name' => 'tanggal_penetapan', 'type' => 'date', 'icon' => 'calendar-check'],
                                        ['label' => 'Tanggal Pengundangan', 'name' => 'tanggal_pengundangan', 'type' => 'date', 'icon' => 'calendar-event'],
                                        ['label' => 'Tanggal Berlaku', 'name' => 'tanggal_berlaku', 'type' => 'date', 'icon' => 'calendar-plus'],
                                        ['label' => 'Sumber', 'name' => 'sumber', 'icon' => 'link-45deg'],
                                        ['label' => 'Subjek', 'name' => 'subjek', 'icon' => 'bookmark'],
                                        ['label' => 'Status', 'name' => 'status', 'icon' => 'toggle-on'],
                                        ['label' => 'Bahasa', 'name' => 'bahasa', 'icon' => 'translate'],
                                        ['label' => 'Lokasi', 'name' => 'lokasi', 'icon' => 'pin-map'],
                                        ['label' => 'Bidang', 'name' => 'bidang', 'icon' => 'grid']
                                    ];
                                @endphp

                                @foreach($metaFields as $field)
                                    <div class="col-md-6">
                                        <div class="form-group-custom-sm">
                                            <label for="{{ $field['name'] }}" class="form-label-custom-sm">
                                                <i class="bi bi-{{ $field['icon'] }} me-1"></i>
                                                {{ $field['label'] }}
                                            </label>
                                            <input type="{{ $field['type'] ?? 'text' }}" class="form-control-custom"
                                                id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                                value="{{ old($field['name'], isset($field['type']) && $field['type'] === 'date' && $kinerja->{$field['name']} ? date('Y-m-d', strtotime($kinerja->{$field['name']})) : $kinerja->{$field['name']}) }}">
                                        </div>
                                    </div>
                                @endforeach

                                <!-- File PDF -->
                                <div class="col-12">
                                    <div class="file-upload-wrapper">
                                        <label for="file_pdf" class="form-label-custom">
                                            <i class="bi bi-file-earmark-pdf me-1"></i>
                                            File PDF
                                        </label>
                                        <div class="file-input-custom">
                                            <input type="file" class="form-control-custom" id="file_pdf" name="file_pdf" accept=".pdf">
                                            <div class="file-input-icon">
                                                <i class="bi bi-cloud-upload"></i>
                                            </div>
                                        </div>
                                        @if($kinerja->file_pdf)
                                            <div class="current-file-info">
                                                <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                                <span>File saat ini:</span>
                                                <a href="{{ asset('storage/' . $kinerja->file_pdf) }}" target="_blank" class="file-link">
                                                    {{ basename($kinerja->file_pdf) }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Mencabut -->
                                <div class="col-12">
                                    <div class="form-group-custom mb-0">
                                        <label for="mencabut" class="form-label-custom">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Mencabut
                                        </label>
                                        <textarea class="form-control-custom" id="mencabut" name="mencabut"
                                            rows="3" placeholder="Daftar dokumen yang dicabut">{{ old('mencabut', $kinerja->mencabut) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons-wrapper">
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('kinerjaSPI.show', $kinerja->id) }}" class="btn-custom btn-secondary">
                        <i class="bi bi-x-lg me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn-custom btn-primary">
                        <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <style>
        /* Modern Color Palette */
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --info-color: #06b6d4;
            --danger-color: #ef4444;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--text-primary);
        }

        /* Header Styles */
        .icon-box {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
        }

        .icon-box i {
            font-size: 28px;
            color: white;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .custom-breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .custom-breadcrumb .breadcrumb-item {
            font-size: 14px;
        }

        .custom-breadcrumb .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s;
        }

        .custom-breadcrumb .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        .custom-breadcrumb .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Alert Styles */
        .alert-success-custom {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 1px solid #86efac;
            border-radius: 12px;
            padding: 16px 20px;
            color: #065f46;
            box-shadow: var(--shadow-sm);
        }

        .alert-success-custom i {
            color: var(--success-color);
        }

        /* Modern Card */
        .modern-card {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .modern-card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-2px);
        }

        .card-header-custom {
            padding: 20px 24px;
            color: white;
            font-weight: 600;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .primary-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .info-gradient {
            background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
        }

        .card-body-custom {
            padding: 28px;
        }

        /* Form Styles */
        .form-group-custom {
            margin-bottom: 24px;
        }

        .form-group-custom-sm {
            margin-bottom: 16px;
        }

        .form-label-custom {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .form-label-custom-sm {
            display: block;
            font-weight: 500;
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }

        .required-mark {
            color: var(--danger-color);
            font-weight: 700;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            transition: all 0.3s ease;
            background: var(--card-bg);
            color: var(--text-primary);
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .form-control-custom::placeholder {
            color: #94a3b8;
        }

        textarea.form-control-custom {
            resize: vertical;
            min-height: 100px;
        }

        .form-text-muted {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: var(--text-secondary);
        }

        /* File Upload */
        .file-upload-wrapper {
            margin-bottom: 20px;
        }

        .file-input-custom {
            position: relative;
        }

        .file-input-custom input[type="file"] {
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        .file-input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--text-secondary);
            font-size: 20px;
        }

        .current-file-info {
            margin-top: 12px;
            padding: 12px 16px;
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 8px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .file-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Action Buttons */
        .action-buttons-wrapper {
            margin-top: 40px;
            padding: 24px;
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .btn-custom {
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            opacity: 0.95;
        }

        .btn-secondary {
            background: white;
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--light-bg);
            border-color: var(--secondary-color);
            color: var(--text-primary);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .page-title {
                font-size: 24px;
            }

            .icon-box {
                width: 50px;
                height: 50px;
            }

            .icon-box i {
                font-size: 24px;
            }

            .card-body-custom {
                padding: 20px;
            }

            .action-buttons-wrapper {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .d-flex.gap-3 {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modern-card {
            animation: fadeInUp 0.5s ease forwards;
        }

        .modern-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .modern-card:nth-child(2) {
            animation-delay: 0.2s;
        }
    </style>
@endsection