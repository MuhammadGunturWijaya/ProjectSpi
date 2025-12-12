@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .edit-wrapper {
        min-height: 100vh;
        padding: 40px 20px;
        position: relative;
    }

    .edit-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
        color: #475569;
        font-size: 14px;
    }

    .breadcrumb-nav a {
        color: #667eea;
        text-decoration: none;
        transition: color 0.3s;
        font-weight: 500;
    }

    .breadcrumb-nav a:hover {
        color: #764ba2;
    }

    .breadcrumb-separator {
        opacity: 0.5;
    }

    .card-modern {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
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

    .card-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 50px 60px;
        position: relative;
        overflow: hidden;
    }

    .card-header-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.3;
    }

    .header-content {
        position: relative;
        z-index: 1;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 12px;
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .card-header-modern h2 {
        color: white;
        font-size: 36px;
        font-weight: 700;
        margin: 0;
    }

    .card-header-modern p {
        color: rgba(255,255,255,0.9);
        font-size: 16px;
        margin: 0;
        padding-left: 76px;
    }

    .card-body-modern {
        padding: 60px;
    }

    .form-group-modern {
        margin-bottom: 30px;
    }

    .form-label-modern {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .label-icon {
        width: 20px;
        height: 20px;
        color: #667eea;
    }

    .input-wrapper {
        position: relative;
    }

    .form-control-modern {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8fafc;
        font-family: inherit;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    textarea.form-control-modern {
        resize: vertical;
        min-height: 160px;
        line-height: 1.8;
        font-size: 15px;
    }

    .input-helper {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #64748b;
        margin-top: 8px;
    }

    .helper-icon {
        width: 14px;
        height: 14px;
    }

    .info-card {
        background: linear-gradient(135deg, #f0f4ff 0%, #e9f0ff 100%);
        border-left: 4px solid #667eea;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .info-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: #667eea;
        margin-bottom: 8px;
    }

    .info-card-text {
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .divider {
        height: 2px;
        background: linear-gradient(to right, transparent, #e2e8f0, transparent);
        margin: 40px 0;
    }

    .btn-group-modern {
        display: flex;
        gap: 16px;
        justify-content: flex-end;
        padding-top: 20px;
        align-items: center;
    }

    .btn-modern {
        padding: 16px 40px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-modern:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-modern span {
        position: relative;
        z-index: 1;
    }

    .btn-icon {
        width: 20px;
        height: 20px;
        position: relative;
        z-index: 1;
    }

    .btn-primary-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
    }

    .btn-primary-modern:active {
        transform: translateY(-1px);
    }

    .btn-secondary-modern {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-secondary-modern:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
    }

    @media (max-width: 968px) {
        .card-header-modern {
            padding: 40px 30px;
        }

        .card-header-modern h2 {
            font-size: 28px;
        }

        .card-body-modern {
            padding: 40px 30px;
        }
    }

    @media (max-width: 768px) {
        .edit-wrapper {
            padding: 20px 15px;
        }

        .card-header-modern {
            padding: 30px 24px;
        }

        .card-header-modern h2 {
            font-size: 24px;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
        }

        .card-header-modern p {
            padding-left: 66px;
            font-size: 14px;
        }

        .card-body-modern {
            padding: 30px 24px;
        }

        .btn-group-modern {
            flex-direction: column-reverse;
        }

        .btn-modern {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="edit-wrapper">
    <div class="edit-container">
        <div class="breadcrumb-nav">
            <a href="{{ route('processes.index') }}">Proses</a>
            <span class="breadcrumb-separator">›</span>
            <span>Edit Langkah</span>
        </div>

        <div class="card-modern">
            <div class="card-header-modern">
                <div class="header-content">
                    <div class="header-title">
                        <div class="icon-circle">
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: white;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h2>Edit Langkah Proses Bisnis</h2>
                    </div>
                    <p>Perbarui informasi langkah proses bisnis</p>
                </div>
            </div>
            
            <div class="card-body-modern">
                <div class="info-card">
                    <div class="info-card-title">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Informasi
                    </div>
                    <div class="info-card-text">
                        Pastikan perubahan yang Anda lakukan sudah sesuai dengan kebutuhan. Informasi yang diperbarui akan langsung mempengaruhi tampilan proses bisnis.
                    </div>
                </div>

                <form action="{{ route('processes.update', $process->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group-modern">
                        <label class="form-label-modern" for="title">
                            <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Judul Langkah
                        </label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control-modern" id="title" name="title" value="{{ $process->title }}" required placeholder="Masukkan judul langkah proses">
                        </div>
                        <div class="input-helper">
                            <svg class="helper-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                            Buat judul yang singkat dan deskriptif
                        </div>
                    </div>
                    
                    <div class="form-group-modern">
                        <label class="form-label-modern" for="description">
                            <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            Deskripsi
                        </label>
                        <div class="input-wrapper">
                            <textarea class="form-control-modern" id="description" name="description" rows="6" required placeholder="Jelaskan detail langkah proses ini...">{{ $process->description }}</textarea>
                        </div>
                        <div class="input-helper">
                            <svg class="helper-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                            Berikan penjelasan yang jelas dan lengkap
                        </div>
                    </div>

                    <div class="divider"></div>
                    
                    <div class="btn-group-modern">
                        <a href="{{ route('processes.index') }}" class="btn-modern btn-secondary-modern">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Batal</span>
                        </a>
                        <button type="submit" class="btn-modern btn-primary-modern">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection