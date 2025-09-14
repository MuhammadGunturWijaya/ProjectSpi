<footer class="footer">
    <div class="footer-container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('landingpage') }}">
            <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" class="footer-logo">
        </a>
        <p class="footer-text">
            Satuan Pengawas Internal Politeknik Negeri Jember <br>
            Jl. Mastrip PO BOX 164, Jember - Jawa Timur, Indonesia
        </p>

        <p class="footer-contact">
            <a href="mailto:politeknik@polije.ac.id" class="footer-link">
                politeknik@polije.ac.id
            </a>
            <span class="separator">|</span>
            <span class="footer-phone">+62 331 333533, +62 331 333531</span>
        </p>

        <div class="footer-social">
            <a href="#" class="social-link facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-link instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-link twitter" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>

        <div class="footer-copy">
            &copy; 2025 Politeknik Negeri Jember. All rights reserved.
        </div>
    </div>
</footer>

<style>
    /* Reset some basics */
    .footer {
        background: linear-gradient(135deg, #0d2d50, #134a85);
        color: #f0f4f8;
        text-align: center;
        padding: 50px 20px 30px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    /* Subtle animated background shapes */
    .footer::before,
    .footer::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        opacity: 0.15;
        filter: blur(80px);
        animation: float 15s ease-in-out infinite;
        z-index: 0;
    }

    .footer::before {
        width: 300px;
        height: 300px;
        background: #ffd700;
        top: -100px;
        left: -100px;
        animation-delay: 0s;
    }

    .footer::after {
        width: 400px;
        height: 400px;
        background: #134a85;
        bottom: -150px;
        right: -150px;
        animation-delay: 7.5s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) translateX(0);
        }

        50% {
            transform: translateY(20px) translateX(20px);
        }
    }

    .footer-container {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .footer-logo {
        display: block;
        /* ubah gambar jadi block supaya bisa auto margin */
        margin: 0 auto 20px;
        max-height: 90px;
        filter: drop-shadow(0 0 5px rgba(255, 215, 0, 0.7));
        transition: transform 0.4s ease, filter 0.4s ease;
        cursor: pointer;
    }

    .footer-logo:hover {
        transform: scale(1.1) rotate(5deg);
        filter: drop-shadow(0 0 15px rgba(255, 215, 0, 1));
    }

    .footer-text {
        font-size: 1.1rem;
        margin-bottom: 12px;
        line-height: 1.7;
        font-weight: 500;
        text-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .footer-contact {
        margin-bottom: 25px;
        font-size: 1rem;
        font-weight: 400;
        color: #e0e7ff;
        text-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    }

    .footer-link {
        color: #ffd700;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }

    .footer-link:hover {
        color: #fff176;
        text-decoration: underline;
        text-shadow: 0 0 8px #fff176;
    }

    .separator {
        margin: 0 10px;
        color: #bbb;
    }

    .footer-phone {
        font-weight: 600;
        letter-spacing: 0.03em;
    }

    .footer-social {
        margin-top: 20px;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 12px;
        font-size: 1.5rem;
        color: #ffd700;
        background: rgba(255, 215, 0, 0.15);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        box-shadow: 0 0 8px rgba(255, 215, 0, 0.4);
        transition: background 0.4s ease, color 0.4s ease, transform 0.3s ease, box-shadow 0.4s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .social-link:hover {
        background: #fff176;
        color: #0d2d50;
        transform: scale(1.2) rotate(10deg);
        box-shadow: 0 0 20px #fff176;
    }

    /* Different brand colors on hover */
    .social-link.facebook:hover {
        background: #3b5998;
        color: #fff;
        box-shadow: 0 0 20px #3b5998;
    }

    .social-link.instagram:hover {
        background: #e4405f;
        color: #fff;
        box-shadow: 0 0 20px #e4405f;
    }

    .social-link.twitter:hover {
        background: #1da1f2;
        color: #fff;
        box-shadow: 0 0 20px #1da1f2;
    }

    .footer-copy {
        margin-top: 30px;
        font-size: 0.9rem;
        color: #bbb;
        font-weight: 400;
        letter-spacing: 0.05em;
        text-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
    }

    /* Responsive */
    @media (max-width: 600px) {

        .footer-text,
        .footer-contact {
            font-size: 0.95rem;
        }

        .social-link {
            width: 38px;
            height: 38px;
            font-size: 1.3rem;
            margin: 0 8px;
        }

        .footer-logo {
            max-height: 70px;
            margin-bottom: 15px;
        }
    }
</style>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />