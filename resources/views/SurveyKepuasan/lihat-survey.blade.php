<!DOCTYPE html>
<html lang="id">
<style>
    body {
        overflow-x: hidden;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Survey Kepuasan - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --dark-blue: #0a58ca;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow-soft: 0 6px 20px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.15);
            --border-radius: 16px;
            --gradient-blue: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-blue) 100%);
            --accent-color: #6f42c1;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #eef1f5 0%, #d8dbe2 100%);
            min-height: 100vh;
            color: #212529;
            padding-bottom: 50px;
            transition: background 0.3s, color 0.3s;
        }

        body.dark-mode {
            background: #121212;
            color: #e0e0e0;
        }

        /* Header */
        .survey-header {
            background: var(--gradient-blue);
            color: white;
            padding: 50px 0;
            margin-bottom: 40px;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .survey-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 100%, rgba(255, 255, 255, 0.15) 10%, transparent 70%);
            opacity: 0.5;
            transform: rotate(15deg);
        }

        .survey-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            height: 80px;
            background: url('data:image/svg+xml;utf8,<svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,100 C50,0 50,0 100,100 Z" fill="white" opacity="0.2"/></svg>') no-repeat bottom;
            background-size: cover;
        }

        .survey-title {
            font-weight: 700;
            font-size: 2.8rem;
            text-align: center;
        }

        .survey-subtitle {
            font-size: 1.2rem;
            text-align: center;
            font-weight: 300;
        }

        /* Card */
        .stat-card-enhanced {
            background: var(--white);
            padding: 25px 20px;
            border-radius: var(--border-radius);
            text-align: center;
            flex: 1;
            min-width: 200px;
            margin: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1), -5px -5px 10px rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
        }

        .stat-card-enhanced:hover {
            transform: translateY(-5px);
            box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.15), -8px -8px 15px rgba(255, 255, 255, 0.8);
        }

        .stat-number-enhanced {
            font-size: 2.5rem;
            font-weight: 800;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .stat-number-enhanced.text-accent {
            color: var(--accent-color) !important;
            animation: pulse 1.5s infinite;
        }

        .stat-number-enhanced.text-primary {
            color: var(--primary-color) !important;
        }

        .stat-number-enhanced.text-success {
            color: var(--success-color) !important;
        }

        .stat-number-enhanced.text-warning {
            color: var(--warning-color) !important;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .stat-label-enhanced {
            font-size: 1rem;
            font-weight: 500;
            color: var(--secondary-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .chart-card {
            height: 300px;
            padding: 20px !important;
        }

        /* Table */
        .table-primary-header {
            background: var(--gradient-blue);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .table th,
        .table td {
            vertical-align: middle;
            font-size: 0.9rem;
            padding: 15px 12px;
            border-color: rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
        }

        .table-hover tbody tr:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
            transition: all 0.3s;
        }

        .badge-score {
            font-size: 0.85rem;
            padding: 8px 14px;
            border-radius: 25px;
            font-weight: 700;
            min-width: 50px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: help;
            transition: all 0.3s;
        }

        .badge-score.text-bg-success {
            background: linear-gradient(135deg, #198754, #157347);
            color: #fff;
        }

        .badge-score.text-bg-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #212529;
        }

        .badge-score.text-bg-danger {
            background: linear-gradient(135deg, #dc3545, #a71d2a);
            color: #fff;
        }

        .long-text-cell {
            max-width: 250px;
            word-wrap: break-word;
        }

        .btn-export-data {
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 10px 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-export-data:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Fade-in animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
        }

        /* Dark mode toggle */
        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
            cursor: pointer;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>

    <i class="fas fa-moon dark-mode-toggle" id="darkModeToggle" title="Toggle Dark Mode"></i>

    @include('layouts.navbar')

    <div class="survey-header">
        <div class="container">
            <h1 class="survey-title fade-in">
                <i class="fas fa-chart-bar me-3"></i>Dashboard Analisis Kepuasan
            </h1>
            <p class="survey-subtitle mb-0 fade-in" style="animation-delay: 0.2s;">
                <i class="fas fa-lightbulb me-2"></i>Wawasan Kunci untuk Peningkatan Kualitas Layanan SPI Polije
            </p>
        </div>
    </div>

    <div class="container py-4">

        <hr class="mb-4">



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
                        $totalScoreRespondent += $scoreMap[$jawaban] * 20; // skala 1–5 ke 100
                        $totalCountRespondent++;
                    }
                }

                $avgScoreRespondent = $totalCountRespondent > 0 ? $totalScoreRespondent / $totalCountRespondent : 0;
                $category = getCategoryByScore($avgScoreRespondent);

                // Distribusi kepuasan
                $scoreCategories[$category]++;

                // Survei perlu perhatian (kategori Kurang Puas)
                if ($category === 'Kurang Puas') {
                    $attentionCount++;
                }
            }

            // Buat variabel untuk chart
            $distributionLabels = array_keys($scoreCategories);
            $distributionData = array_values($scoreCategories);
        @endphp



        <div class="row justify-content-center">
            <!-- Total Responden -->
            <div class="col-lg-4 col-md-6 mb-3 fade-in" style="animation-delay: 0.4s;">
                <div class="stat-card-enhanced">
                    <i class="fas fa-users fa-2x mb-2 text-primary"></i>
                    <span class="stat-number-enhanced text-primary">{{ $totalRespondents }}</span>
                    <div class="stat-label-enhanced">Total Responden</div>
                </div>
            </div>

            <!-- Nilai IKM -->
            <div class="col-lg-4 col-md-6 mb-3 fade-in" style="animation-delay: 0.7s;">
                <div class="stat-card-enhanced">
                    <i class="fas fa-chart-pie fa-2x mb-2 text-warning"></i>
                    <span class="stat-number-enhanced text-warning">{{ $ikm }}</span>
                    <div class="stat-label-enhanced">Nilai IKM ({{ $ikmCategory }})</div>
                </div>
            </div>


            <!-- Survei Perlu Perhatian -->
            <div class="col-lg-4 col-md-12 mb-3 fade-in" style="animation-delay: 0.9s;">
                <div class="stat-card-enhanced">
                    <i class="fas fa-bell fa-2x mb-2" style="color: var(--accent-color);"></i>
                    <span class="stat-number-enhanced text-accent">{{ $attentionCount }}</span>
                    <div class="stat-label-enhanced">Survei Perlu Perhatian</div>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <!-- Distribusi Kepuasan -->
            <div class="col-lg-4 mb-4 fade-in" style="animation-delay: 1.0s;">
                <h5 class="text-center text-muted mb-3"><i class="fas fa-circle-notch me-2"></i>Distribusi Kepuasan</h5>
                <div class="survey-card chart-card">
                    <canvas id="scoreDistributionChart"></canvas>
                </div>
            </div>

            <!-- Performa Per Kriteria -->
            <div class="col-lg-8 mb-4 fade-in" style="animation-delay: 1.2s;">
                <h5 class="text-center text-muted mb-3"><i class="fas fa-chart-line me-2"></i>Performa Per Kriteria
                    (Rata-rata Skor)</h5>
                <div class="survey-card chart-card">
                    <canvas id="criteriaPerformanceChart"></canvas>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Doughnut Chart - Distribusi Kepuasan
                const ctxDistribution = document.getElementById('scoreDistributionChart');
                new Chart(ctxDistribution, {
                    type: 'doughnut',
                    data: {
                        labels: @json($distributionLabels),
                        datasets: [{
                            data: @json($distributionData),
                            backgroundColor: ['#198754', '#0d6efd', '#ffc107', '#dc3545'],
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } }
                    }
                });


                // Bar Chart - Performa Per Kriteria
                const ctxCriteria = document.getElementById('criteriaPerformanceChart');
                new Chart(ctxCriteria, {
                    type: 'bar',
                    data: {
                        labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9'],
                        datasets: [{
                            label: 'Rata-rata Skor (Skala 5)',
                            data: @json($criteriaScores),
                            backgroundColor: context => {
                                const value = context.parsed.y;
                                if (value >= 4.5) return '#198754';
                                if (value >= 4.0) return '#0d6efd';
                                if (value >= 3.5) return '#ffc107';
                                return '#dc3545';
                            },
                            borderRadius: 5,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true, max: 5, title: { display: true, text: 'Rata-rata Skor' } }
                        },
                        plugins: { legend: { display: false }, tooltip: { callbacks: { label: context => `Skor: ${context.parsed.y.toFixed(2)}` } } }
                    }
                });
            });
        </script>


        <hr class="mb-4">

        <div class="survey-card fade-in" style="animation-delay: 1.4s;">
            <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                <table class="table table-hover table-striped">
                    <thead class="table-primary-header">
                        <tr>
                            <th scope="col" style="width: 15%;"><i class="fas fa-at me-2"></i>Email Responden</th>
                            <th scope="col" style="width: 10%;"><i class="fas fa-venus-mars me-2"></i>Jenis Kelamin</th>
                            <th scope="col" style="width: 15%;"><i class="fas fa-graduation-cap me-2"></i>Pendidikan
                            </th>
                            <th scope="col" style="width: 15%;"><i class="fas fa-briefcase me-2"></i>Pekerjaan</th>

                            @for($i = 1; $i <= 9; $i++)
                                <th scope="col" class="answer-column">Q{{ $i }}</th>
                            @endfor
                            <th scope="col" class="long-text-cell" style="width: 15%;"><i
                                    class="fas fa-exclamation-circle me-2"></i>Kendala</th>
                            <th scope="col" class="long-text-cell" style="width: 15%;"><i
                                    class="fas fa-comment-dots me-2"></i>Saran</th>
                            <th scope="col" style="width: 10%;"><i class="fas fa-calendar-alt me-2"></i>Tanggal</th>
                            <th scope="col" style="width: 10%;"><i class="fas fa-clock me-2"></i>Waktu Submit</th>
                            <th scope="col" style="width: 10%;"><i class="fas fa-trash me-2"></i>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($surveys as $survey)
                            <tr class="fade-in" style="animation-delay: {{ 1.5 + $loop->index * 0.05 }}s;">
                                <!-- Email Responden -->
                                <td class="email-cell">
                                    <a href="mailto:{{ $survey->email }}" class="email-cell">{{ $survey->email }}</a>
                                </td>
                                <!-- Data Diri -->
                                <td>{{ $survey->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $survey->pendidikan ?? '-' }}</td>
                                <td>{{ $survey->pekerjaan ?? '-' }}</td>

                                <!-- Jawaban Q1–Q9 -->
                                @for($i = 1; $i <= 9; $i++)
                                    @php
                                        $jawaban = $survey->{'jawaban_' . $i} ?? '-';
                                        $scoreValue = isset($scoreMap[$jawaban]) ? $scoreMap[$jawaban] * 20 : 0;
                                        $category = getCategoryByScore($scoreValue);

                                        $badgeClass = match ($jawaban) {
                                            'Sangat Puas' => 'text-bg-success',
                                            'Puas' => 'text-bg-primary',
                                            'Cukup Puas' => 'text-bg-warning',
                                            'Kurang Puas' => 'text-bg-danger',
                                            default => 'text-bg-secondary',
                                        };

                                    @endphp
                                    <td class="answer-column">
                                        <span class="badge badge-score {{ $badgeClass }}" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="{{ $jawaban }}">
                                            {{ $jawaban }}
                                        </span>
                                    </td>
                                @endfor

                                <!-- Kendala & Saran -->
                                <td class="long-text-cell">{{ $survey->kendala ?? '-' }}</td>
                                <td class="long-text-cell">{{ $survey->saran ?? '-' }}</td>

                                <!-- Tanggal Mengisi -->
                                <td>{{ $survey->tanggal ? \Carbon\Carbon::parse($survey->tanggal)->format('d M Y') : '-' }}
                                </td>

                                <!-- Waktu Submit -->
                                <td class="timestamp">{{ $survey->created_at->format('d/M H:i') }}</td>

                                <!-- Aksi Hapus -->
                                <td>
                                    <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <small class="text-muted">Menampilkan **{{ count($surveys) }}** entri</small>
                <a href="{{ route('surveys.download') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-file-download me-2"></i>Download Laporan Lengkap (CSV)
                </a>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const mockData = {
            distribution: {
                labels: ['Sangat Puas (5)', 'Puas (4)', 'Cukup (3)', 'Kurang (1-2)'],
                data: [45, 30, 15, 10],
                colors: ['#198754', '#0d6efd', '#ffc107', '#dc3545']
            },
            criteria: {
                labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9'],
                scores: [4.5, 3.8, 4.2, 4.0, 4.7, 3.5, 4.1, 4.4, 3.9]
            }
        };

        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) });

            const elementsToAnimate = document.querySelectorAll('.fade-in');
            elementsToAnimate.forEach((el, index) => {
                const delay = parseFloat(el.style.animationDelay) || index * 0.1;
                setTimeout(() => {
                    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, delay * 1000);
            });

            // Doughnut Chart
            const ctxDistribution = document.getElementById('scoreDistributionChart');
            new Chart(ctxDistribution, {
                type: 'doughnut',
                data: { labels: mockData.distribution.labels, datasets: [{ data: mockData.distribution.data, backgroundColor: mockData.distribution.colors, hoverOffset: 6 }] },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
            });

            // Bar Chart
            const ctxCriteria = document.getElementById('criteriaPerformanceChart');
            new Chart(ctxCriteria, {
                type: 'bar',
                data: {
                    labels: mockData.criteria.labels,
                    datasets: [{
                        label: 'Rata-rata Skor (Skala 5)',
                        data: mockData.criteria.scores,
                        backgroundColor: context => {
                            const value = context.parsed.y;
                            if (value >= 4.5) return '#198754';
                            if (value >= 4.0) return '#0d6efd';
                            if (value >= 3.5) return '#ffc107';
                            return '#dc3545';
                        },
                        borderRadius: 5,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, max: 5, title: { display: true, text: 'Rata-rata Skor' } } },
                    plugins: { legend: { display: false }, tooltip: { callbacks: { label: context => `Skor: ${context.parsed.y.toFixed(2)}` } } }
                }
            });

            // Dark Mode Toggle
            const toggle = document.getElementById('darkModeToggle');
            toggle.addEventListener('click', () => { document.body.classList.toggle('dark-mode'); });
        });
    </script>
    @include('layouts.NavbarBawah')
</body>

</html>