 <style>
 /* Footer */
        footer {
            background: linear-gradient(135deg, #1c2833 0%, #0d2d50 100%);
            color: white;
            padding: 60px 0 30px;
        }

        .footer-logo {
            max-height: 100px;
            margin-bottom: 20px;
        }

        .footer-section h4 {
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.3rem;
            color: white;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: white;
            padding-left: 10px;
        }
        </style>

<!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" class="footer-logo">
                    <p class="mt-3">Satuan Pengawas Internal Politeknik Negeri Jember berkomitmen untuk menjaga
                        integritas dan akuntabilitas institusi melalui pengawasan yang profesional dan independen.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="footer-section">
                        <h4>Tautan Cepat</h4>
                        <a href="{{ route('sejarah') }}" class="footer-link">Sejarah</a>
                        <a href="{{ route('visi-misi.index') }}" class="footer-link">Visi & Misi</a>
                        <a href="{{ route('struktur.index') }}" class="footer-link">Struktur Organisasi</a>
                        <a href="{{ route('sdm.index') }}" class="footer-link">SDM</a>
                        <a href="{{ route('piagam.index') }}" class="footer-link">Piagam SPI</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="footer-section">
                        <h4>Kontak Kami</h4>
                        <p><i class="bi bi-geo-alt-fill me-2" style="color: var(--secondary);"></i>Jl. Mastrip PO BOX
                            164<br>Jember, Jawa Timur, Indonesia</p>
                        <p><i class="bi bi-envelope-fill me-2" style="color: var(--secondary);"></i>
                            <a href="mailto:politeknik@polije.ac.id"
                                class="text-white text-decoration-none">politeknik@polije.ac.id</a>
                        </p>
                        <p><i class="bi bi-telephone-fill me-2" style="color: var(--secondary);"></i>+62 331 333533</p>
                        <p><i class="bi bi-telephone-fill me-2" style="color: var(--secondary);"></i>+62 331 333531</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <p class="mb-0" style="color: rgba(255,255,255,0.7);">© 2025 Satuan Pengawas Internal - Politeknik
                    Negeri Jember. All Rights Reserved.</p>
            </div>
        </div>
    </footer>




<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />