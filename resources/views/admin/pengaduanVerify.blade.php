<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
        }

        .verification-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .verification-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header-verify {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .card-header-verify h2 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .card-header-verify p {
            margin: 10px 0 0;
            opacity: 0.9;
        }

        .card-body-verify {
            padding: 40px;
        }

        .info-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .info-section h4 {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .info-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .info-item label {
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            display: block;
            margin-bottom: 5px;
        }

        .info-item .value {
            color: #212529;
            font-size: 1rem;
        }

        .verification-section {
            background: #fff;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .verification-section h4 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 25px;
            font-size: 1.3rem;
        }

        .check-item {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border: 2px solid #dee2e6;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .check-item:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .check-item.checked {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-color: #28a745;
        }

        .check-item.unchecked {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-color: #dc3545;
        }

        .check-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .check-label {
            flex: 1;
            font-weight: 600;
            color: #212529;
            font-size: 1.05rem;
        }

        .check-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-check {
            width: 50px;
            height: 50px;
            border: 2px solid #dee2e6;
            border-radius: 12px;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-check:hover {
            transform: scale(1.1);
        }

        .btn-check.active-yes {
            background: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-check.active-no {
            background: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .check-description {
            color: #6c757d;
            font-size: 0.9rem;
            margin-left: 65px;
        }

        .notes-section {
            margin-top: 30px;
        }

        .notes-section label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
            display: block;
        }

        .notes-section textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #dee2e6;
            border-radius: 12px;
            font-size: 1rem;
            resize: vertical;
            min-height: 150px;
            transition: all 0.3s ease;
        }

        .notes-section textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }

        .btn-action {
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-approve {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .btn-approve:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        }

        .btn-reject {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }

        .btn-reject:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
        }

        .btn-back {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #ffc107;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .alert-warning i {
            color: #ff9f43;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .card-body-verify {
                padding: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }

        .summary-box {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border: 2px solid #2196f3;
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
        }

        .summary-box h5 {
            color: #1976d2;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .summary-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .stat-item {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            text-align: center;
            min-width: 120px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            display: block;
        }

        .stat-number.green {
            color: #28a745;
        }

        .stat-number.red {
            color: #dc3545;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <div class="verification-card">
            <div class="card-header-verify">
                <h2><i class="bi bi-clipboard-check"></i> Verifikasi Pengaduan</h2>
                <p>Periksa kelengkapan dan kebenaran data laporan</p>
            </div>

            <div class="card-body-verify">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-3"></i>
                    <div>
                        <strong>Penting!</strong> Pastikan semua data telah diverifikasi dengan benar sebelum melanjutkan ke tahap berikutnya.
                    </div>
                </div>

                <!-- Info Pengaduan -->
                <div class="info-section">
                    <h4><i class="bi bi-file-text"></i> Informasi Pengaduan</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Perihal</label>
                            <div class="value">{{ $pengaduan->perihal }}</div>
                        </div>
                        <div class="info-item">
                            <label>Tanggal Pengaduan</label>
                            <div class="value">{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}</div>
                        </div>
                        <div class="info-item">
                            <label>Status Saat Ini</label>
                            <div class="value"><span class="badge bg-primary">{{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}</span></div>
                        </div>
                    </div>
                </div>

                <!-- Form Verifikasi -->
                <form id="verificationForm" action="{{ route('pengaduan.processVerification', $pengaduan->id) }}" method="POST">
                    @csrf
                    
                    <div class="verification-section">
                        <h4>Checklist Verifikasi Data</h4>

                        <!-- Item 1: Data Pelapor -->
                        <div class="check-item" data-field="data_pelapor">
                            <div class="check-header">
                                <div class="check-label">
                                    <i class="bi bi-person-badge"></i> Data Pelapor Lengkap
                                </div>
                                <div class="check-buttons">
                                    <button type="button" class="btn-check check-yes" data-value="yes">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn-check check-no" data-value="no">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="check-description">
                                Nama, usia ({{ $pengaduan->usia }} tahun), pendidikan ({{ $pengaduan->pendidikan }}), pekerjaan ({{ $pengaduan->pekerjaan }})
                            </div>
                            <input type="hidden" name="verification_checks[data_pelapor]" value="">
                        </div>

                        <!-- Item 2: Kontak -->
                        <div class="check-item" data-field="kontak">
                            <div class="check-header">
                                <div class="check-label">
                                    <i class="bi bi-telephone"></i> Informasi Kontak Valid
                                </div>
                                <div class="check-buttons">
                                    <button type="button" class="btn-check check-yes" data-value="yes">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn-check check-no" data-value="no">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="check-description">
                                Email, telepon, WhatsApp tersedia dan dapat dihubungi
                            </div>
                            <input type="hidden" name="verification_checks[kontak]" value="">
                        </div>

                        <!-- Item 3: Detail Kejadian -->
                        <div class="check-item" data-field="detail_kejadian">
                            <div class="check-header">
                                <div class="check-label">
                                    <i class="bi bi-calendar-event"></i> Detail Kejadian Jelas
                                </div>
                                <div class="check-buttons">
                                    <button type="button" class="btn-check check-yes" data-value="yes">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn-check check-no" data-value="no">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="check-description">
                                Tanggal ({{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d M Y') }}), waktu ({{ $pengaduan->jam_kejadian }}), tempat ({{ $pengaduan->tempat_kejadian }})
                            </div>
                            <input type="hidden" name="verification_checks[detail_kejadian]" value="">
                        </div>

                        <!-- Item 4: Uraian -->
                        <div class="check-item" data-field="uraian">
                            <div class="check-header">
                                <div class="check-label">
                                    <i class="bi bi-journal-text"></i> Uraian Pengaduan Memadai
                                </div>
                                <div class="check-buttons">
                                    <button type="button" class="btn-check check-yes" data-value="yes">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn-check check-no" data-value="no">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="check-description">
                                Kronologi dan deskripsi kejadian cukup detail dan dapat dipahami
                            </div>
                            <input type="hidden" name="verification_checks[uraian]" value="">
                        </div>

                        <!-- Item 5: Bukti Pendukung -->
                        <div class="check-item" data-field="bukti">
                            <div class="check-header">
                                <div class="check-label">
                                    <i class="bi bi-paperclip"></i> Bukti Pendukung Memadai
                                </div>
                                <div class="check-buttons">
                                    <button type="button" class="btn-check check-yes" data-value="yes">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn-check check-no" data-value="no">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="check-description">
                                Foto, video, atau dokumen pendukung tersedia dan relevan
                            </div>
                            <input type="hidden" name="verification_checks[bukti]" value="">
                        </div>

                        <!-- Item 6: Identitas Terlapor -->
                        <div class="check-item" data-field="terlapor">
                            <div class="check-header">
                                <div class="check-label">
                                    <i class="bi bi-person-x"></i> Identitas Terlapor
                                </div>
                                <div class="check-buttons">
                                    <button type="button" class="btn-check check-yes" data-value="yes">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn-check check-no" data-value="no">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="check-description">
                                Status: {{ $pengaduan->identitas_diketahui === 'ya' ? 'Diketahui' : 'Tidak Diketahui' }}
                            </div>
                            <input type="hidden" name="verification_checks[terlapor]" value="">
                        </div>

                        <!-- Item 7: Jenis Pelanggaran -->
                        <div class="check-item" data-field="pelanggaran">
                            <div class="check-header">
                                <div class="check-label">
                                    <i class="bi bi-exclamation-octagon"></i> Jenis Pelanggaran Sesuai
                                </div>
                                <div class="check-buttons">
                                    <button type="button" class="btn-check check-yes" data-value="yes">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn-check check-no" data-value="no">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="check-description">
                                Kategori pelanggaran yang dilaporkan sesuai dengan uraian kejadian
                            </div>
                            <input type="hidden" name="verification_checks[pelanggaran]" value="">
                        </div>
                    </div>

                    <!-- Summary Box -->
                    <div class="summary-box">
                        <h5><i class="bi bi-graph-up"></i> Ringkasan Verifikasi</h5>
                        <div class="summary-stats">
                            <div class="stat-item">
                                <span class="stat-number green" id="checkedCount">0</span>
                                <div class="stat-label">Sesuai</div>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number red" id="uncheckedCount">0</span>
                                <div class="stat-label">Tidak Sesuai</div>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number" id="totalCount">7</span>
                                <div class="stat-label">Total Item</div>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="notes-section">
                        <label for="verification_notes">
                            <i class="bi bi-pencil-square"></i> Catatan Verifikasi / Perbaikan yang Diperlukan
                        </label>
                        <textarea 
                            id="verification_notes" 
                            name="verification_notes" 
                            placeholder="Tuliskan catatan verifikasi atau hal-hal yang perlu diperbaiki oleh pelapor..."
                        ></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="button" class="btn-action btn-back" onclick="window.history.back()">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </button>
                        <button type="submit" name="action" value="reject" class="btn-action btn-reject" id="btnReject">
                            <i class="bi bi-x-circle"></i> Bukti Kurang / Kembalikan
                        </button>
                        <button type="submit" name="action" value="approve" class="btn-action btn-approve" id="btnApprove">
                            <i class="bi bi-check-circle"></i> Lanjutkan Proses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkItems = document.querySelectorAll('.check-item');
            const form = document.getElementById('verificationForm');
            const btnApprove = document.getElementById('btnApprove');
            const btnReject = document.getElementById('btnReject');
            
            // Handle check/uncheck buttons
            checkItems.forEach(item => {
                const yesBtn = item.querySelector('.check-yes');
                const noBtn = item.querySelector('.check-no');
                const hiddenInput = item.querySelector('input[type="hidden"]');
                
                yesBtn.addEventListener('click', function() {
                    yesBtn.classList.add('active-yes');
                    noBtn.classList.remove('active-no');
                    item.classList.add('checked');
                    item.classList.remove('unchecked');
                    hiddenInput.value = 'yes';
                    updateSummary();
                });
                
                noBtn.addEventListener('click', function() {
                    noBtn.classList.add('active-no');
                    yesBtn.classList.remove('active-yes');
                    item.classList.add('unchecked');
                    item.classList.remove('checked');
                    hiddenInput.value = 'no';
                    updateSummary();
                });
            });
            
            // Update summary statistics
            function updateSummary() {
                const allChecks = document.querySelectorAll('input[name^="verification_checks"]');
                let yesCount = 0;
                let noCount = 0;
                
                allChecks.forEach(input => {
                    if (input.value === 'yes') yesCount++;
                    if (input.value === 'no') noCount++;
                });
                
                document.getElementById('checkedCount').textContent = yesCount;
                document.getElementById('uncheckedCount').textContent = noCount;
            }
            
            // Form validation
            form.addEventListener('submit', function(e) {
                const allChecks = document.querySelectorAll('input[name^="verification_checks"]');
                let allFilled = true;
                
                allChecks.forEach(input => {
                    if (!input.value) {
                        allFilled = false;
                    }
                });
                
                if (!allFilled) {
                    e.preventDefault();
                    alert('Harap verifikasi semua item sebelum melanjutkan!');
                    return false;
                }
                
                // Confirm action
                const actionBtn = e.submitter;
                let message = '';
                
                if (actionBtn.value === 'approve') {
                    message = 'Apakah Anda yakin ingin melanjutkan pengaduan ini ke tahap Tindak Lanjut?';
                } else {
                    message = 'Apakah Anda yakin ingin mengembalikan pengaduan ini ke pelapor untuk perbaikan?';
                }
                
                if (!confirm(message)) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
</body>
</html>