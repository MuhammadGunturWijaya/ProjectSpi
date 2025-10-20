<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi, Misi, dan Tujuan SPI POLIJE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0d2d50;
            --primary-light: #1a4d7a;
            --primary-dark: #051f35;
            --accent: #00d4ff;
            --accent-2: #ff6b9d;
            --accent-3: #ffa502;
            --text-dark: #1a1a1a;
            --text-light: #666;
            --bg-light: #f8f9fb;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, #0f0f1e 0%, #1a1a2e 50%, #16213e 100%);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: rgba(13, 45, 80, 0.95);
            backdrop-filter: blur(10px);
            padding: 1.2rem 0;
            border-bottom: 1px solid rgba(0, 212, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .navbar-custom .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 1px;
        }

        .navbar-custom .navbar-brand i {
            margin-right: 12px;
            font-size: 1.8rem;
        }

        /* ===== HERO SECTION ===== */
        .hero {
            position: relative;
            padding: 100px 20px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 50%, #2a6ba8 100%);
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 107, 157, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(40px) rotate(5deg);
            }
        }

        .hero-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            background-image:
                linear-gradient(0deg, transparent 24%, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.1) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.1) 75%, rgba(255, 255, 255, 0.1) 76%, transparent 77%, transparent),
                linear-gradient(90deg, transparent 24%, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.1) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.1) 75%, rgba(255, 255, 255, 0.1) 76%, transparent 77%, transparent);
            background-size: 50px 50px;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
            max-width: 900px;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 20px;
            line-height: 1.1;
            text-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideInDown 0.8s ease;
        }

        .hero-content .subtitle {
            font-size: 1.3rem;
            opacity: 0.95;
            font-weight: 300;
            margin-bottom: 30px;
            animation: slideInUp 0.8s ease 0.2s both;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(0, 212, 255, 0.2);
            border: 1px solid rgba(0, 212, 255, 0.4);
            color: #00d4ff;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            animation: slideInUp 0.8s ease 0.1s both;
            backdrop-filter: blur(10px);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            position: relative;
            z-index: 5;
        }

        .container-custom {
            max-width: 1200px;
            margin: -80px auto 0;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        /* ===== BREADCRUMB ===== */
        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin-bottom: 40px;
        }

        .breadcrumb-custom .breadcrumb-item a,
        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .breadcrumb-custom .breadcrumb-item a:hover {
            color: var(--accent);
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--primary);
            font-weight: 600;
        }

        /* ===== META INFO ===== */
        .meta-info {
            display: flex;
            gap: 30px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .meta-item i {
            font-size: 1.3rem;
            color: var(--accent);
        }

        /* ===== CARDS ===== */
        .card-intro {
            background: var(--white);
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 212, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
        }

        .card-intro::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--accent-2), var(--accent-3));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .card-intro:hover {
            transform: translateY(-10px);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.15);
        }

        .card-intro:hover::before {
            opacity: 1;
        }

        .card-intro p {
            text-align: justify;
            line-height: 1.9;
            color: var(--text-light);
            font-size: 1.05rem;
            margin-bottom: 20px;
            letter-spacing: 0.3px;
        }

        .card-intro p:last-child {
            margin-bottom: 0;
        }

        /* ===== SECTION CARDS ===== */
        .section-card {
            margin-bottom: 50px;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .section-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .section-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .section-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        /* ===== VISION CARD ===== */
        .vision-card {
            background: linear-gradient(135deg, #0d2d50 0%, #1a4d7a 100%);
            color: white;
            border-radius: 25px;
            padding: 60px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 212, 255, 0.2);
            box-shadow: 0 30px 80px rgba(13, 45, 80, 0.3);
            margin-bottom: 50px;
        }

        .vision-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .vision-card::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 107, 157, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        .vision-content {
            position: relative;
            z-index: 2;
        }

        .vision-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: rgba(0, 212, 255, 0.2);
            border-radius: 15px;
            font-size: 1.8rem;
            margin-bottom: 20px;
            border: 1px solid rgba(0, 212, 255, 0.3);
        }

        .vision-card h3 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 25px;
            letter-spacing: -0.5px;
        }

        .vision-card p {
            font-size: 1.1rem;
            line-height: 1.8;
            opacity: 0.95;
            letter-spacing: 0.3px;
        }

        /* ===== MISSION & TUJUAN CARDS ===== */
        .content-card {
            background: var(--white);
            border-radius: 25px;
            padding: 60px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 212, 255, 0.05);
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(0, 212, 255, 0.05) 0%, transparent 70%);
            transition: left 0.4s ease;
            pointer-events: none;
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.12);
        }

        .content-card:hover::before {
            left: 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title i {
            font-size: 2.5rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== LIST ITEMS ===== */
        .list-container {
            margin: 0;
        }

        .list-container ol {
            list-style: none;
            counter-reset: item;
            margin: 0;
            padding: 0;
        }

        .list-container li {
            counter-increment: item;
            margin-bottom: 35px;
            padding-left: 80px;
            position: relative;
        }

        .list-container li::before {
            content: counter(item);
            position: absolute;
            left: 0;
            top: 5px;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.3rem;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.3);
            transition: all 0.3s ease;
        }

        .list-container li:hover::before {
            transform: scale(1.1) rotateZ(5deg);
            box-shadow: 0 15px 40px rgba(0, 212, 255, 0.4);
        }

        .list-container li p {
            margin: 0;
            line-height: 1.8;
            color: var(--text-light);
            font-size: 1.05rem;
            letter-spacing: 0.3px;
        }

        /* ===== FOOTER ===== */
        footer {
            background: linear-gradient(135deg, #1c2833 0%, #0d2d50 100%);
            color: white;
            padding: 60px 0 30px;
            margin-top: 100px;
            border-top: 1px solid rgba(0, 212, 255, 0.1);
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

        footer p {
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.8;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content .subtitle {
                font-size: 1.1rem;
            }

            .hero {
                padding: 60px 20px;
                min-height: 350px;
            }

            .container-custom {
                margin: -60px auto 0;
                padding: 0 15px;
            }

            .card-intro,
            .content-card {
                padding: 35px 25px;
            }

            .vision-card {
                padding: 40px 25px;
            }

            .section-title {
                font-size: 1.6rem;
                gap: 10px;
            }

            .section-title i {
                font-size: 2rem;
            }

            .list-container li {
                padding-left: 70px;
            }

            .list-container li::before {
                width: 50px;
                height: 50px;
                font-size: 1.1rem;
            }

            .meta-info {
                gap: 20px;
            }

            .meta-item {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .card-intro,
            .content-card {
                padding: 25px 20px;
            }

            .list-container li {
                padding-left: 65px;
            }
        }
    </style>

    <!-- CSS Animations untuk Hero Section -->
    <style>
        /* ===== HERO SECTION ANIMATIONS ===== */

        /* Animasi Background - Gradient Shift */
        @keyframes bgGradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .hero {
            background: linear-gradient(-45deg, #0d2d50, #1a4d7a, #2a6ba8, #0d2d50);
            background-size: 400% 400%;
            animation: bgGradientShift 15s ease infinite;
        }

        /* Animasi Particle Effect - Floating Dust */
        @keyframes particleFloat {
            0% {
                opacity: 0;
                transform: translateY(100px) translateX(0);
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateY(-100vh) translateX(100px);
            }
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image:
                radial-gradient(2px 2px at 20px 30px, rgba(0, 212, 255, 0.5), transparent),
                radial-gradient(2px 2px at 60px 70px, rgba(255, 107, 157, 0.5), transparent),
                radial-gradient(1px 1px at 50px 50px, rgba(255, 165, 2, 0.5), transparent),
                radial-gradient(1px 1px at 130px 80px, rgba(0, 212, 255, 0.5), transparent);
            background-size: 200px 200px;
            animation: particleFloat 20s infinite linear;
            pointer-events: none;
        }

        /* Animasi Grid dengan Wave Effect */
        @keyframes gridWave {
            0% {
                transform: translateY(0);
                opacity: 0.05;
            }

            50% {
                opacity: 0.15;
            }

            100% {
                transform: translateY(-20px);
                opacity: 0.05;
            }
        }

        .hero-grid {
            animation: gridWave 6s ease-in-out infinite !important;
        }

        /* Animasi Orb Background - Multiple Floating */
        @keyframes orbFloat1 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(50px, -30px) scale(1.1);
            }

            50% {
                transform: translate(0, -60px) scale(0.9);
            }

            75% {
                transform: translate(-50px, -30px) scale(1.05);
            }
        }

        @keyframes orbFloat2 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(-60px, 40px) scale(0.95);
            }

            50% {
                transform: translate(0, 60px) scale(1.1);
            }

            75% {
                transform: translate(60px, 40px) scale(0.9);
            }
        }

        .hero::before {
            animation: orbFloat1 12s ease-in-out infinite !important;
        }

        /* Additional Orb Layer untuk efek lebih dalam */
        .hero-content::before {
            content: '';
            position: absolute;
            top: -50%;
            left: 30%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 107, 157, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: orbFloat2 14s ease-in-out infinite;
            pointer-events: none;
        }

        /* Light Ray Animation */
        @keyframes lightRay {
            0% {
                opacity: 0;
                transform: scaleY(0);
            }

            50% {
                opacity: 0.2;
            }

            100% {
                opacity: 0;
                transform: scaleY(1);
            }
        }

        /* Blur Background Intensity Pulse */
        @keyframes blurPulse {

            0%,
            100% {
                filter: blur(0px) brightness(1);
            }

            50% {
                filter: blur(1px) brightness(1.05);
            }
        }

        .hero {
            animation: bgGradientShift 15s ease infinite, blurPulse 4s ease-in-out infinite;
        }

        /* Vignette Effect dengan Animation */
        .hero {
            box-shadow: inset 0 0 120px rgba(0, 0, 0, 0.4), inset 0 0 60px rgba(0, 212, 255, 0.1);
        }

        /* Animasi Badge - Fade In + Scale */
        @keyframes badgePulse {
            0% {
                opacity: 0;
                transform: scale(0.8) translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .hero-badge {
            animation: badgePulse 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Animasi Title - Slide In Down */
        @keyframes titleSlideDown {
            0% {
                opacity: 0;
                transform: translateY(-60px);
                letter-spacing: 3px;
            }

            100% {
                opacity: 1;
                transform: translateY(0);
                letter-spacing: -0.5px;
            }
        }

        .hero-content h1 {
            animation: titleSlideDown 1s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
        }

        /* Animasi Subtitle - Fade In Up */
        @keyframes subtitleFadeInUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
                filter: blur(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        .hero-content .subtitle {
            animation: subtitleFadeInUp 1s ease-out 0.5s both;
        }

        /* Animasi Floating Circles - Infinite Float */
        @keyframes floatCircles {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(40px) rotate(5deg);
            }
        }

        .hero::before {
            animation: floatCircles 8s ease-in-out infinite;
        }

        .hero::after {
            animation: floatCircles 10s ease-in-out infinite reverse;
        }

        /* Animasi Grid Background - Subtle Pulse */
        @keyframes gridPulse {

            0%,
            100% {
                opacity: 0.05;
            }

            50% {
                opacity: 0.1;
            }
        }

        .hero-grid {
            animation: gridPulse 4s ease-in-out infinite;
        }

        /* Animasi Text Shimmer pada Title */
        @keyframes textShimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .hero-content h1 {
            background: linear-gradient(90deg, #ffffff, #00d4ff, #ffffff, #ff6b9d, #ffffff);
            background-size: 1000px 100%;
            background-position: 0 0;
            animation: titleSlideDown 1s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both,
                textShimmer 6s ease-in-out 1.2s infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Animasi Icon pada Badge - Rotate */
        @keyframes iconBounce {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-8px) rotate(10deg);
            }
        }

        .hero-badge i {
            display: inline-block;
            animation: iconBounce 1.5s ease-in-out infinite;
            margin-right: 8px;
        }

        /* Stagger Animation untuk Content */
        .hero-content {
            animation: heroContentFadeIn 1.2s ease-out;
        }

        @keyframes heroContentFadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Animasi Scroll Down Button - Bounce */
        @keyframes bounceArrow {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
                opacity: 1;
            }

            40% {
                transform: translateY(-20px);
                opacity: 0.7;
            }

            60% {
                transform: translateY(-10px);
                opacity: 0.8;
            }
        }

        .scroll-down-btn {
            animation: bounceArrow 2s infinite;
            display: inline-block;
        }

        /* Hover Effect pada Hero Content */
        .hero-content h1:hover {
            filter: drop-shadow(0 0 15px rgba(0, 212, 255, 0.6));
            transition: filter 0.3s ease;
        }

        /* Line Reveal Animation untuk Accent */
        @keyframes lineReveal {
            0% {
                width: 0;
                opacity: 0;
            }

            100% {
                width: 60px;
                opacity: 1;
            }
        }

        /* Optional: Add decorative line under subtitle */
        .hero-content .subtitle::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            margin: 20px auto 0;
            animation: lineReveal 1s ease-out 0.8s both;
            border-radius: 2px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-content h1 {
                animation: titleSlideDown 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
            }

            .hero-content .subtitle {
                animation: subtitleFadeInUp 0.8s ease-out 0.4s both;
            }

            .hero-badge {
                animation: badgePulse 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            }
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    @include('layouts.navbar')

    <!-- HTML HERO SECTION -->
    <section class="hero">
        <div class="hero-grid"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-rocket-takeoff"></i> Satuan Pengawasan Internal
            </div>
            <h1>Visi, Misi & Tujuan</h1>
            <p class="subtitle">Komitmen kami untuk Good Governance dan Profesionalisme</p>
            <a href="#carousel" class="scroll-down-btn">⌄</a>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">
        <div class="container-custom">
            <!-- BREADCRUMB -->
            <nav aria-label="breadcrumb" class="breadcrumb-custom" style="padding-top: 40px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" style="color: white;"><i class="bi bi-house"></i>
                            Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#" style="color: white;">Profil</a></li>
                    <li class="breadcrumb-item active" style="color: grey;">Visi, Misi, Tujuan</li>
                </ol>
            </nav>

            <!-- META INFO -->
            <div class="meta-info">
                <div class="meta-item">
                    <i class="bi bi-calendar-event"></i>
                    <span style="color: white;">10 Oktober 2025</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-clock"></i>
                    <span style="color: white;">14:17 WIB</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-person-badge"></i>
                    <span style="color: white;">Satuan Pengawasan Internal</span>
                </div>
            </div>

            <!-- TUJUAN -->
            <div class="card-intro section-card">
                <h2 class="section-title"><i class="bi bi-bullseye"></i> Tujuan</h2>
                <p>{!! $visimisi->tujuan ?? 'Belum ada data tujuan.' !!}</p>
            </div>

            <div class="content-card section-card">
                <h2 class="section-title"><i class="bi bi-eye"></i> Visi</h2>
                <div class="list-container">
                    @if($visimisi && $visimisi->visi)
                        <ol class="spaced-list"> {{-- Tambahkan class di sini --}}
                            @foreach(explode("\n", $visimisi->visi) as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>Belum ada data visi.</p>
                    @endif
                </div>
            </div>

            <div class="content-card section-card">
                <h2 class="section-title"><i class="bi bi-flag"></i> Misi</h2>
                <div class="list-container">
                    @if($visimisi && $visimisi->misi)
                        <ol class="spaced-list"> {{-- Tambahkan class di sini --}}
                            @foreach(explode("\n", $visimisi->misi) as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>Belum ada data misi.</p>
                    @endif
                </div>
            </div>

            <style>
                /* Untuk membuat item daftar lebih berjarak */
                .spaced-list li {
                    margin-bottom: 50px;
                    /* Jarak antar item */
                    line-height: 1.6;
                    /* Kerapatan baris (jika itemnya panjang) */
                }

                /* Untuk memastikan penomoran dan teks sejajar dengan baik */
                .list-container ol {
                    /* Atur ulang padding default browser jika diperlukan,
       biasanya padding-left-nya yang perlu diatur */
                    padding-left: 20px;
                    /* Sesuaikan angka ini agar penomoran terlihat rapi */
                }

                .list-container ol li {
                    /* Ini adalah default, tapi bisa membantu: */
                    list-style-position: outside;
                    padding-top: 10px;
                    /* Penomoran di luar blok konten LI */
                    /* Tambahkan clear fix atau pengaturan display jika penomoran tidak rapi */
                }
            </style>


            <!-- Tombol Edit (hanya untuk admin) -->
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('visi-misi.edit') }}" class="btn btn-warning">Edit</a>
                @endif
            @endauth


        </div>
    </div>

    <!-- FOOTER -->
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
                        <p><i class="bi bi-geo-alt-fill me-2" style="color: var(--accent);"></i>Jl. Mastrip PO BOX
                            164<br>Jember, Jawa Timur, Indonesia</p>
                        <p><i class="bi bi-envelope-fill me-2" style="color: var(--accent);"></i>
                            <a href="mailto:politeknik@polije.ac.id"
                                class="text-white text-decoration-none">politeknik@polije.ac.id</a>
                        </p>
                        <p><i class="bi bi-telephone-fill me-2" style="color: var(--accent);"></i>+62 331 333533</p>
                        <p><i class="bi bi-telephone-fill me-2" style="color: var(--accent);"></i>+62 331 333531</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <p class="mb-0" style="color: rgba(255,255,255,0.7);">© 2025 Satuan Pengawas Internal - Politeknik
                    Negeri Jember. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>