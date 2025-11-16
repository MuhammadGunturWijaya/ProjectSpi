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
    <title>Survey Kepuasan - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light">

    @include('layouts.navbar')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .text-gradient {
            background: linear-gradient(45deg, #007bff, #28a745);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }

        .survey-card {
            border-radius: 1.5rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            z-index: 1;
            padding: 2rem;
        }

        .survey-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        }

        .rating-options {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .rating-item {
            width: 130px;
            padding: 1.2rem;
            border-radius: 1rem;
            background-color: #f1f3f5;
            transition: all 0.2s ease;
            cursor: pointer;
            text-align: center;
            border: 3px solid transparent;
        }

        .rating-item:hover {
            background-color: #e0e5ef;
            transform: translateY(-4px) scale(1.05);
        }

        .rating-item input[type="radio"] {
            display: none;
        }

        /* Warna untuk Sangat Puas - Hijau */
        .rating-item:has(input[value="Sangat Puas"]:checked) {
            background-color: #d4edda;
            border-color: #28a745;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .rating-item:has(input[value="Sangat Puas"]:checked) .emoji {
            transform: scale(1.5) rotate(10deg);
        }

        .rating-item:has(input[value="Sangat Puas"]:checked) span {
            font-weight: bold;
            color: #28a745;
        }

        /* Warna untuk Puas - Kuning */
        .rating-item:has(input[value="Puas"]:checked) {
            background-color: #fff3cd;
            border-color: #ffc107;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .rating-item:has(input[value="Puas"]:checked) .emoji {
            transform: scale(1.5) rotate(10deg);
        }

        .rating-item:has(input[value="Puas"]:checked) span {
            font-weight: bold;
            color: #ffc107;
        }

        /* Warna untuk Cukup Puas - Orange */
        .rating-item:has(input[value="Cukup Puas"]:checked) {
            background-color: #ffe5d0;
            border-color: #fd7e14;
            box-shadow: 0 4px 15px rgba(253, 126, 20, 0.3);
        }

        .rating-item:has(input[value="Cukup Puas"]:checked) .emoji {
            transform: scale(1.5) rotate(10deg);
        }

        .rating-item:has(input[value="Cukup Puas"]:checked) span {
            font-weight: bold;
            color: #fd7e14;
        }

        /* Warna untuk Kurang Puas - Merah */
        .rating-item:has(input[value="Kurang Puas"]:checked) {
            background-color: #f8d7da;
            border-color: #dc3545;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .rating-item:has(input[value="Kurang Puas"]:checked) .emoji {
            transform: scale(1.5) rotate(10deg);
        }

        .rating-item:has(input[value="Kurang Puas"]:checked) span {
            font-weight: bold;
            color: #dc3545;
        }

        .emoji {
            font-size: 3rem;
            display: block;
            transition: transform 0.3s ease-in-out;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #007bff, #28a745);
            color: white;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 123, 255, 0.2);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            box-shadow: 0 6px 25px rgba(0, 123, 255, 0.3);
            transform: translateY(-2px);
            color: #fff;
        }

        .progress {
            height: 10px;
            border-radius: 10px;
            background-color: #e9ecef;
        }

        .progress-bar {
            background: linear-gradient(90deg, #007bff, #28a745);
            transition: width 0.4s ease-in-out;
        }

        .survey-section {
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            padding: 3rem 0;
        }

        .survey-section::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(0, 123, 255, 0.1);
            border-radius: 50%;
            z-index: 0;
        }

        .survey-section::after {
            content: "";
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 250px;
            height: 250px;
            background: rgba(40, 167, 69, 0.1);
            border-radius: 50%;
            z-index: 0;
        }

        .input-group-text {
            background: linear-gradient(90deg, #007bff, #28a745);
            font-size: 1.2rem;
            padding: 0.75rem 1rem;
        }

        input[type="date"] {
            font-size: 1rem;
            background-color: #f9fafb;
            transition: all 0.2s ease;
        }

        input[type="date"]:hover {
            background-color: #eef5ff;
        }

        input[type="date"]:focus {
            background-color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>
<body class="bg-light">
    <section class="survey-section py-5 min-vh-100 d-flex align-items-center" id="survey">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="fw-bold display-4 text-gradient">
                    <i class="fas fa-poll me-3"></i> Survey Kepuasan
                </h1>
                <p class="text-muted fs-5 mt-3">
                    Pendapat Anda sangat berharga untuk peningkatan layanan <br>
                    <span class="fw-semibold text-dark">Satuan Pengawas Internal Politeknik Negeri Jember</span>.
                </p>
                <div class="text-center mb-4">
                    <button id="copyLinkBtn" class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm">
                        <i class="fas fa-link me-2"></i> Salin Link Survey
                    </button>
                    <button id="waShareBtn" class="btn btn-success rounded-pill px-4 py-2 shadow-sm ms-2">
                        <i class="fab fa-whatsapp me-2"></i> Bagikan ke WhatsApp
                    </button>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="text-center mb-4 mt-3">
                                <a href="{{ route('survey.kepuasan.data') }}"
                                    class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                                    <i class="fas fa-eye me-2"></i> Lihat Semua Survey
                                </a>
                                <a href="{{ route('survey.questions.manage') }}"
                                    class="btn btn-warning rounded-pill px-4 py-2 shadow-sm ms-2">
                                    <i class="fas fa-cog me-2"></i> Kelola Pertanyaan
                                </a>
                            </div>
                        @endif
                    @endauth

                    <!-- Toast Notifikasi -->
                    <div id="toast"
                        class="toast-notification position-fixed bottom-3 end-3 p-3 rounded-4 shadow-lg bg-success text-white"
                        style="display:none; z-index: 1055;">
                        <i class="fas fa-check-circle me-2"></i> Link survey berhasil disalin ke clipboard!
                    </div>

                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const copyBtn = document.getElementById('copyLinkBtn');
                    const waBtn = document.getElementById('waShareBtn');
                    const pageUrl = window.location.href;

                    copyBtn.addEventListener('click', function () {
                        navigator.clipboard.writeText(pageUrl).then(() => {
                            alert('Link survey berhasil disalin ke clipboard!');
                        }).catch(err => {
                            console.error('Gagal menyalin link:', err);
                        });
                    });

                    waBtn.addEventListener('click', function () {
                        const waUrl = `https://wa.me/?text=${encodeURIComponent("Silahkan Mengisi Survey Berikut: " + pageUrl)}`;
                        window.open(waUrl, '_blank');
                    });
                });
            </script>

            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-10">
                    <div class="card survey-card border-0 shadow-lg rounded-5 overflow-hidden">
                        <div class="card-body p-4 p-md-5">
                            @guest
                                <div class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" width="120"
                                        class="mb-4 opacity-50 lock-icon">
                                    <p class="fs-4 text-muted mb-4">Anda harus login terlebih dahulu untuk mengisi survey.
                                    </p>
                                    <a href="{{ route('login') }}"
                                        class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm fw-bold">
                                        <i class="fas fa-sign-in-alt me-2"></i> Login Sekarang
                                    </a>
                                </div>
                            @endguest

                            @auth
                                <form method="POST" action="{{ route('survey.store') }}" class="animate-fade">
                                    @csrf
                                    {{-- Pertanyaan Demografis --}}
                                    <div class="mb-5 question-block" data-step="0">
                                        <h4 class="fw-bold mb-3">Data Diri</h4>

                                        <label class="form-label fw-semibold fs-5 mb-2">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select mb-3" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>

                                        <label class="form-label fw-semibold fs-5 mb-2">Pendidikan Terakhir</label>
                                        <select name="pendidikan" class="form-select mb-3" required>
                                            <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA/SMK">SMA/SMK</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="Sarjana">Sarjana</option>
                                            <option value="Magister">Magister</option>
                                            <option value="Doktor">Doktor</option>
                                        </select>

                                        <label class="form-label fw-semibold fs-5 mb-2">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" class="form-control mb-3"
                                            placeholder="Isi Pekerjaan Anda" required>

                                        <label for="tanggal" class="form-label fw-bold fs-5 mb-2 mt-3">
                                            <i class="fas fa-calendar-alt text-primary me-2"></i> Tanggal Mengisi
                                        </label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-gradient text-white rounded-start-4 border-0">
                                                <i class="fas fa-calendar-day"></i>
                                            </span>
                                            <input type="date" id="tanggal" name="tanggal"
                                                class="form-control border-0 rounded-end-4 py-3 px-4" required>
                                        </div>
                                        <small class="text-muted fst-italic ms-1">
                                            Silakan pilih tanggal saat Anda mengisi survey
                                        </small>
                                    </div>

                                    <div id="survey-form-content">
                                        @php
                                            // Ambil semua pertanyaan dari database berdasarkan urutan
                                            $allQuestions = \App\Models\SurveyQuestion::orderBy('order')->get();
                                            $totalQuestions = $allQuestions->count();

                                           
                                            $defaultQuestions = $allQuestions;
                                            $customQuestions = collect(); 
                                        @endphp


                                        {{-- 9 Pertanyaan Default (dari database) --}}
                                        @foreach($defaultQuestions as $index => $question)
                                            <div class="mb-5 question-block" data-step="{{ $index + 1 }}" @if($index > 0)
                                            style="display:none;" @endif>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="fw-bold mb-0">Pertanyaan {{ $index + 1 }} dari
                                                        {{ $totalQuestions }}</h4>
                                                    <div class="progress" style="width: 50%;">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ (($index + 1) / $totalQuestions) * 100 }}%;"
                                                            aria-valuenow="{{ (($index + 1) / $totalQuestions) * 100 }}"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>

                                                <label
                                                    class="form-label fw-semibold fs-5 mb-3">{{ $question->question_text }}</label>
                                                <div class="d-flex justify-content-around rating-options">
                                                    <label class="rating-item text-center cursor-pointer">
                                                        <input type="radio" name="jawaban[{{ $index }}]" value="Sangat Puas"
                                                            required>
                                                        <span class="emoji">🌟</span>
                                                        <span class="d-block mt-2">Sangat Puas</span>
                                                    </label>
                                                    <label class="rating-item text-center cursor-pointer">
                                                        <input type="radio" name="jawaban[{{ $index }}]" value="Puas" required>
                                                        <span class="emoji">😊</span>
                                                        <span class="d-block mt-2">Puas</span>
                                                    </label>
                                                    <label class="rating-item text-center cursor-pointer">
                                                        <input type="radio" name="jawaban[{{ $index }}]" value="Cukup Puas"
                                                            required>
                                                        <span class="emoji">😐</span>
                                                        <span class="d-block mt-2">Cukup Puas</span>
                                                    </label>
                                                    <label class="rating-item text-center cursor-pointer">
                                                        <input type="radio" name="jawaban[{{ $index }}]" value="Kurang Puas"
                                                            required>
                                                        <span class="emoji">🙁</span>
                                                        <span class="d-block mt-2">Kurang Puas</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- Pertanyaan Custom (dari database, setelah 9 pertanyaan pertama) --}}
                                        @foreach($customQuestions as $customIndex => $customQ)
                                            @php
                                                $currentStep = 9 + $customIndex + 1;
                                            @endphp
                                            <div class="mb-5 question-block" data-step="{{ $currentStep }}"
                                                style="display:none;">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="fw-bold mb-0">
                                                        Pertanyaan {{ $currentStep }} dari {{ $totalQuestions }}
                                                        <span class="badge bg-info ms-2">Custom</span>
                                                    </h4>
                                                    <div class="progress" style="width: 50%;">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ ($currentStep / $totalQuestions) * 100 }}%;"
                                                            aria-valuenow="{{ ($currentStep / $totalQuestions) * 100 }}"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>

                                                <label
                                                    class="form-label fw-semibold fs-5 mb-3">{{ $customQ->question_text }}</label>
                                                <div class="d-flex justify-content-around rating-options">
                                                    <label class="rating-item text-center cursor-pointer">
                                                        <input type="radio" name="jawaban_custom[{{ $customQ->id }}]"
                                                            value="Sangat Puas" required>
                                                        <span class="emoji">🌟</span>
                                                        <span class="d-block mt-2">Sangat Puas</span>
                                                    </label>
                                                    <label class="rating-item text-center cursor-pointer">
                                                        <input type="radio" name="jawaban_custom[{{ $customQ->id }}]"
                                                            value="Puas" required>
                                                        <span class="emoji">😊</span>
                                                        <span class="d-block mt-2">Puas</span>
                                                    </label>
                                                    <label class="rating-item text-center cursor-pointer">
                                                        <input type="radio" name="jawaban_custom[{{ $customQ->id }}]"
                                                            value="Cukup Puas" required>
                                                        <span class="emoji">😐</span>
                                                        <span class="d-block mt-2">Cukup Puas</span>
                                                    </label>
                                                    <label class="rating-item text-center cursor-pointer">
                                                        <input type="radio" name="jawaban_custom[{{ $customQ->id }}]"
                                                            value="Kurang Puas" required>
                                                        <span class="emoji">🙁</span>
                                                        <span class="d-block mt-2">Kurang Puas</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="mb-5 question-block" data-step="{{ $totalQuestions + 1 }}"
                                            style="display:none;">
                                            <h4 class="fw-bold mb-3">Masukan & Saran</h4>
                                            <div class="form-floating mb-4">
                                                <textarea name="kendala" id="kendala" rows="4"
                                                    class="form-control rounded-4" style="height: 120px;"
                                                    placeholder="Kendala/Masalah yang Anda alami (boleh kosong)"></textarea>
                                                <label for="kendala">Kendala/Masalah yang Anda alami (boleh kosong)</label>
                                            </div>
                                    <div class="form-floating mb-4">
                                        <textarea name="saran" id="saran" rows="4" class="form-control rounded-4"
                                            style="height: 120px;"
                                            placeholder="Saran Perbaikan Layanan (boleh kosong)"></textarea>
                                        <label for="saran">Saran Perbaikan Layanan (boleh kosong)</label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" id="prev-btn"
                                        class="btn btn-outline-secondary px-4 py-2 rounded-pill shadow-sm"
                                        style="display:none;">
                                        <i class="fas fa-arrow-left me-2"></i> Kembali
                                    </button>
                                    <button type="button" id="next-btn"
                                        class="btn btn-gradient px-4 py-2 rounded-pill ms-auto">
                                        Lanjut <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                    <button type="submit" id="submit-btn"
                                        class="btn btn-gradient btn-lg px-5 py-2 rounded-pill shadow fw-bold"
                                        style="display:none;">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Survey
                                    </button>
                                </div>
                            </form>
                        @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentStep = 0;
            const totalSteps = {{ $totalQuestions + 2 }};
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');

            function showStep(step) {
                document.querySelectorAll('.question-block').forEach(block => block.style.display = 'none');
                const currentBlock = document.querySelector(`[data-step="${step}"]`);
                if (currentBlock) currentBlock.style.display = 'block';

                prevBtn.style.display = step > 0 ? 'block' : 'none';
                nextBtn.style.display = step < totalSteps - 1 ? 'block' : 'none';
                submitBtn.style.display = step === totalSteps - 1 ? 'block' : 'none';
            }

            nextBtn.addEventListener('click', function () {
                const currentQuestion = document.querySelector(`[data-step="${currentStep}"]`);
                let isValid = false;

                const radios = currentQuestion.querySelectorAll('input[type="radio"]');
                if (radios.length > 0) {
                    isValid = Array.from(radios).some(r => r.checked);
                } else {
                    const inputs = currentQuestion.querySelectorAll('input:required, select:required, textarea:required');
                    isValid = Array.from(inputs).every(input => input.value.trim() !== '');
                }

                if (isValid) {
                    currentStep++;
                    showStep(currentStep);
                } else {
                    const warningModalEl = document.getElementById('warningModal');
                    const warningModal = new bootstrap.Modal(warningModalEl);
                    warningModalEl.querySelector('.modal-content').classList.add('shake');
                    warningModalEl.addEventListener('animationend', function () {
                        warningModalEl.querySelector('.modal-content').classList.remove('shake');
                    }, { once: true });
                    warningModal.show();
                }
            });

            prevBtn.addEventListener('click', function () {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(currentStep);
        });
    </script>

    <!-- Modal Terima Kasih -->
    <div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg">
                <div class="modal-body text-center p-5">
                    <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                    <h4 class="fw-bold mb-3">Terima Kasih!</h4>
                    <p class="mb-4">Terima kasih telah mengisi survey kepuasan. Masukan Anda sangat berharga untuk kami.
                    </p>
                    <button type="button" class="btn btn-gradient px-4 py-2 rounded-pill" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(session('survey_success'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
                thankYouModal.show();
            });
        </script>
    @endif

    <!-- Modal Warning -->
    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg">
                <div class="modal-body text-center p-5">
                    <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                    <h4 class="fw-bold mb-3">Perhatian!</h4>
                    <p class="mb-4">Mohon pilih salah satu jawaban sebelum melanjutkan.</p>
                    <button type="button" class="btn btn-gradient px-4 py-2 rounded-pill" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')
</body>
</html>