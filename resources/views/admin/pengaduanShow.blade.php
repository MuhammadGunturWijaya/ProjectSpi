@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
        }

        .custom-alert {
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: 2px solid #28a745;
            color: #155724;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #ffc107;
            color: #856404;
        }

        .alert-error {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border: 2px solid #dc3545;
            color: #721c24;
        }

        /* Floating shapes background */
        .floating-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .float-shape {
            position: absolute;
            opacity: 0.08;
            animation: floating 15s infinite ease-in-out;
        }

        .float-shape:nth-child(1) {
            top: 20%;
            left: 15%;
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            animation-delay: 0s;
        }

        .float-shape:nth-child(2) {
            top: 60%;
            right: 15%;
            width: 150px;
            height: 150px;
            background: white;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation-delay: 3s;
        }

        .float-shape:nth-child(3) {
            bottom: 15%;
            left: 25%;
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 20px;
            animation-delay: 6s;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(180deg);
            }
        }

        .container {
            position: relative;
            z-index: 1;
        }

        /* Header */
        .page-header {
            text-align: center;
            margin: 40px 0 50px;
            animation: fadeInDown 0.8s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
        }

        .page-header .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            font-weight: 300;
        }

        /* Main Card */
        .detail-card {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
        }

        /* Verification Mode Alert */
        .verification-mode-alert {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #ffc107;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }
        }

        .verification-mode-alert i {
            font-size: 2rem;
            color: #ff9f43;
        }

        .verification-mode-alert .content h5 {
            margin: 0 0 5px 0;
            color: #856404;
            font-weight: 700;
        }

        .verification-mode-alert .content p {
            margin: 0;
            color: #856404;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 35px 0 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .section-header .icon-box {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .section-header h5 {
            margin: 0;
            color: #2d3748;
            font-size: 1.4rem;
            font-weight: 600;
        }

        /* Info Boxes with Verification */
        .info-box {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            padding: 20px;
            padding-right: 110px;
            border-radius: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
            position: relative;
        }

        .info-box.verified-yes {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left-color: #28a745;
        }

        .info-box.verified-no {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-left-color: #dc3545;
        }

        .info-box:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .info-box strong {
            color: #4a5568;
            display: block;
            margin-bottom: 8px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-box .value {
            color: #2d3748;
            font-size: 1.05rem;
            font-weight: 500;
        }

        /* Verification Buttons */
        .verification-buttons {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 8px;
        }

        .verify-btn {
            width: 40px;
            height: 40px;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .verify-btn:hover {
            transform: scale(1.15);
        }

        .verify-btn.active-yes {
            background: #28a745;
            border-color: #28a745;
            color: white;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .verify-btn.active-no {
            background: #dc3545;
            border-color: #dc3545;
            color: white;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        /* Grid Info with Verification */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .info-item {
            background: white;
            border: 2px solid #e2e8f0;
            padding: 18px;
            padding-top: 55px;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
        }

        .info-item.verified-yes {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-color: #28a745;
        }

        .info-item.verified-no {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-color: #dc3545;
        }

        .info-item:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
            transform: translateY(-3px);
        }

        .info-item strong {
            display: block;
            color: #667eea;
            font-size: 0.85rem;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .info-item .value {
            color: #2d3748;
            font-size: 1rem;
            font-weight: 500;
        }

        /* List Styles */
        .custom-list {
            list-style: none;
            padding: 0;
        }

        .custom-list li {
            padding: 12px 15px;
            padding-right: 110px;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            margin-bottom: 10px;
            border-radius: 10px;
            border-left: 3px solid #667eea;
            transition: all 0.3s ease;
            position: relative;
        }

        .custom-list li.verified-yes {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left-color: #28a745;
        }

        .custom-list li.verified-no {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-left-color: #dc3545;
        }

        .custom-list li:hover {
            transform: translateX(5px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-list li::before {
            content: '✓';
            color: #667eea;
            font-weight: bold;
            margin-right: 10px;
        }

        /* Table */
        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .modern-table thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .modern-table thead th {
            padding: 15px;
            font-weight: 600;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modern-table tbody tr {
            background: white;
            transition: all 0.3s ease;
            position: relative;
        }

        .modern-table tbody tr.verified-yes {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
        }

        .modern-table tbody tr.verified-no {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        }

        .modern-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .modern-table tbody tr:hover {
            background: #e0e7ff;
            transform: scale(1.01);
        }

        .modern-table tbody td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            color: #2d3748;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .status-selesai {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .status-tindak {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .status-verifikasi {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .status-laporan {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .status-tanggapan {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
        }

        /* File Links */
        .file-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .file-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            padding-right: 110px;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .file-link.verified-yes {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-color: #28a745;
        }

        .file-link.verified-no {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-color: #dc3545;
        }

        .file-link:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, #e0e7ff, #dbeafe);
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .file-link i {
            font-size: 1.5rem;
        }

        /* Verification Summary */
        .verification-summary {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border: 2px solid #2196f3;
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
        }

        .verification-summary h5 {
            color: #1976d2;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .stat-box {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            text-align: center;
            min-width: 130px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            display: block;
            margin-bottom: 5px;
        }

        .stat-number.green {
            color: #28a745;
        }

        .stat-number.red {
            color: #dc3545;
        }

        .stat-number.blue {
            color: #2196f3;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
        }

        /* Notes Section */
        .notes-section {
            margin-top: 30px;
            padding: 25px;
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border-radius: 15px;
            border: 2px solid #ffc107;
        }

        .notes-section label {
            font-weight: 700;
            color: #856404;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }

        .notes-section textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #ffc107;
            border-radius: 12px;
            font-size: 1rem;
            resize: vertical;
            min-height: 120px;
            background: white;
        }

        .notes-section textarea:focus {
            outline: none;
            border-color: #ff9800;
            box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.1);
        }

        /* Buttons */
        .btn-back {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            text-decoration: none;
        }

        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
            background: linear-gradient(135deg, #5568d3, #6a3f8f);
            color: white;
        }

        .btn-verify-action {
            padding: 15px 35px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-approve {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .btn-approve:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(40, 167, 69, 0.4);
        }

        .btn-reject {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }

        .btn-reject:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(220, 53, 69, 0.4);
        }

        .btn-container {
            text-align: center;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Uraian Box */
        .uraian-box {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            padding: 25px;
            padding-right: 110px;
            border-radius: 15px;
            border-left: 5px solid #f59e0b;
            margin: 20px 0;
            position: relative;
        }

        .uraian-box.verified-yes {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left-color: #28a745;
        }

        .uraian-box.verified-no {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-left-color: #dc3545;
        }

        .uraian-box p {
            margin: 0;
            color: #78350f;
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Saving Indicator */
        .saving-indicator {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            display: none;
            align-items: center;
            gap: 10px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
            }

            to {
                transform: translateX(0);
            }
        }

        .saving-indicator.show {
            display: flex;
        }

        .saving-indicator.success {
            background: #28a745;
            color: white;
        }

        .saving-indicator.error {
            background: #dc3545;
            color: white;
        }

        .spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-card {
                padding: 25px;
            }

            .page-header h1 {
                font-size: 1.8rem;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .modern-table {
                font-size: 0.85rem;
            }

            .verification-buttons {
                position: relative;
                top: auto;
                right: auto;
                margin-top: 10px;
                justify-content: flex-end;
            }

            .btn-container {
                flex-direction: column;
            }

            .btn-verify-action {
                width: 100%;
                justify-content: center;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-style: italic;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* SOLUSI PERBAIKAN Z-INDEX UNTUK MODAL */
        /* Ini menimpa nilai default Bootstrap yang terganggu oleh Z-Index kustom Anda */

        .modal-backdrop {
            /* Backdrop harus berada di lapisan di bawah modal (1050 atau lebih rendah) */
            z-index: 1049 !important;
        }

        .modal {
            /* Modal harus berada di lapisan di atas backdrop (1050) DAN di atas saving-indicator (9999) */
            /* Kita gunakan nilai yang cukup tinggi untuk mengalahkan semuanya */
            z-index: 10000 !important;
        }

        /* Opsional: Turunkan z-index saving-indicator untuk manajemen yang lebih baik */
        .saving-indicator {
            z-index: 2000;
            /* Nilai ini masih sangat tinggi, tapi tidak mengganggu modal utama */
        }

        /* AKHIR SOLUSI PERBAIKAN Z-INDEX */
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Floating Background -->
    <div class="floating-bg">
        <div class="float-shape"></div>
        <div class="float-shape"></div>
        <div class="float-shape"></div>
    </div>

    <!-- Saving Indicator -->
    <div class="saving-indicator" id="savingIndicator">
        <div class="spinner"></div>
        <span>Menyimpan...</span>
    </div>

    <div class="container py-5">
        @if(session('success'))
            <div class="custom-alert alert-success mx-auto" style="max-width: 900px;">
                <i class="bi bi-check-circle-fill" style="font-size: 1.5rem;"></i>
                <div>
                    {!! session('success') !!}
                </div>
            </div>
        @endif

        @if(session('warning'))
            <div class="custom-alert alert-warning mx-auto" style="max-width: 900px;">
                <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.5rem;"></i>
                <div>
                    {!! session('warning') !!}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="custom-alert alert-error mx-auto" style="max-width: 900px;">
                <i class="bi bi-x-octagon-fill" style="font-size: 1.5rem;"></i>
                <div>
                    {!! session('error') !!}
                </div>
            </div>
        @endif
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="bi bi-file-text-fill"></i> Detail Pengaduan</h1>
            <p class="subtitle">Informasi lengkap laporan pengaduan masyarakat</p>
        </div>

        <!-- Main Detail Card -->
        <div class="detail-card mx-auto" style="max-width: 900px;">

            @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                <!-- Verification Mode Alert -->
                <div class="verification-mode-alert">
                    <i class="bi bi-clipboard-check"></i>
                    <div class="content">
                        <h5>Mode Verifikasi Aktif</h5>
                        <p>Klik tombol ✓ atau ✗ pada setiap field untuk verifikasi. Perubahan akan tersimpan otomatis.</p>
                    </div>
                </div>

                @php
                    // Decode updated_fields JSON menjadi array
                    $updatedFields = [];
                    if ($pengaduan->updated_fields) {
                        $updatedFields = is_string($pengaduan->updated_fields)
                            ? json_decode($pengaduan->updated_fields, true)
                            : $pengaduan->updated_fields;
                        // Pastikan selalu array
                        $updatedFields = is_array($updatedFields) ? $updatedFields : [];
                    }
                @endphp

                @if(count($updatedFields) > 0)
                    <div class="custom-alert"
                        style="background: linear-gradient(135deg, #e3f2fd, #bbdefb); border: 2px solid #2196f3; margin-bottom: 30px;">
                        <i class="bi bi-arrow-clockwise" style="font-size: 1.5rem; color: #1976d2;"></i>
                        <div>
                            <strong style="color: #1976d2;">Pelapor Telah Memperbarui Data</strong><br>
                            <span style="color: #0d47a1;">
                                Field yang diupdate:
                                @foreach($updatedFields as $field)
                                    <span class="badge"
                                        style="background: #1976d2; color: white; padding: 5px 10px; border-radius: 5px; margin: 2px;">
                                        {{ ucfirst(str_replace('_', ' ', $field)) }}
                                    </span>
                                @endforeach
                            </span><br>
                            <small style="color: #546e7a;">
                                <i class="bi bi-clock"></i> Terakhir diupdate:
                                {{ $pengaduan->last_revision_at ? $pengaduan->last_revision_at->format('d M Y, H:i') : '-' }}
                            </small>
                        </div>
                    </div>
                @endif

                <!-- Verification Summary -->
                <div class="verification-summary">
                    <h5><i class="bi bi-bar-chart-fill"></i> Ringkasan Verifikasi</h5>
                    <div class="summary-stats">
                        <div class="stat-box">
                            <span class="stat-number green" id="verifiedCount">0</span>
                            <span class="stat-label">Terverifikasi</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number red" id="rejectedCount">0</span>
                            <span class="stat-label">Ditolak</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number blue" id="pendingCount">0</span>
                            <span class="stat-label">Belum</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Info Dasar -->
            <div class="info-box" data-field="tanggal_pengaduan">
                <strong><i class="bi bi-calendar-check me-2"></i>Tanggal Pengaduan</strong>
                <div class="value">{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}</div>

                @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                    <div class="verification-buttons">
                        <button type="button" class="verify-btn verify-yes" data-field="tanggal_pengaduan" data-value="yes"
                            onclick="toggleVerificationStatus(this)">
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <button type="button" class="verify-btn verify-no" data-field="tanggal_pengaduan" data-value="no"
                            onclick="toggleVerificationStatus(this)">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif
            </div>

            <div class="info-box" data-field="perihal">
                <strong><i class="bi bi-file-earmark-text me-2"></i>Perihal</strong>
                <div class="value">{{ $pengaduan->perihal }}</div>

                @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                    <div class="verification-buttons">
                        <button type="button" class="verify-btn verify-yes" data-field="perihal" data-value="yes"
                            onclick="toggleVerificationStatus(this)">
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <button type="button" class="verify-btn verify-no" data-field="perihal" data-value="no"
                            onclick="toggleVerificationStatus(this)">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif
            </div>

            <div class="info-box">
                <strong><i class="bi bi-card-text me-2"></i>Uraian Pengaduan</strong>
                <div class="uraian-box" data-field="uraian">
                    <p>{{ $pengaduan->uraian }}</p>

                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                        <div class="verification-buttons">
                            <button type="button" class="verify-btn verify-yes" data-field="uraian" data-value="yes"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="verify-btn verify-no" data-field="uraian" data-value="no"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informasi Pendukung -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h5>Informasi Pendukung</h5>
            </div>

            <div class="info-grid">
                <div class="info-item" data-field="usia">
                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                        <div class="verification-buttons">
                            <button type="button" class="verify-btn verify-yes" data-field="usia" data-value="yes"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="verify-btn verify-no" data-field="usia" data-value="no"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                    <strong><i class="bi bi-person me-1"></i> Usia</strong>
                    <div class="value">{{ $pengaduan->usia }} tahun</div>
                </div>

                <div class="info-item" data-field="pendidikan">
                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                        <div class="verification-buttons">
                            <button type="button" class="verify-btn verify-yes" data-field="pendidikan" data-value="yes"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="verify-btn verify-no" data-field="pendidikan" data-value="no"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                    <strong><i class="bi bi-mortarboard me-1"></i> Pendidikan</strong>
                    <div class="value">{{ $pengaduan->pendidikan }}</div>
                </div>

                <div class="info-item" data-field="pekerjaan">
                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                        <div class="verification-buttons">
                            <button type="button" class="verify-btn verify-yes" data-field="pekerjaan" data-value="yes"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="verify-btn verify-no" data-field="pekerjaan" data-value="no"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                    <strong><i class="bi bi-briefcase me-1"></i> Pekerjaan</strong>
                    <div class="value">
                        {{ $pengaduan->pekerjaan }}
                        @if($pengaduan->pekerjaan_lain)
                            <br><small class="text-muted">({{ $pengaduan->pekerjaan_lain }})</small>
                        @endif
                    </div>
                </div>

                <div class="info-item" data-field="waktu_hubung">
                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                        <div class="verification-buttons">
                            <button type="button" class="verify-btn verify-yes" data-field="waktu_hubung" data-value="yes"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="verify-btn verify-no" data-field="waktu_hubung" data-value="no"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                    <strong><i class="bi bi-clock me-1"></i> Waktu Hubung</strong>
                    <div class="value">
                        {{ $pengaduan->waktu_hubung }}
                        @if($pengaduan->waktu_lain)
                            <br><small class="text-muted">({{ $pengaduan->waktu_lain }})</small>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pelanggaran -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h5>Jenis Pelanggaran</h5>
            </div>

            @php
                $rawPelanggaran = $pengaduan->getAttributes()['pelanggaran'] ?? null;

                if (is_array($pengaduan->pelanggaran) && count($pengaduan->pelanggaran) > 0) {
                    $pelanggaranArray = $pengaduan->pelanggaran;
                } elseif (is_string($rawPelanggaran)) {
                    // Bersihkan escape ganda & tanda kutip luar
                    $clean = trim($rawPelanggaran, '"');
                    $clean = stripslashes($clean);
                    $decoded = json_decode($clean, true);
                    $pelanggaranArray = is_array($decoded) ? $decoded : [];
                } else {
                    $pelanggaranArray = [];
                }

                // Filter "Lainnya"
                $filteredPelanggaran = collect($pelanggaranArray)
                    ->reject(fn($p) => strtolower(trim($p)) === 'lainnya')
                    ->all();
            @endphp

            @if(count($filteredPelanggaran) || $pengaduan->pelanggaran_lain)
                <ul class="custom-list">
                    @foreach($filteredPelanggaran as $key => $value)
                        @if($value)
                            <li data-field="pelanggaran_{{ $key }}">
                                @if(is_string($key))
                                    <strong>{{ ucfirst($key) }}:</strong>
                                @endif
                                {{ $value }}
                                @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                                    <div class="verification-buttons">
                                        <button type="button" class="verify-btn verify-yes" data-field="pelanggaran_{{ $key }}"
                                            data-value="yes" onclick="toggleVerificationStatus(this)">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button type="button" class="verify-btn verify-no" data-field="pelanggaran_{{ $key }}"
                                            data-value="no" onclick="toggleVerificationStatus(this)">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endforeach

                    @if($pengaduan->pelanggaran_lain)
                        <li data-field="pelanggaran_lain">
                            {{ $pengaduan->pelanggaran_lain }}
                            @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                                <div class="verification-buttons">
                                    <button type="button" class="verify-btn verify-yes" data-field="pelanggaran_lain" data-value="yes"
                                        onclick="toggleVerificationStatus(this)">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="verify-btn verify-no" data-field="pelanggaran_lain" data-value="no"
                                        onclick="toggleVerificationStatus(this)">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            @endif
                        </li>
                    @endif
                </ul>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada data pelanggaran</p>
                </div>
            @endif





            <!-- Kontak -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-telephone"></i>
                </div>
                <h5>Kontak yang Bisa Dihubungi</h5>
            </div>

            @php
                $rawKontak = $pengaduan->getAttributes()['kontak'] ?? null;

                if (is_array($pengaduan->kontak) && count($pengaduan->kontak) > 0) {
                    $kontakArray = $pengaduan->kontak;
                } elseif (is_string($rawKontak)) {
                    // Bersihkan escape ganda & tanda kutip luar
                    $clean = trim($rawKontak, '"');
                    $clean = stripslashes($clean);
                    $decoded = json_decode($clean, true);
                    $kontakArray = is_array($decoded) ? $decoded : [];
                } else {
                    $kontakArray = [];
                }
            @endphp

            @if(count($kontakArray))
                <ul class="custom-list">
                    @foreach($kontakArray as $key => $value)
                        @if($value)
                            <li data-field="kontak_{{ $key }}">
                                @if(is_string($key))
                                    <strong>{{ ucfirst($key) }}:</strong>
                                @endif
                                {{ $value }}
                                @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                                    <div class="verification-buttons">
                                        <button type="button" class="verify-btn verify-yes" data-field="kontak_{{ $key }}" data-value="yes"
                                            onclick="toggleVerificationStatus(this)">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button type="button" class="verify-btn verify-no" data-field="kontak_{{ $key }}" data-value="no"
                                            onclick="toggleVerificationStatus(this)">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endforeach

                </ul>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada data kontak</p>
                </div>
            @endif


            <!-- Detail Kejadian -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h5>Detail Kejadian</h5>
            </div>

            <div class="info-grid">
                <div class="info-item" data-field="tanggal_kejadian">
                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                        <div class="verification-buttons">
                            <button type="button" class="verify-btn verify-yes" data-field="tanggal_kejadian" data-value="yes"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="verify-btn verify-no" data-field="tanggal_kejadian" data-value="no"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                    <strong><i class="bi bi-calendar-event me-1"></i> Tanggal Kejadian</strong>
                    <div class="value">{{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d M Y') }}</div>
                </div>

                <div class="info-item" data-field="jam_kejadian">
                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                        <div class="verification-buttons">
                            <button type="button" class="verify-btn verify-yes" data-field="jam_kejadian" data-value="yes"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="verify-btn verify-no" data-field="jam_kejadian" data-value="no"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                    <strong><i class="bi bi-clock-history me-1"></i> Waktu Kejadian</strong>
                    <div class="value">{{ $pengaduan->jam_kejadian }}</div>
                </div>

                <div class="info-item" data-field="tempat_kejadian" style="grid-column: 1 / -1;">
                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                        <div class="verification-buttons">
                            <button type="button" class="verify-btn verify-yes" data-field="tempat_kejadian" data-value="yes"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            <button type="button" class="verify-btn verify-no" data-field="tempat_kejadian" data-value="no"
                                onclick="toggleVerificationStatus(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                    <strong><i class="bi bi-pin-map me-1"></i> Tempat Kejadian</strong>
                    <div class="value">
                        {{ $pengaduan->tempat_kejadian }}
                        @if($pengaduan->tempat_lain)
                            <br><small class="text-muted">({{ $pengaduan->tempat_lain }})</small>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Data Terlapor -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-people"></i>
                </div>
                <h5>Data Terlapor</h5>
            </div>

            @php
                $rawTerlapor = $pengaduan->getAttributes()['terlapor'] ?? null;

                if (is_array($pengaduan->terlapor) && count($pengaduan->terlapor) > 0) {
                    $terlapors = array_values($pengaduan->terlapor);
                } elseif (is_string($rawTerlapor)) {
                    $clean = trim($rawTerlapor, '"');
                    $clean = stripslashes($clean);
                    $decoded = json_decode($clean, true);
                    $terlapors = is_array($decoded) ? array_values($decoded) : [];
                } else {
                    $terlapors = [];
                }
            @endphp

            @if(count($terlapors))
                <div style="overflow-x: auto;">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Satuan Kerja</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                                @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                                    <th style="text-align: center; min-width: 100px;">Verifikasi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($terlapors as $tIndex => $t)
                                <tr data-field="terlapor_{{ $tIndex }}">
                                    <td>{{ $t['nama'] ?? '-' }}</td>
                                    <td>{{ $t['nip'] ?? '-' }}</td>
                                    <td>{{ $t['satuan_kerja'] ?? '-' }}</td>
                                    <td>{{ $t['jabatan'] ?? '-' }}</td>
                                    <td>{{ $t['jenis_kelamin'] ?? '-' }}</td>
                                    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                                        <td style="text-align: center;">
                                            <div style="display: inline-flex; gap: 8px;">
                                                <button type="button" class="verify-btn verify-yes" data-field="terlapor_{{ $tIndex }}"
                                                    data-value="yes" onclick="toggleVerificationStatus(this)">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                                <button type="button" class="verify-btn verify-no" data-field="terlapor_{{ $tIndex }}"
                                                    data-value="no" onclick="toggleVerificationStatus(this)">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada data terlapor</p>
                </div>
            @endif


            <!-- Pernyataan -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5>Pernyataan & Pihak Terkait</h5>
            </div>

            <div class="info-box" data-field="identitas_diketahui">
                <strong><i class="bi bi-eye me-2"></i>Identitas Ingin Diketahui Terlapor?</strong>
                <div class="value">{{ $pengaduan->identitas_diketahui }}</div>
                @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                    <div class="verification-buttons">
                        <button type="button" class="verify-btn verify-yes" data-field="identitas_diketahui" data-value="yes"
                            onclick="toggleVerificationStatus(this)">
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <button type="button" class="verify-btn verify-no" data-field="identitas_diketahui" data-value="no"
                            onclick="toggleVerificationStatus(this)">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif
            </div>

            <div class="info-box" data-field="pihak_terkait">
                <strong><i class="bi bi-people-fill me-2"></i>Pihak Terkait</strong>
                <div class="value">{{ $pengaduan->pihak_terkait ?? 'Tidak ada' }}</div>
                @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                    <div class="verification-buttons">
                        <button type="button" class="verify-btn verify-yes" data-field="pihak_terkait" data-value="yes"
                            onclick="toggleVerificationStatus(this)">
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <button type="button" class="verify-btn verify-no" data-field="pihak_terkait" data-value="no"
                            onclick="toggleVerificationStatus(this)">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Bukti -->
            @if($pengaduan->bukti_file || $pengaduan->link_video)
                <div class="section-header">
                    <div class="icon-box"><i class="bi bi-paperclip"></i></div>
                    <h5>Bukti Pendukung</h5>
                </div>

                @php
                    // BUKTI FILE
                    $rawFiles = $pengaduan->getAttributes()['bukti_file'] ?? null;
                    if (is_array($pengaduan->bukti_file) && count($pengaduan->bukti_file) > 0) {
                        $files = $pengaduan->bukti_file;
                    } elseif (is_string($rawFiles)) {
                        $clean = trim($rawFiles, '"');
                        $clean = stripslashes($clean);
                        $decoded = json_decode($clean, true);
                        $files = is_array($decoded) ? $decoded : [];
                    } else {
                        $files = [];
                    }
                @endphp

                @if(count($files))
                    <div class="file-list mb-2">
                        @foreach($files as $fIndex => $file)
                            <a href="{{ asset('storage/' . $file) }}" target="_blank" class="file-link"
                                data-field="bukti_file_{{ $fIndex }}">
                                <i class="bi bi-file-earmark-arrow-down"></i>
                                <span>{{ basename($file) }}</span>
                                @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                                    <div class="verification-buttons" style="right:15px;">
                                        <button type="button" class="verify-btn verify-yes" data-field="bukti_file_{{ $fIndex }}"
                                            data-value="yes" onclick="toggleVerificationStatus(this)">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button type="button" class="verify-btn verify-no" data-field="bukti_file_{{ $fIndex }}"
                                            data-value="no" onclick="toggleVerificationStatus(this)">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif

                @if($pengaduan->link_video)
                    <div class="file-list">
                        <a href="{{ $pengaduan->link_video }}" target="_blank" class="file-link" data-field="link_video">
                            <i class="bi bi-play-circle"></i>
                            <span>Video Link</span>
                            @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                                <div class="verification-buttons" style="right:15px;">
                                    <button type="button" class="verify-btn verify-yes" data-field="link_video" data-value="yes"
                                        onclick="toggleVerificationStatus(this)">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="verify-btn verify-no" data-field="link_video" data-value="no"
                                        onclick="toggleVerificationStatus(this)">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            @endif
                        </a>
                    </div>
                @endif
            @endif

            <!-- Status -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-info-circle"></i>
                </div>
                <h5>Status Pengaduan</h5>
            </div>

            <div style="text-align: center; padding: 20px;">
                <span
                    class="status-badge 
                                                                                                                                                                    @if($pengaduan->status == 'selesai') status-selesai
                                                                                                                                                                    @elseif($pengaduan->status == 'tindak_lanjut') status-tindak
                                                                                                                                                                    @elseif($pengaduan->status == 'diverifikasi') status-verifikasi
                                                                                                                                                                    @elseif($pengaduan->status == 'tanggapan_pelapor') status-tanggapan
                                                                                                                                                                    @else status-laporan
                                                                                                                                                                    @endif">
                    <i class="bi bi-circle-fill" style="font-size: 0.6rem;"></i>
                    {{ str_replace('_', ' ', $pengaduan->status) }}
                </span>
            </div>

            @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
                <!-- Notes Section -->
                <div class="notes-section">
                    <label><i class="bi bi-pencil-square"></i> Catatan Verifikasi (Opsional)</label>
                    <textarea id="verificationNotes"
                        placeholder="Tambahkan catatan verifikasi jika diperlukan...">{{ $pengaduan->verification_notes ?? '' }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="btn-container">
                    <button type="button" class="btn-verify-action btn-approve" onclick="openBidangModal()">
                        <i class="bi bi-check-circle-fill"></i>
                        Setujui & Lanjutkan
                    </button>
                    <button type="button" class="btn-verify-action btn-reject" onclick="submitVerification('reject')">
                        <i class="bi bi-x-circle-fill"></i>
                        Kembalikan ke Pelapor
                    </button>
                </div>



            @endif


            <!-- Back Button -->
            <div class="btn-container">
                <a href="{{ route('pengaduan.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left-circle"></i>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
    <!-- Modal Pilihan Bidang -->

    <div class="modal fade" id="bidangModal" tabindex="-1" aria-labelledby="bidangModalLabel" aria-hidden="true"
        data-bs-container="body">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="bidangModalLabel">Pilih Bidang & Role Terkait</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form id="formBidang">
                        <!-- Pilih Bidang -->
                        <div class="mb-3">
                            <label for="bidang_id" class="form-label">Pilih Bidang</label>
                            <select id="bidang_id" name="bidang_id" class="form-select" required>
                                <option value="">-- Pilih Bidang --</option>
                                @foreach($bidangPengaduans as $bidang)
                                    <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ✅ UBAH ID DAN NAME -->
                        <div class="mb-3">
                            <label for="role_bidang_id" class="form-label">Pilih Role</label>
                            <select id="role_bidang_id" name="role_bidang_id" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitBidang()">Kirim</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openBidangModal() {
            const bidangModal = new bootstrap.Modal(document.getElementById('bidangModal'));
            bidangModal.show();
        }

        // Di pengaduanShow.blade.php
        function submitVerification(action, bidangId = null, roleId = null) {
            let confirmationMessage;
            const form = document.getElementById('verificationForm');

            // Hapus input sementara sebelumnya (penting jika ada submit berulang)
            document.getElementById('temp_bidang_id')?.remove();
            document.getElementById('temp_role_id')?.remove();

            if (action === 'approve') {
                confirmationMessage = 'Anda yakin ingin MENYETUJUI verifikasi dan melanjutkan laporan ke Tindak Lanjut?';

                // 1. BUAT & SISIPKAN HIDDEN FIELD untuk bidang_id
                const inputBidang = document.createElement('input');
                inputBidang.type = 'hidden';
                inputBidang.name = 'bidang_id'; // Nama harus sesuai dengan validasi Laravel
                inputBidang.value = bidangId;
                inputBidang.id = 'temp_bidang_id';
                form.appendChild(inputBidang);

                // 2. BUAT & SISIPKAN HIDDEN FIELD untuk role_id
                const inputRole = document.createElement('input');
                inputRole.type = 'hidden';
                inputRole.name = 'role_id'; // Nama harus sesuai dengan validasi Laravel
                inputRole.value = roleId;
                inputRole.id = 'temp_role_id';
                form.appendChild(inputRole);

            } else { // action === 'reject'
                confirmationMessage = 'Anda yakin ingin MENGEMBALIKAN laporan ini ke Pelapor untuk perbaikan?';
            }

            if (!confirm(confirmationMessage)) {
                // Jika user membatalkan, hapus kembali input yang baru dibuat
                document.getElementById('temp_bidang_id')?.remove();
                document.getElementById('temp_role_id')?.remove();
                return;
            }

            // 3. Atur aksi dan SUBMIT form
            document.getElementById('action_input').value = action;
            form.submit();
        }

        // Fungsi submitBidang Anda tetap digunakan untuk memicu proses
        function submitBidang() {
            const bidangId = document.getElementById('bidang_id').value;
            const roleBidangId = document.getElementById('role_bidang_id').value; // ← UBAH INI

            console.log('📊 Submitting with:', {
                bidangId: bidangId,
                roleBidangId: roleBidangId, // ← UBAH INI
                verificationData: verificationData
            });

            if (!bidangId || !roleBidangId) { // ← UBAH INI
                alert('Silakan pilih bidang dan role terlebih dahulu.');
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('pengaduan.processVerification', $pengaduan->id) }}";

            // CSRF Token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            // Action
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'approve';
            form.appendChild(actionInput);

            // Bidang ID
            const bidangInput = document.createElement('input');
            bidangInput.type = 'hidden';
            bidangInput.name = 'bidang_id';
            bidangInput.value = bidangId;
            form.appendChild(bidangInput);

            // ✅ Role Bidang ID (bukan role_id)
            const roleInput = document.createElement('input');
            roleInput.type = 'hidden';
            roleInput.name = 'role_bidang_id'; // ← UBAH INI
            roleInput.value = roleBidangId; // ← UBAH INI
            form.appendChild(roleInput);

            // Verification Notes
            const notesInput = document.createElement('input');
            notesInput.type = 'hidden';
            notesInput.name = 'verification_notes';
            notesInput.value = document.getElementById('verificationNotes')?.value || '';
            form.appendChild(notesInput);

            // Verification Checks
            const checksInput = document.createElement('input');
            checksInput.type = 'hidden';
            checksInput.name = 'verification_checks';
            checksInput.value = JSON.stringify(verificationData);
            form.appendChild(checksInput);

            document.body.appendChild(form);

            const modal = bootstrap.Modal.getInstance(document.getElementById('bidangModal'));
            modal.hide();

            form.submit();
        }
    </script>



    @if($pengaduan->status === 'diverifikasi' && auth()->user()->role === 'admin')
        <script>
            // State management
            let verificationData = @json($pengaduan->verification_checks ? json_decode($pengaduan->verification_checks, true) : []) || [];

            // Ubah array menjadi object jika perlu
            if (Array.isArray(verificationData) && verificationData.length === 0) {
                verificationData = {};
            }

            let saveTimeout = null;

            // Initialize pada page load
            document.addEventListener('DOMContentLoaded', function () {
                console.log('Initializing verification with data:', verificationData);
                initializeVerificationState();
                updateSummaryStats();
                attachEventListeners();
            });

            // Initialize state dari database (PERSISTENT)
            function initializeVerificationState() {
                for (const [field, value] of Object.entries(verificationData)) {
                    const container = document.querySelector(`[data-field="${field}"]`);
                    if (!container) {
                        console.warn(`Container not found for field: ${field}`);
                        continue;
                    }

                    updateFieldState(container, value);

                    const buttons = container.querySelectorAll('.verify-btn');
                    buttons.forEach(btn => {
                        btn.classList.remove('active-yes', 'active-no', 'selected');

                        if (btn.dataset.value === value) {
                            btn.classList.add(value === 'yes' ? 'active-yes' : 'active-no');
                            btn.classList.add('selected');
                            console.log(`Set ${field} to ${value}`);
                        }
                    });
                }
            }

            // Attach event listeners
            function attachEventListeners() {
                document.querySelectorAll('.verify-btn').forEach(button => {
                    button.addEventListener('click', handleVerificationClick);
                });

                const notesTextarea = document.getElementById('verificationNotes');
                if (notesTextarea) {
                    notesTextarea.addEventListener('input', function () {
                        clearTimeout(saveTimeout);
                        saveTimeout = setTimeout(() => {
                            autoSaveData();
                        }, 1000);
                    });
                }
            }

            // Handle verification button click
            function handleVerificationClick(e) {
                e.preventDefault();
                e.stopPropagation();

                const button = e.currentTarget;
                const field = button.dataset.field;
                const value = button.dataset.value;
                const container = document.querySelector(`[data-field="${field}"]`);

                console.log('Button clicked:', field, value); // Debug log

                if (!container) {
                    console.error('Container not found for field:', field);
                    return;
                }

                // Update button states
                const allButtons = container.querySelectorAll('.verify-btn');
                allButtons.forEach(btn => {
                    btn.classList.remove('active-yes', 'active-no', 'selected');
                });

                button.classList.add(value === 'yes' ? 'active-yes' : 'active-no');
                button.classList.add('selected');

                // Update field visual state
                updateFieldState(container, value);

                // ✅ SIMPAN KE STATE
                verificationData[field] = value;
                console.log('Updated verification data:', verificationData); // Debug log
                console.log('Total fields verified:', Object.keys(verificationData).length); // Debug log

                // Update summary
                updateSummaryStats();

                // Auto-save ke database
                autoSaveData();
            }

            // Update field visual state
            function updateFieldState(container, value) {
                container.classList.remove('verified-yes', 'verified-no');
                if (value === 'yes') {
                    container.classList.add('verified-yes');
                } else if (value === 'no') {
                    container.classList.add('verified-no');
                }
            }

            // Update summary statistics
            function updateSummaryStats() {
                const values = Object.values(verificationData);
                const verified = values.filter(v => v === 'yes').length;
                const rejected = values.filter(v => v === 'no').length;

                const totalFields = document.querySelectorAll('[data-field] .verify-btn').length / 2;
                const pending = totalFields - (verified + rejected);

                document.getElementById('verifiedCount').textContent = verified;
                document.getElementById('rejectedCount').textContent = rejected;
                document.getElementById('pendingCount').textContent = pending;
            }

            // Auto-save to database (PERSISTENT)
            function autoSaveData() {
                showSavingIndicator('saving');

                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('verification_checks', JSON.stringify(verificationData));
                formData.append('verification_notes', document.getElementById('verificationNotes')?.value || '');

                fetch('{{ route("pengaduan.autoSaveVerification", $pengaduan->id) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Auto-save successful:', data);
                            showSavingIndicator('success');
                        } else {
                            console.error('Auto-save failed:', data);
                            showSavingIndicator('error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showSavingIndicator('error');
                    });
            }

            // Show saving indicator
            function showSavingIndicator(status) {
                const indicator = document.getElementById('savingIndicator');
                indicator.className = 'saving-indicator show';

                if (status === 'saving') {
                    indicator.innerHTML = '<div class="spinner"></div><span>Menyimpan...</span>';
                } else if (status === 'success') {
                    indicator.classList.add('success');
                    indicator.innerHTML = '<i class="bi bi-check-circle-fill"></i><span>Tersimpan!</span>';
                    setTimeout(() => {
                        indicator.classList.remove('show');
                    }, 2000);
                } else if (status === 'error') {
                    indicator.classList.add('error');
                    indicator.innerHTML = '<i class="bi bi-x-circle-fill"></i><span>Gagal menyimpan</span>';
                    setTimeout(() => {
                        indicator.classList.remove('show');
                    }, 3000);
                }
            }

            // Submit final verification
            function submitVerification(action) {
                console.log('=== SUBMIT VERIFICATION DEBUG ===');
                console.log('Action:', action);

                if (action === 'approve') {
                    // Untuk approve, buka modal
                    openBidangModal();
                    return;
                }

                // Untuk reject, langsung submit
                const verificationNotes = document.getElementById('verificationNotes')?.value || '';
                const totalChecks = Object.keys(verificationData).length;

                if (totalChecks === 0) {
                    alert('Harap verifikasi minimal satu field sebelum melanjutkan.');
                    return;
                }

                const hasRejectedFields = Object.values(verificationData).some(v => v === 'no');
                if (hasRejectedFields && verificationNotes.trim() === '') {
                    alert('Karena ada field yang ditolak (✗), Catatan Verifikasi wajib diisi.');
                    document.getElementById('verificationNotes').focus();
                    return;
                }

                if (!confirm('Anda yakin ingin MENGEMBALIKAN laporan ini ke Pelapor untuk perbaikan?')) {
                    return;
                }

                // Buat form untuk reject
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('pengaduan.processVerification', $pengaduan->id) }}";

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'reject';
                form.appendChild(actionInput);

                const notesInput = document.createElement('input');
                notesInput.type = 'hidden';
                notesInput.name = 'verification_notes';
                notesInput.value = verificationNotes;
                form.appendChild(notesInput);

                const checksInput = document.createElement('input');
                checksInput.type = 'hidden';
                checksInput.name = 'verification_checks';
                checksInput.value = JSON.stringify(verificationData);
                form.appendChild(checksInput);

                document.body.appendChild(form);
                form.submit();
            }

            // Fungsi toggle dipanggil dari HTML onclick
            function toggleVerificationStatus(clickedButton) {
                handleVerificationClick({
                    preventDefault: function () { },
                    stopPropagation: function () { },
                    currentTarget: clickedButton
                });
            }
        </script>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        html: `{!! session('success') !!}`,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#28a745',
                        timer: 5000,
                        timerProgressBar: true
                    });
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        html: `{!! session('error') !!}`,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#dc3545'
                    });
                });
            </script>
        @endif

        @if(session('warning'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        html: `{!! session('warning') !!}`,
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#ffc107'
                    });
                });
            </script>
        @endif

        @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        html: `
                                                                                                        <ul style="text-align: left; padding-left: 20px;">
                                                                                                            @foreach($errors->all() as $error)
                                                                                                                <li>{{ $error }}</li>
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    `,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#dc3545'
                    });
                });
            </script>
        @endif
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endif
@endsection