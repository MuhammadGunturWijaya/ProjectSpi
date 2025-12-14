@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <line x1="19" y1="8" x2="19" y2="14"></line>
                            <line x1="22" y1="11" x2="16" y2="11"></line>
                        </svg>
                    </div>
                </div>
                <h2 class="form-title mb-2">Tambah Pengurus SPI</h2>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-body p-4 p-md-5">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-modern">
                            <div class="d-flex align-items-start">
                                <svg class="me-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                <div class="flex-grow-1">
                                    <strong class="d-block mb-2">Terdapat kesalahan:</strong>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Nama Field -->
                        <div class="mb-4">
                            <label for="nama" class="form-label">
                                <span class="label-icon">👤</span> Nama Lengkap
                            </label>
                            <div class="input-group input-group-modern">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <input type="text" 
                                       class="form-control form-control-modern border-start-0 ps-0" 
                                       id="nama" 
                                       name="nama" 
                                       placeholder="Contoh: Ahmad Fauzi" 
                                       required>
                            </div>
                        </div>

                        <!-- Jabatan Field -->
                        <div class="mb-4">
                            <label for="jabatan" class="form-label">
                                <span class="label-icon">💼</span> Jabatan
                            </label>
                            <div class="input-group input-group-modern">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg>
                                </span>
                                <input type="text" 
                                       class="form-control form-control-modern border-start-0 ps-0" 
                                       id="jabatan" 
                                       name="jabatan" 
                                       placeholder="Contoh: Ketua / Sekretaris / Bendahara" 
                                       required>
                            </div>
                        </div>

                        <!-- Foto Field -->
                        <div class="mb-5">
                            <label for="foto" class="form-label">
                                <span class="label-icon">📷</span> Foto Profil
                            </label>
                            <div class="upload-area" id="uploadArea">
                                <input type="file" 
                                       class="form-control d-none" 
                                       id="foto" 
                                       name="foto" 
                                       accept="image/*">
                                <div class="upload-content text-center">
                                    <svg class="upload-icon mb-3" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    <p class="mb-2"><strong>Klik untuk upload</strong> atau drag & drop</p>
                                    <p class="text-muted small mb-0">PNG, JPG, JPEG, GIF (Maks. 2MB)</p>
                                </div>
                                <div class="preview-container d-none">
                                    <img id="imagePreview" src="" alt="Preview" class="preview-image">
                                    <button type="button" class="btn-remove-image" id="removeImage">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 flex-column flex-sm-row">
                            <a href="{{ route('struktur.index') }}" class="btn btn-outline-secondary btn-modern flex-fill order-2 order-sm-1">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-modern flex-fill order-1 order-sm-2">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Color Variables */
    :root {
        --primary-color: #3b82f6;
        --primary-dark: #2563eb;
        --secondary-color: #64748b;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Icon Wrapper */
    .icon-wrapper .icon-circle {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        box-shadow: var(--shadow-lg);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Form Title */
    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffffff;
        letter-spacing: -0.5px;
    }

    /* Form Card */
    .form-card {
        border: none;
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        background: white;
        transition: all 0.3s ease;
    }

    .form-card:hover {
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }

    /* Form Label */
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }

    .label-icon {
        margin-right: 8px;
        font-size: 1.1rem;
    }

    /* Modern Input Group */
    .input-group-modern {
        border: 2px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
    }

    .input-group-modern:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        transform: translateY(-2px);
    }

    .input-group-modern .input-group-text {
        border: none;
        color: var(--secondary-color);
        padding: 0.75rem 1rem;
    }

    .form-control-modern {
        border: none;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        background: transparent;
    }

    .form-control-modern:focus {
        box-shadow: none;
        background: transparent;
    }

    .form-control-modern::placeholder {
        color: #94a3b8;
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--light-bg);
        position: relative;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .upload-area:hover {
        border-color: var(--primary-color);
        background: rgba(59, 130, 246, 0.05);
        transform: translateY(-2px);
    }

    .upload-icon {
        color: var(--primary-color);
        opacity: 0.8;
    }

    .upload-content p strong {
        color: var(--primary-color);
    }

    /* Preview Container */
    .preview-container {
        position: relative;
        width: 100%;
    }

    .preview-image {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: var(--shadow-md);
    }

    .btn-remove-image {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(239, 68, 68, 0.95);
        border: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-md);
    }

    .btn-remove-image:hover {
        background: var(--danger-color);
        transform: scale(1.1);
    }

    /* Modern Buttons */
    .btn-modern {
        padding: 0.875rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 12px;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary.btn-modern {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
    }

    .btn-primary.btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -5px rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, var(--primary-dark) 0%, #1d4ed8 100%);
    }

    .btn-outline-secondary.btn-modern {
        background: white;
        border: 2px solid var(--border-color);
        color: var(--secondary-color);
    }

    .btn-outline-secondary.btn-modern:hover {
        background: var(--light-bg);
        border-color: var(--secondary-color);
        transform: translateY(-2px);
    }

    .btn-modern svg {
        flex-shrink: 0;
    }

    /* Alert Modern */
    .alert-modern {
        border-radius: 12px;
        border: none;
        box-shadow: var(--shadow-sm);
    }

    .alert-danger.alert-modern {
        background: #fef2f2;
        color: #991b1b;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .form-title {
            font-size: 1.5rem;
        }
        
        .icon-circle {
            width: 60px;
            height: 60px;
        }
        
        .icon-circle svg {
            width: 30px;
            height: 30px;
        }
        
        .form-card .card-body {
            padding: 1.5rem !important;
        }
        
        .upload-area {
            padding: 1.5rem;
            min-height: 180px;
        }
        
        .btn-modern {
            padding: 0.75rem 1.5rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('foto');
    const uploadContent = uploadArea.querySelector('.upload-content');
    const previewContainer = uploadArea.querySelector('.preview-container');
    const imagePreview = document.getElementById('imagePreview');
    const removeButton = document.getElementById('removeImage');

    // Click to upload
    uploadArea.addEventListener('click', function(e) {
        if (!e.target.closest('.btn-remove-image')) {
            fileInput.click();
        }
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = 'var(--primary-color)';
        uploadArea.style.background = 'rgba(59, 130, 246, 0.1)';
    });

    uploadArea.addEventListener('dragleave', function() {
        uploadArea.style.borderColor = 'var(--border-color)';
        uploadArea.style.background = 'var(--light-bg)';
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = 'var(--border-color)';
        uploadArea.style.background = 'var(--light-bg)';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    });

    // File input change
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    // Remove image
    removeButton.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.value = '';
        uploadContent.classList.remove('d-none');
        previewContainer.classList.add('d-none');
        imagePreview.src = '';
    });

    function handleFileSelect(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                uploadContent.classList.add('d-none');
                previewContainer.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
@endsection