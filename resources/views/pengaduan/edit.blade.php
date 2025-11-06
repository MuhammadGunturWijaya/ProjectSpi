@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="edit-card mx-auto" style="max-width: 1000px;">

            {{-- Alert jika ada field yang perlu diperbaiki --}}
            @if(!empty($fieldsToFix) && count($fieldsToFix) > 0)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Perhatian: {{ count($fieldsToFix) }} Field Perlu Diperbaiki
                    </h5>
                    <p>
                        Field yang ditandai dengan <span class="badge bg-danger">⚠️ PERBAIKI</span>
                        perlu Anda perbaiki sesuai catatan admin.
                    </p>
                    <hr>
                    <p class="mb-0">
                        <small>
                            <strong>Catatan Admin:</strong><br>
                            {{ $pengaduan->rejection_reason ?? 'Tidak ada catatan khusus.' }}
                        </small>
                    </p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @else
                <div class="alert alert-info">
                    Semua field sudah benar. Tidak ada yang perlu diperbaiki.
                </div>
            @endif

            {{-- Header --}}
            <div class="page-header mb-4">
                <h1><i class="bi bi-pencil-square"></i> Perbaiki Pengaduan</h1>
                <p class="subtitle">Lengkapi form di bawah ini sesuai catatan admin</p>
            </div>

            {{-- Form --}}
            <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @php
                    function needsFix($field, $fieldsToFix)
                    {
                        return in_array($field, $fieldsToFix);
                    }
                @endphp

                {{-- Data Dasar --}}
                <div class="form-section">
                    <div class="section-header">
                        <h4><i class="bi bi-file-text"></i> Data Dasar Pengaduan</h4>
                    </div>

                    {{-- Tanggal Pengaduan --}}
                    @if(needsFix('tanggal_pengaduan', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Tanggal Pengaduan <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <input type="date" name="tanggal_pengaduan"
                                class="form-control @error('tanggal_pengaduan') is-invalid @enderror"
                                value="{{ old('tanggal_pengaduan', $pengaduan->tanggal_pengaduan) }}" required>
                            @error('tanggal_pengaduan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    {{-- Perihal --}}
                    @if(needsFix('perihal', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Perihal <span class="badge bg-danger ms-2">⚠️ PERBAIKI</span></label>
                            <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror"
                                value="{{ old('perihal', $pengaduan->perihal) }}" placeholder="Masukkan perihal pengaduan"
                                required>
                            @error('perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    {{-- Uraian --}}
                    @if(needsFix('uraian', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Uraian Pengaduan <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <textarea name="uraian" class="form-control @error('uraian') is-invalid @enderror" rows="5"
                                placeholder="Jelaskan secara detail pengaduan Anda"
                                required>{{ old('uraian', $pengaduan->uraian) }}</textarea>
                            @error('uraian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>

                {{-- Informasi Pendukung --}}
                <div class="form-section">
                    <div class="section-header">
                        <h4><i class="bi bi-person-badge"></i> Informasi Pendukung</h4>
                    </div>

                    @if(needsFix('usia', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Usia <span class="badge bg-danger ms-2">⚠️</span></label>
                            <input type="number" name="usia" class="form-control" value="{{ old('usia', $pengaduan->usia) }}"
                                required>
                        </div>
                    @endif

                    @if(needsFix('pendidikan', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Pendidikan <span class="badge bg-danger ms-2">⚠️</span></label>
                            <select name="pendidikan" class="form-select" required>
                                <option value="">Pilih...</option>
                                @foreach(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3'] as $level)
                                    <option value="{{ $level }}" {{ old('pendidikan', $pengaduan->pendidikan) == $level ? 'selected' : '' }}>{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if(needsFix('pekerjaan', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Pekerjaan <span class="badge bg-danger ms-2">⚠️</span></label>
                            <input type="text" name="pekerjaan" class="form-control"
                                value="{{ old('pekerjaan', $pengaduan->pekerjaan) }}" required>
                        </div>
                    @endif

                    {{-- Waktu Hubung --}}
                    @if(needsFix('waktu_hubung', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Waktu Terbaik untuk Dihubungi <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <input type="text" name="waktu_hubung"
                                class="form-control @error('waktu_hubung') is-invalid @enderror"
                                value="{{ old('waktu_hubung', $pengaduan->waktu_hubung) }}"
                                placeholder="Contoh: Senin-Jumat, 10:00 - 15:00">
                            @error('waktu_hubung')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif



                    {{-- Detail Kejadian dan Pihak Terkait --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h4><i class="bi bi-calendar-event"></i> Detail Kejadian dan Pihak Terkait</h4>
                        </div>

                        {{-- Tanggal Kejadian --}}
                        @if(needsFix('tanggal_kejadian', $fieldsToFix))
                            <div class="mb-3 field-wrapper needs-fix">
                                <label class="form-label">Tanggal Kejadian <span class="badge bg-danger ms-2">⚠️
                                        PERBAIKI</span></label>
                                <input type="date" name="tanggal_kejadian"
                                    class="form-control @error('tanggal_kejadian') is-invalid @enderror"
                                    value="{{ old('tanggal_kejadian', $pengaduan->tanggal_kejadian) }}" required>
                                @error('tanggal_kejadian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        {{-- Jam Kejadian --}}
                        @if(needsFix('jam_kejadian', $fieldsToFix))
                            <div class="mb-3 field-wrapper needs-fix">
                                <label class="form-label">Jam Kejadian <span class="badge bg-danger ms-2">⚠️
                                        PERBAIKI</span></label>
                                <input type="time" name="jam_kejadian"
                                    class="form-control @error('jam_kejadian') is-invalid @enderror"
                                    value="{{ old('jam_kejadian', $pengaduan->jam_kejadian) }}">
                                @error('jam_kejadian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        {{-- Tempat Kejadian --}}
                        @if(needsFix('tempat_kejadian', $fieldsToFix))
                            <div class="mb-3 field-wrapper needs-fix">
                                <label class="form-label">Tempat Kejadian <span class="badge bg-danger ms-2">⚠️
                                        PERBAIKI</span></label>
                                <textarea name="tempat_kejadian"
                                    class="form-control @error('tempat_kejadian') is-invalid @enderror" rows="3"
                                    placeholder="Jelaskan lokasi kejadian">{{ old('tempat_kejadian', $pengaduan->tempat_kejadian) }}</textarea>
                                @error('tempat_kejadian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif


                    </div>

                    {{-- Detail Pelanggaran (Menggunakan asumsi sebagai checkbox/multiple input) --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h4><i class="bi bi-exclamation-octagon"></i> Detail Pelanggaran</h4>
                        </div>

                        {{-- Pelanggaran 0 (Contoh Select) --}}
                        @if(needsFix('pelanggaran_0', $fieldsToFix))
                            <div class="mb-3 field-wrapper needs-fix">
                                <label class="form-label">Jenis Pelanggaran Utama <span class="badge bg-danger ms-2">⚠️
                                        PERBAIKI</span></label>
                                {{-- Asumsi Anda memiliki daftar opsi pelanggaran yang valid --}}
                                <select name="pelanggaran_0" class="form-select @error('pelanggaran_0') is-invalid @enderror">
                                    <option value="">Pilih Jenis Pelanggaran</option>
                                    @foreach(['Kekerasan', 'Diskriminasi', 'Pelecehan'] as $jenis)
                                        <option value="{{ $jenis }}" {{ old('pelanggaran_0', $pengaduan->pelanggaran_0) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                                    @endforeach
                                </select>
                                @error('pelanggaran_0')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        {{-- Pelanggaran 1 (Contoh Input Teks) --}}
                        @if(needsFix('pelanggaran_1', $fieldsToFix))
                            <div class="mb-3 field-wrapper needs-fix">
                                <label class="form-label">Detail Pelanggaran Tambahan <span class="badge bg-danger ms-2">⚠️
                                        PERBAIKI</span></label>
                                <input type="text" name="pelanggaran_1"
                                    class="form-control @error('pelanggaran_1') is-invalid @enderror"
                                    value="{{ old('pelanggaran_1', $pengaduan->pelanggaran_1) }}"
                                    placeholder="Tambahkan detail pelanggaran lain">
                                @error('pelanggaran_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        {{-- Pelanggaran Lain --}}
                        @if(needsFix('pelanggaran_lain', $fieldsToFix))
                            <div class="mb-3 field-wrapper needs-fix">
                                <label class="form-label">Keterangan Pelanggaran Lainnya <span class="badge bg-danger ms-2">⚠️
                                        PERBAIKI</span></label>
                                <textarea name="pelanggaran_lain"
                                    class="form-control @error('pelanggaran_lain') is-invalid @enderror" rows="2"
                                    placeholder="Jika ada keterangan tambahan...">{{ old('pelanggaran_lain', $pengaduan->pelanggaran_lain) }}</textarea>
                                @error('pelanggaran_lain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>

                    {{-- Data Terlapor dan Identitas --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h4><i class="bi bi-person-x"></i> Data Terlapor</h4>
                        </div>

                        @php
                            // Decode data terlapor dari database
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

                            // Cek apakah ada terlapor yang perlu diperbaiki
                            $terlaporNeedsFix = false;
                            foreach ($fieldsToFix as $field) {
                                if (strpos($field, 'terlapor_') === 0) {
                                    $terlaporNeedsFix = true;
                                    break;
                                }
                            }
                        @endphp

                        @if($terlaporNeedsFix)
                            <div class="alert alert-warning mb-3">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <strong>Data Terlapor Perlu Diperbaiki!</strong><br>
                                Silakan periksa dan perbaiki data terlapor yang ditandai dengan warna merah.
                            </div>

                            <div id="terlaporContainer">
                                @foreach($terlapors as $index => $terlapor)
                                    @php
                                        $needsFixThisRow = in_array("terlapor_{$index}", $fieldsToFix);
                                    @endphp

                                    <div class="terlapor-row {{ $needsFixThisRow ? 'needs-fix' : '' }}" data-index="{{ $index }}">
                                        @if($needsFixThisRow)
                                            <div class="row-header-fix">
                                                <span class="badge bg-danger">⚠️ PERBAIKI - Terlapor #{{ $index + 1 }}</span>
                                            </div>
                                        @else
                                            <div class="row-header">
                                                <span class="badge bg-secondary">Terlapor #{{ $index + 1 }}</span>
                                            </div>
                                        @endif

                                        <div class="row g-3">
                                            {{-- Nama --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                                <input type="text" name="terlapor[{{ $index }}][nama]"
                                                    class="form-control @error('terlapor.' . $index . '.nama') is-invalid @enderror"
                                                    value="{{ old('terlapor.' . $index . '.nama', $terlapor['nama'] ?? '') }}"
                                                    placeholder="Masukkan nama terlapor" required>
                                                @error('terlapor.' . $index . '.nama')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- NIP --}}
                                            <div class="col-md-6">
                                                <label class="form-label">NIP <span class="text-danger">*</span></label>
                                                <input type="text" name="terlapor[{{ $index }}][nip]"
                                                    class="form-control @error('terlapor.' . $index . '.nip') is-invalid @enderror"
                                                    value="{{ old('terlapor.' . $index . '.nip', $terlapor['nip'] ?? '') }}"
                                                    placeholder="Masukkan NIP" required>
                                                @error('terlapor.' . $index . '.nip')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Satuan Kerja --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Satuan Kerja <span class="text-danger">*</span></label>
                                                <input type="text" name="terlapor[{{ $index }}][satuan_kerja]"
                                                    class="form-control @error('terlapor.' . $index . '.satuan_kerja') is-invalid @enderror"
                                                    value="{{ old('terlapor.' . $index . '.satuan_kerja', $terlapor['satuan_kerja'] ?? '') }}"
                                                    placeholder="Masukkan satuan kerja" required>
                                                @error('terlapor.' . $index . '.satuan_kerja')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Jabatan --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                                                <input type="text" name="terlapor[{{ $index }}][jabatan]"
                                                    class="form-control @error('terlapor.' . $index . '.jabatan') is-invalid @enderror"
                                                    value="{{ old('terlapor.' . $index . '.jabatan', $terlapor['jabatan'] ?? '') }}"
                                                    placeholder="Masukkan jabatan" required>
                                                @error('terlapor.' . $index . '.jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Jenis Kelamin --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                                <select name="terlapor[{{ $index }}][jenis_kelamin]"
                                                    class="form-select @error('terlapor.' . $index . '.jenis_kelamin') is-invalid @enderror"
                                                    required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="Laki-laki" {{ old('terlapor.' . $index . '.jenis_kelamin', $terlapor['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                                        Laki-laki</option>
                                                    <option value="Perempuan" {{ old('terlapor.' . $index . '.jenis_kelamin', $terlapor['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                                @error('terlapor.' . $index . '.jenis_kelamin')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- Tampilan Read-Only jika tidak perlu diperbaiki --}}
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle-fill"></i>
                                Data terlapor sudah benar dan tidak perlu diperbaiki.
                            </div>

                            @if(count($terlapors) > 0)
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Satuan Kerja</th>
                                            <th>Jabatan</th>
                                            <th>Jenis Kelamin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($terlapors as $index => $t)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $t['nama'] ?? '-' }}</td>
                                                <td>{{ $t['nip'] ?? '-' }}</td>
                                                <td>{{ $t['satuan_kerja'] ?? '-' }}</td>
                                                <td>{{ $t['jabatan'] ?? '-' }}</td>
                                                <td>{{ $t['jenis_kelamin'] ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">Tidak ada data terlapor</p>
                            @endif
                        @endif
                    </div>

                    <style>
                        .terlapor-row {
                            background: #ffffff;
                            border: 2px solid #dee2e6;
                            border-radius: 12px;
                            padding: 20px;
                            margin-bottom: 20px;
                            transition: all 0.3s ease;
                        }

                        .terlapor-row.needs-fix {
                            background: linear-gradient(135deg, #fff5f5, #ffe5e5);
                            border: 2px solid #dc3545;
                            animation: pulse-red 2s infinite;
                        }

                        .row-header {
                            margin-bottom: 15px;
                            padding-bottom: 10px;
                            border-bottom: 2px solid #dee2e6;
                        }

                        .row-header-fix {
                            margin-bottom: 15px;
                            padding-bottom: 10px;
                            border-bottom: 2px solid #dc3545;
                        }

                        .row-header .badge,
                        .row-header-fix .badge {
                            font-size: 0.9rem;
                            padding: 8px 15px;
                        }

                        @keyframes pulse-red {

                            0%,
                            100% {
                                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
                            }

                            50% {
                                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
                            }
                        }

                        /* Style untuk form controls */
                        .terlapor-row .form-control,
                        .terlapor-row .form-select {
                            border-radius: 8px;
                            border: 1px solid #ced4da;
                            padding: 10px 15px;
                        }

                        .terlapor-row.needs-fix .form-control,
                        .terlapor-row.needs-fix .form-select {
                            border-color: #dc3545;
                            background-color: #fff;
                        }

                        .terlapor-row .form-control:focus,
                        .terlapor-row .form-select:focus {
                            border-color: #667eea;
                            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
                        }

                        .terlapor-row.needs-fix .form-control:focus,
                        .terlapor-row.needs-fix .form-select:focus {
                            border-color: #dc3545;
                            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
                        }

                        /* Label styling */
                        .terlapor-row .form-label {
                            font-weight: 600;
                            color: #2d3748;
                            margin-bottom: 8px;
                        }

                        .terlapor-row.needs-fix .form-label {
                            color: #721c24;
                        }

                        /* Table styling untuk read-only view */
                        .table-bordered {
                            border-radius: 10px;
                            overflow: hidden;
                        }

                        .table-light th {
                            background: linear-gradient(135deg, #667eea, #764ba2);
                            color: white;
                            font-weight: 600;
                            text-transform: uppercase;
                            font-size: 0.85rem;
                            letter-spacing: 0.5px;
                        }
                    </style>

                    {{-- Identitas Diketahui --}}
                    @if(needsFix('identitas_diketahui', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Apakah Identitas Anda Diketahui? <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <select name="identitas_diketahui"
                                class="form-select @error('identitas_diketahui') is-invalid @enderror">
                                <option value="">Pilih...</option>
                                <option value="ya" {{ old('identitas_diketahui', $pengaduan->identitas_diketahui) == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ old('identitas_diketahui', $pengaduan->identitas_diketahui) == 'tidak' ? 'selected' : '' }}>Tidak (Anonim)</option>
                            </select>
                            @error('identitas_diketahui')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    {{-- Pihak Terkait --}}
                    @if(needsFix('pihak_terkait', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Pihak Terkait (Korban/Saksi/Lainnya) <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <input type="text" name="pihak_terkait"
                                class="form-control @error('pihak_terkait') is-invalid @enderror"
                                value="{{ old('pihak_terkait', $pengaduan->pihak_terkait) }}"
                                placeholder="Sebutkan pihak/institusi yang terkait">
                            @error('pihak_terkait')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>

                {{-- Informasi Kontak dan Bukti --}}
                <div class="form-section">
                    <div class="section-header">
                        <h4><i class="bi bi-phone"></i> Informasi Kontak dan Bukti</h4>
                    </div>



                    {{-- Kontak 0 (Nomor HP/WA) --}}
                    @if(needsFix('kontak_0', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Kontak Utama (Nomor HP/WA) <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <input type="text" name="kontak_0" class="form-control @error('kontak_0') is-invalid @enderror"
                                value="{{ old('kontak_0', $pengaduan->kontak_0) }}" placeholder="Cth: 08123456789">
                            @error('kontak_0')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    {{-- Kontak 1 (Email) --}}
                    @if(needsFix('kontak_1', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Kontak Alternatif (Email) <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <input type="email" name="kontak_1" class="form-control @error('kontak_1') is-invalid @enderror"
                                value="{{ old('kontak_1', $pengaduan->kontak_1) }}" placeholder="Cth: email@contoh.com">
                            @error('kontak_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    {{-- Kontak 2 (Kontak Lain) --}}
                    @if(needsFix('kontak_2', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Kontak Lain (Cth: Akun Telegram) <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <input type="text" name="kontak_2" class="form-control @error('kontak_2') is-invalid @enderror"
                                value="{{ old('kontak_2', $pengaduan->kontak_2) }}" placeholder="Cth: @akun_telegram">
                            @error('kontak_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    {{-- Bukti File 0 (Bukti Foto/Dokumen) --}}
                    @if(needsFix('bukti_file_0', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Unggah Bukti (Foto/Dokumen) <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <input type="file" name="bukti_file_0"
                                class="form-control @error('bukti_file_0') is-invalid @enderror">
                            <div class="form-text">File yang sudah diunggah sebelumnya akan diganti.</div>
                            @error('bukti_file_0')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    {{-- Link Video --}}
                    @if(needsFix('link_video', $fieldsToFix))
                        <div class="mb-3 field-wrapper needs-fix">
                            <label class="form-label">Link Video (Bukti Tambahan) <span class="badge bg-danger ms-2">⚠️
                                    PERBAIKI</span></label>
                            <input type="url" name="link_video" class="form-control @error('link_video') is-invalid @enderror"
                                value="{{ old('link_video', $pengaduan->link_video) }}"
                                placeholder="Masukkan URL video (misal: Google Drive/YouTube)">
                            @error('link_video')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
        </div>

        {{-- Submit Button --}}
        @if(!empty($fieldsToFix))
            <div class="d-flex gap-3 justify-content-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-circle"></i> Kirim Perbaikan
                </button>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary btn-lg">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        @endif
        </form>
    </div>
    </div>

    <style>
        .edit-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .form-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .section-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #dee2e6;
        }

        .field-wrapper.needs-fix {
            padding: 15px;
            background: linear-gradient(135deg, #fff5f5, #ffe5e5);
            border: 2px solid #dc3545;
            border-radius: 10px;
            margin-bottom: 20px;
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }
        }
    </style>
@endsection