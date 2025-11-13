@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <!-- Header dengan Gradient -->
                <div class="text-center mb-4">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="d-inline-block position-relative mb-3">
                                <div class="bg-gradient-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="bi bi-newspaper text-white" style="font-size: 2.5rem;"></i>
                                </div>
                            </div>
                            <h2 class="fw-bold mb-2" style="color: #2d3748; font-family: 'Poppins', sans-serif;">
                                Buat Berita Baru
                            </h2>
                            <p class="text-muted mb-0">Bagikan informasi terbaru dengan pembaca Anda</p>
                        @endif
                    @endauth
                </div>

                <!-- Card Utama -->
                <div class="card border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                    <!-- Decorative Top Bar -->
                    <div style="height: 6px; background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #f093fb 100%);"></div>
                    
                    <div class="card-body p-4 p-md-5">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 shadow-sm" style="background: #fee; border-left: 4px solid #dc3545 !important;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-exclamation-triangle-fill text-danger me-3" style="font-size: 1.5rem;"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-2">Terdapat kesalahan:</h6>
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Judul Berita -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold mb-2" style="color: #2d3748;">
                                    <i class="bi bi-pencil-square text-primary me-2"></i>Judul Berita
                                </label>
                                <input type="text" name="judul" 
                                       class="form-control form-control-lg border-2" 
                                       style="border-radius: 12px; border-color: #e2e8f0; transition: all 0.3s;"
                                       placeholder="Masukkan judul yang menarik perhatian..." 
                                       required
                                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102,126,234,0.1)'"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            </div>

                            <!-- Isi Berita -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold mb-2" style="color: #2d3748;">
                                    <i class="bi bi-card-text text-primary me-2"></i>Isi Berita
                                </label>
                                <textarea name="isi" rows="8" 
                                          class="form-control border-2" 
                                          style="border-radius: 12px; border-color: #e2e8f0; transition: all 0.3s; resize: vertical;"
                                          placeholder="Tulis konten berita secara lengkap dan informatif..." 
                                          required
                                          onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102,126,234,0.1)'"
                                          onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"></textarea>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>Minimal 50 karakter
                                </small>
                            </div>

                            <!-- Section Upload Gambar -->
                            <div class="mb-4 p-4 rounded-3" style="background: linear-gradient(135deg, #f6f8fb 0%, #f0f4f8 100%);">
                                <h6 class="fw-bold mb-3" style="color: #2d3748;">
                                    <i class="bi bi-image text-primary me-2"></i>Media Gambar
                                </h6>
                                
                                <!-- Upload dari File -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold mb-2" style="color: #4a5568; font-size: 0.95rem;">
                                        Upload dari Komputer
                                    </label>
                                    <div class="position-relative">
                                        <input type="file" 
                                               id="gambar-file" 
                                               name="gambar" 
                                               class="form-control border-2" 
                                               style="border-radius: 10px; border-color: #cbd5e0;"
                                               accept="image/jpeg,image/png,image/jpg">
                                        <div class="mt-2 d-flex align-items-center text-muted" style="font-size: 0.85rem;">
                                            <i class="bi bi-info-circle me-2"></i>
                                            <span>Format: JPG, PNG • Maksimal 2MB</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <div class="d-flex align-items-center my-3">
                                    <div class="flex-grow-1" style="height: 1px; background: #cbd5e0;"></div>
                                    <span class="px-3 text-muted small fw-semibold">ATAU</span>
                                    <div class="flex-grow-1" style="height: 1px; background: #cbd5e0;"></div>
                                </div>

                                <!-- URL Gambar -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold mb-2" style="color: #4a5568; font-size: 0.95rem;">
                                        Link URL Gambar
                                    </label>
                                    <input type="url" 
                                           id="gambar-url" 
                                           name="gambar_url" 
                                           class="form-control border-2" 
                                           style="border-radius: 10px; border-color: #cbd5e0;"
                                           placeholder="https://example.com/gambar.jpg">
                                    <div class="mt-2 d-flex align-items-center" style="font-size: 0.85rem;">
                                        <i class="bi bi-exclamation-circle text-warning me-2"></i>
                                        <span class="text-muted">Jika URL diisi, upload file akan diabaikan</span>
                                    </div>
                                </div>

                                <!-- Preview Gambar -->
                                <div class="mt-4 text-center">
                                    <img id="preview-gambar" 
                                         src="#" 
                                         alt="Preview Gambar"
                                         class="img-fluid shadow-sm" 
                                         style="max-width: 100%; max-height: 400px; display: none; border-radius: 16px; border: 3px solid #e2e8f0;">
                                    <div id="preview-placeholder" class="d-flex align-items-center justify-content-center" 
                                         style="height: 200px; background: #f7fafc; border: 2px dashed #cbd5e0; border-radius: 16px;">
                                        <div class="text-center text-muted">
                                            <i class="bi bi-image" style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0 small">Preview gambar akan muncul di sini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold mb-2" style="color: #2d3748;">
                                    <i class="bi bi-calendar-event text-primary me-2"></i>Tanggal Publikasi
                                </label>
                                <input type="date" 
                                       name="tanggal" 
                                       class="form-control form-control-lg border-2" 
                                       style="border-radius: 12px; border-color: #e2e8f0;"
                                       required>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mt-5 pt-4" 
                                 style="border-top: 2px solid #f0f4f8;">
                                <a href="{{ route('berita.index') }}" 
                                   class="btn btn-lg px-4 d-flex align-items-center justify-content-center gap-2" 
                                   style="border-radius: 12px; background: white; border: 2px solid #e2e8f0; color: #4a5568; font-weight: 600; transition: all 0.3s;"
                                   onmouseover="this.style.background='#f7fafc'; this.style.borderColor='#cbd5e0'"
                                   onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0'">
                                    <i class="bi bi-arrow-left-circle"></i>
                                    <span>Batal</span>
                                </a>
                                <button type="submit" 
                                        class="btn btn-lg px-5 d-flex align-items-center justify-content-center gap-2" 
                                        style="border-radius: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; font-weight: 600; box-shadow: 0 4px 12px rgba(102,126,234,0.4); transition: all 0.3s;"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(102,126,234,0.5)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(102,126,234,0.4)'">
                                    <i class="bi bi-check-circle"></i>
                                    <span>Publikasikan Berita</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview Gambar dari File Upload
        document.getElementById('gambar-file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview-gambar');
            const placeholder = document.getElementById('preview-placeholder');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });

        // Preview Gambar dari URL
        document.getElementById('gambar-url').addEventListener('input', function(e) {
            const url = e.target.value;
            const preview = document.getElementById('preview-gambar');
            const placeholder = document.getElementById('preview-placeholder');
            
            if (url) {
                preview.src = url;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
                
                preview.onerror = function() {
                    preview.style.display = 'none';
                    placeholder.style.display = 'flex';
                }
            } else {
                preview.style.display = 'none';
                placeholder.style.display = 'flex';
            }
        });
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(102,126,234,0.1) !important;
            border-color: #667eea !important;
        }

        .card {
            transition: transform 0.3s ease;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .alert {
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection