<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Survey Kepuasan - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --dark-bg: #0f1419;
            --card-bg: #ffffff;
            --text-primary: #1a1a2e;
            --text-secondary: #6c757d;
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.15);
            --shadow-hover: 0 25px 70px rgba(0, 0, 0, 0.25);
            --border-radius-lg: 24px;
            --border-radius-md: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--text-primary);
            padding-bottom: 50px;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
            z-index: 0;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
        }

        /* Enhanced Header */
        .survey-header {
            background: var(--primary-gradient);
            padding: 80px 0 100px;
            position: relative;
            overflow: hidden;
            margin-bottom: -40px;
        }

        .survey-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,144C960,149,1056,139,1152,122.7C1248,107,1344,85,1392,74.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            animation: wave 15s ease-in-out infinite;
        }

        @keyframes wave {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-50px);
            }
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .survey-title {
            font-weight: 800;
            font-size: 3.5rem;
            color: white;
            text-align: center;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
            animation: fadeInDown 0.8s ease;
        }

        .survey-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.95);
            text-align: center;
            font-weight: 300;
            animation: fadeInUp 0.8s ease;
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modern Stats Cards */
        .stats-container {
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }

        .stat-card-modern {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: 35px 25px;
            text-align: center;
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .stat-card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--primary-gradient);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .stat-card-modern:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-hover);
        }

        .stat-card-modern:hover::before {
            transform: scaleX(1);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stat-icon.primary {
            background: var(--primary-gradient);
        }

        .stat-icon.warning {
            background: var(--warning-gradient);
        }

        .stat-icon.success {
            background: var(--success-gradient);
        }

        .stat-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .stat-card-modern:hover .stat-icon::after {
            transform: translateX(100%);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            display: block;
        }

        .stat-number.warning-gradient {
            background: var(--warning-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-number.success-gradient {
            background: var(--success-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Modern Chart Cards */
        .chart-card-modern {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.5);
            height: 100%;
        }

        .chart-card-modern:hover {
            box-shadow: var(--shadow-hover);
        }

        .chart-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-title i {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        /* Modern Table */
        .table-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .table-responsive {
            border-radius: var(--border-radius-md);
            overflow: auto;
        }

        .table {
            margin-bottom: 0;
            white-space: nowrap;
        }

        .table thead {
            background: var(--primary-gradient);
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table thead th {
            border: none;
            padding: 18px 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, transparent 100%);
        }

        .table td {
            padding: 18px 15px;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        /* Badge dengan warna sesuai permintaan */
        .badge-modern {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
            border: none;
            transition: all 0.3s ease;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-modern.sangat-puas {
            background: linear-gradient(135deg, #198754 0%, #157347 100%);
            color: white;
        }

        .badge-modern.puas {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
        }

        .badge-modern.cukup-puas {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            color: #212529;
        }

        .badge-modern.kurang-puas {
            background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%);
            color: white;
        }

        .badge-modern:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Modern Buttons */
        .btn-modern {
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-modern.primary {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        .btn-delete {
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            position: fixed;
            top: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dark-mode-toggle:hover {
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .survey-title {
                font-size: 2.5rem;
            }

            .survey-subtitle {
                font-size: 1rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }
        }

        /* Email Link */
        .email-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .email-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Long Text Cell */
        .long-text-cell {
            max-width: 250px;
            word-wrap: break-word;
            white-space: normal;
        }

        /* Footer Stats */
        .footer-stats {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: 20px 30px;
            box-shadow: var(--shadow-lg);
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.5);
            flex-wrap: wrap;
            gap: 15px;
        }

        .scroll-indicator {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            opacity: 0;
            pointer-events: none;
        }

        .scroll-indicator.visible {
            opacity: 1;
            pointer-events: all;
        }

        .scroll-indicator:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <!-- Dark Mode Toggle -->
        <button class="dark-mode-toggle" id="darkModeToggle" title="Toggle Dark Mode">
            <i class="fas fa-moon"></i>
        </button>

        <!-- Scroll to Top -->
        <div class="scroll-indicator" id="scrollTop">
            <i class="fas fa-arrow-up"></i>
        </div>

        @include('layouts.navbar')

        <!-- Header -->
        <div class="survey-header">
            <div class="container header-content">
                <h1 class="survey-title">
                    <i class="fas fa-chart-line me-3"></i>Dashboard Analisis Kepuasan
                </h1>
                <p class="survey-subtitle">
                    <i class="fas fa-lightbulb me-2"></i>Wawasan Kunci untuk Peningkatan Kualitas Layanan SPI Polije
                </p>
            </div>
        </div>

        <div class="container py-5">
            @php
                // Mapping teks ke skor 1–5
                $scoreMap = [
                    'Sangat Puas' => 5,
                    'Puas' => 4,
                    'Cukup Puas' => 3,
                    'Kurang Puas' => 1,
                ];

                // Total responden
                $totalRespondents = count($surveys);

                // Fungsi kategori berdasarkan skor 0–100
                function getCategoryByScore($score)
                {
                    if ($score >= 88.31)
                        return 'Sangat Puas';
                    if ($score >= 76.61)
                        return 'Puas';
                    if ($score >= 65.00)
                        return 'Cukup Puas';
                    if ($score >= 25.00)
                        return 'Kurang Puas';
                    return 'Kurang Puas';
                }

                // Hitung rata-rata skor per kriteria & total
                $totalScore = 0;
                $totalCount = 0;
                $criteriaScores = [];

                for ($i = 1; $i <= 9; $i++) {
                    $criteriaTotal = 0;
                    $criteriaCount = 0;

                    foreach ($surveys as $survey) {
                        $jawaban = $survey->{'jawaban_' . $i} ?? null;

                        if ($jawaban && isset($scoreMap[$jawaban])) {
                            $criteriaTotal += $scoreMap[$jawaban];
                            $criteriaCount++;
                            $totalScore += $scoreMap[$jawaban];
                            $totalCount++;
                        }
                    }

                    $criteriaScores[] = $criteriaCount > 0 ? round($criteriaTotal / $criteriaCount, 2) : 0;
                }

                // Rata-rata keseluruhan
                $averageScore = $totalCount > 0 ? round($totalScore / $totalCount, 2) : 0;

                // Konversi rata-rata skor ke IKM
                $ikm = $averageScore * 20;
                $ikm = round($ikm, 2);
                $ikmCategory = getCategoryByScore($ikm);

                // Inisialisasi distribusi & survei perlu perhatian
                $scoreCategories = [
                    'Sangat Puas' => 0,
                    'Puas' => 0,
                    'Cukup Puas' => 0,
                    'Kurang Puas' => 0,
                ];
                $attentionCount = 0;

                // Hitung distribusi & survei perlu perhatian berdasarkan IKM individu
                foreach ($surveys as $survey) {
                    $totalScoreRespondent = 0;
                    $totalCountRespondent = 0;

                    for ($i = 1; $i <= 9; $i++) {
                        $jawaban = $survey->{'jawaban_' . $i} ?? null;
                        if ($jawaban && isset($scoreMap[$jawaban])) {
                            $totalScoreRespondent += $scoreMap[$jawaban] * 20;
                            $totalCountRespondent++;
                        }
                    }

                    $avgScoreRespondent = $totalCountRespondent > 0 ? $totalScoreRespondent / $totalCountRespondent : 0;
                    $category = getCategoryByScore($avgScoreRespondent);

                    $scoreCategories[$category]++;

                    if ($category === 'Kurang Puas') {
                        $attentionCount++;
                    }
                }

                $distributionLabels = array_keys($scoreCategories);
                $distributionData = array_values($scoreCategories);
            @endphp

            <!-- Stats Cards -->
            <div class="row stats-container g-4 mb-5">
                <div class="col-lg-4 col-md-6 fade-in" style="animation-delay: 0.1s;">
                    <div class="stat-card-modern">
                        <div class="stat-icon primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="stat-number">{{ $totalRespondents }}</span>
                        <div class="stat-label">Total Responden</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 fade-in" style="animation-delay: 0.2s;">
                    <div class="stat-card-modern">
                        <div class="stat-icon warning">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <span class="stat-number warning-gradient">{{ $ikm }}</span>
                        <div class="stat-label">Nilai IKM ({{ $ikmCategory }})</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 fade-in" style="animation-delay: 0.3s;">
                    <div class="stat-card-modern">
                        <div class="stat-icon success">
                            <i class="fas fa-bell"></i>
                        </div>
                        <span class="stat-number success-gradient">{{ $attentionCount }}</span>
                        <div class="stat-label">Survei Perlu Perhatian</div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row g-4 mb-5">
                <div class="col-lg-5 fade-in" style="animation-delay: 0.4s;">
                    <div class="chart-card-modern">
                        <h5 class="chart-title">
                            <i class="fas fa-chart-pie"></i>
                            Distribusi Kepuasan
                        </h5>
                        <div class="chart-container">
                            <canvas id="scoreDistributionChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 fade-in" style="animation-delay: 0.5s;">
                    <div class="chart-card-modern">
                        <h5 class="chart-title">
                            <i class="fas fa-chart-bar"></i>
                            Performa Per Kriteria (Rata-rata Skor)
                        </h5>
                        <div class="chart-container">
                            <canvas id="criteriaPerformanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="table-card fade-in" style="animation-delay: 0.6s;">
                <div class="table-responsive" style="max-height: 800px;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-at me-2"></i>Email</th>
                                <th><i class="fas fa-venus-mars me-2"></i>Gender</th>
                                <th><i class="fas fa-graduation-cap me-2"></i>Pendidikan</th>
                                <th><i class="fas fa-briefcase me-2"></i>Pekerjaan</th>
                                @foreach($questions as $index => $question)
                                    <th>Q{{ $index + 1 }}</th>
                                @endforeach
                                <th><i class="fas fa-exclamation-circle me-2"></i>Kendala</th>
                                <th><i class="fas fa-comment-dots me-2"></i>Saran</th>
                                <th><i class="fas fa-calendar-alt me-2"></i>Tanggal</th>
                                <th><i class="fas fa-clock me-2"></i>Waktu</th>
                                <th><i class="fas fa-trash me-2"></i>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surveys as $survey)
                                <tr>
                                    <td><a href="mailto:{{ $survey->email }}" class="email-link">{{ $survey->email }}</a>
                                    </td>
                                    <td>{{ $survey->jenis_kelamin ?? '-' }}</td>
                                    <td>{{ $survey->pendidikan ?? '-' }}</td>
                                    <td>{{ $survey->pekerjaan ?? '-' }}</td>

                                    @php
                                        // Decode JSON menjadi array asosiatif
                                        $answers = json_decode($survey->jawaban, true) ?? [];
                                    @endphp

                                    @foreach($answers as $answer)
                                        @php
                                            $jawaban = $answer['jawaban'] ?? '-';
                                            $badgeClass = match ($jawaban) {
                                                'Sangat Puas' => 'sangat-puas',
                                                'Puas' => 'puas',
                                                'Cukup Puas' => 'cukup-puas',
                                                'Kurang Puas' => 'kurang-puas',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <td><span class="badge-modern {{ $badgeClass }}">{{ $jawaban }}</span></td>
                                    @endforeach



                                    <td class="long-text-cell">{{ $survey->kendala ?? '-' }}</td>
                                    <td class="long-text-cell">{{ $survey->saran ?? '-' }}</td>
                                    <td>{{ $survey->tanggal ? \Carbon\Carbon::parse($survey->tanggal)->format('d M Y') : '-' }}
                                    </td>
                                    <td>{{ $survey->created_at->format('d/M H:i') }}</td>
                                    <td>
                                        <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="footer-stats">
                    <small class="text-muted"><strong>{{ count($surveys) }}</strong> entri ditampilkan</small>
                    <a href="{{ route('surveys.download') }}" class="btn-modern primary">
                        <i class="fas fa-download me-2"></i>Download Laporan CSV
                    </a>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Doughnut Chart dengan warna yang benar
            const ctxDistribution = document.getElementById('scoreDistributionChart');
            new Chart(ctxCriteria, {
                type: 'bar',
                data: {
                    labels: @json($questionLabels), // ← pakai label dari controller
                    datasets: [{
                        label: 'Rata-rata Skor (Skala 5)',
                        data: @json($criteriaScores),
                        backgroundColor: context => {
                            const value = context.parsed.y;
                            if (value >= 4.5) return '#198754'; // Hijau - Sangat Puas
                            if (value >= 4.0) return '#0d6efd'; // Biru - Puas
                            if (value >= 3.5) return '#ffc107'; // Kuning - Cukup Puas
                            return '#dc3545'; // Merah - Kurang Puas
                        },
                        borderRadius: 10,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: context => `Skor: ${context.parsed.y.toFixed(2)}`
                            }
                        }
                    }
                }
            });

            // Bar Chart dengan warna yang benar
            const ctxCriteria = document.getElementById('criteriaPerformanceChart');
            new Chart(ctxCriteria, {
                type: 'bar',
                data: {
                    labels: @json($questionLabels), // ✅ Otomatis menyesuaikan jumlah pertanyaan
                    datasets: [{
                        label: 'Rata-rata Skor (Skala 5)',
                        data: @json($criteriaScores), // ✅ Rata-rata dari controller
                        backgroundColor: context => {
                            const value = context.parsed.y;
                            if (value >= 4.5) return '#198754'; // Hijau - Sangat Puas
                            if (value >= 4.0) return '#0d6efd'; // Biru - Puas
                            if (value >= 3.5) return '#ffc107'; // Kuning - Cukup Puas
                            return '#dc3545'; // Merah - Kurang Puas
                        },
                        borderRadius: 10,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: {
                                    family: 'Poppins'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Rata-rata Skor',
                                font: {
                                    size: 13,
                                    family: 'Poppins',
                                    weight: '600'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'Poppins'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                family: 'Poppins'
                            },
                            bodyFont: {
                                size: 13,
                                family: 'Poppins'
                            },
                            callbacks: {
                                label: context => `Skor: ${context.parsed.y.toFixed(2)}`
                            }
                        }
                    }
                }
            });
            // Dark Mode Toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            const icon = darkModeToggle.querySelector('i');

            // Check for saved dark mode preference
            if (localStorage.getItem('darkMode') === 'enabled') {
                body.classList.add('dark-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }

            darkModeToggle.addEventListener('click', () => {
                body.classList.toggle('dark-mode');

                if (body.classList.contains('dark-mode')) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                    localStorage.setItem('darkMode', null);
                }
            });

            // Scroll to Top Button
            const scrollTop = document.getElementById('scrollTop');

            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    scrollTop.classList.add('visible');
                } else {
                    scrollTop.classList.remove('visible');
                }
            });

            scrollTop.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Fade in animations on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-in').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
    @include('layouts.NavbarBawah')
</body>

</html>