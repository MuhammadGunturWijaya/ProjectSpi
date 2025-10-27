<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sejarah Satuan Pengawas Internal (SPI)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Space+Grotesk:wght@600;700&display=swap"
    rel="stylesheet">

  <style>
    :root {
      --navy: #0a1628;
      --blue: #1e3a8a;
      --cyan: #06b6d4;
      --gold: #fbbf24;
      --orange: #f97316;
      --bg: #f8fafc;
      --card: #ffffff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: #1e293b;
      overflow-x: hidden;
      line-height: 1.6;
    }

    h1,
    h2,
    h3,
    h4 {
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
    }

    /* Animated Background */
    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background: linear-gradient(135deg, #0a1628 0%, #1e3a8a 50%, #0e7490 100%);
    }

    .hero-bg {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .hero-bg::before {
      content: '';
      position: absolute;
      width: 200%;
      height: 200%;
      background:
        radial-gradient(circle at 20% 50%, rgba(6, 182, 212, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(251, 191, 36, 0.15) 0%, transparent 50%);
      animation: drift 20s ease-in-out infinite;
    }

    @keyframes drift {

      0%,
      100% {
        transform: translate(0, 0);
      }

      50% {
        transform: translate(-50px, -50px);
      }
    }

    .floating-shapes {
      position: absolute;
      width: 100%;
      height: 100%;
    }

    .shape {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.3;
      animation: float 15s ease-in-out infinite;
    }

    .shape:nth-child(1) {
      width: 300px;
      height: 300px;
      background: #06b6d4;
      top: 10%;
      left: 10%;
      animation-delay: 0s;
    }

    .shape:nth-child(2) {
      width: 250px;
      height: 250px;
      background: #fbbf24;
      top: 50%;
      right: 15%;
      animation-delay: 5s;
    }

    .shape:nth-child(3) {
      width: 200px;
      height: 200px;
      background: #f97316;
      bottom: 10%;
      left: 30%;
      animation-delay: 10s;
    }

    @keyframes float {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
      }

      33% {
        transform: translate(30px, -30px) scale(1.1);
      }

      66% {
        transform: translate(-20px, 20px) scale(0.9);
      }
    }

    .hero-content {
      position: relative;
      z-index: 10;
      text-align: center;
      color: white;
      padding: 2rem;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      margin-bottom: 2rem;
      animation: fadeInDown 1s ease;
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

    .hero h1 {
      font-size: clamp(2.5rem, 8vw, 5rem);
      font-weight: 800;
      margin-bottom: 1rem;
      background: linear-gradient(to right, #ffffff, #06b6d4, #fbbf24);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: fadeInUp 1s ease 0.2s both;
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

    .hero h2 {
      font-size: clamp(1.2rem, 3vw, 1.8rem);
      font-weight: 600;
      margin-bottom: 1rem;
      opacity: 0.95;
      animation: fadeInUp 1s ease 0.4s both;
    }

    .hero p {
      font-size: clamp(1rem, 2vw, 1.3rem);
      opacity: 0.85;
      max-width: 700px;
      margin: 0 auto 3rem;
      animation: fadeInUp 1s ease 0.6s both;
    }

    .scroll-indicator {
      position: absolute;
      bottom: 40px;
      left: 50%;
      transform: translateX(-50%);
      animation: bounce 2s infinite;
    }

    @keyframes bounce {

      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateX(-50%) translateY(0);
      }

      40% {
        transform: translateX(-50%) translateY(-20px);
      }

      60% {
        transform: translateX(-50%) translateY(-10px);
      }
    }

    .scroll-indicator i {
      font-size: 2rem;
      color: white;
      opacity: 0.7;
    }

    /* Main Content */
    .main-content {
      position: relative;
      z-index: 10;
      margin-top: -80px;
    }

    .content-card {
      background: var(--card);
      border-radius: 30px;
      padding: 3rem;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
      margin-bottom: 3rem;
    }

    .section-title {
      text-align: center;
      margin-bottom: 3rem;
    }

    .section-title h2 {
      font-size: clamp(2rem, 5vw, 3rem);
      color: var(--navy);
      margin-bottom: 1rem;
      position: relative;
      display: inline-block;
    }

    .section-title h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(to right, var(--cyan), var(--gold));
      border-radius: 2px;
    }

    /* Modern Timeline */
    .timeline-modern {
      position: relative;
      padding: 2rem 0;
    }

    .timeline-item-modern {
      display: flex;
      gap: 2rem;
      margin-bottom: 3rem;
      position: relative;
    }

    .timeline-number {
      flex-shrink: 0;
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--cyan), var(--blue));
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: 800;
      color: white;
      box-shadow: 0 10px 30px rgba(6, 182, 212, 0.3);
      transition: transform 0.3s ease;
    }

    .timeline-item-modern:hover .timeline-number {
      transform: scale(1.1) rotate(5deg);
    }

    .timeline-content-modern {
      flex: 1;
      background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
      padding: 2rem;
      border-radius: 20px;
      border-left: 4px solid var(--cyan);
      transition: all 0.3s ease;
    }

    .timeline-content-modern:hover {
      transform: translateX(10px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .timeline-content-modern h4 {
      color: var(--blue);
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
    }

    .timeline-year {
      display: inline-block;
      background: var(--gold);
      color: var(--navy);
      padding: 0.25rem 1rem;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    /* Role Cards with Glassmorphism */
    .role-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }

    .role-card-modern {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.5);
      border-radius: 25px;
      padding: 2.5rem 1.5rem;
      text-align: center;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
    }

    .role-card-modern::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--cyan), var(--blue));
      opacity: 0;
      transition: opacity 0.4s ease;
      z-index: 0;
    }

    .role-card-modern:hover::before {
      opacity: 0.1;
    }

    .role-card-modern:hover {
      transform: translateY(-15px);
      box-shadow: 0 20px 40px rgba(6, 182, 212, 0.3);
    }

    .role-icon {
      position: relative;
      z-index: 1;
      width: 80px;
      height: 80px;
      margin: 0 auto 1.5rem;
      background: linear-gradient(135deg, var(--cyan), var(--blue));
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      color: white;
      transition: all 0.4s ease;
    }

    .role-card-modern:hover .role-icon {
      transform: rotateY(360deg);
      background: linear-gradient(135deg, var(--gold), var(--orange));
    }

    .role-card-modern h6 {
      position: relative;
      z-index: 1;
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 0.75rem;
    }

    .role-card-modern p {
      position: relative;
      z-index: 1;
      color: #64748b;
      font-size: 0.95rem;
    }

    /* CTA Section */
    .cta-section {
      background: linear-gradient(135deg, var(--navy), var(--blue), var(--cyan));
      border-radius: 30px;
      padding: 4rem 2rem;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
      margin-top: 4rem;
    }

    .cta-section::before {
      content: '';
      position: absolute;
      width: 300px;
      height: 300px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      top: -150px;
      right: -150px;
    }

    .cta-section::after {
      content: '';
      position: absolute;
      width: 250px;
      height: 250px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      bottom: -125px;
      left: -125px;
    }

    .cta-content {
      position: relative;
      z-index: 1;
    }

    .cta-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(1.1);
        opacity: 0.8;
      }
    }

    .cta-content h4 {
      font-size: clamp(1.5rem, 4vw, 2.5rem);
      margin-bottom: 1rem;
      font-weight: 800;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .timeline-item-modern {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .timeline-content-modern {
        border-left: none;
        border-top: 4px solid var(--cyan);
      }

      .content-card {
        padding: 2rem 1.5rem;
        border-radius: 20px;
      }

      .role-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  @include('layouts.navbar')
  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-bg">
      <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
      </div>
    </div>

    <div class="hero-content">
      <div class="hero-badge">
        <i class="fas fa-shield-alt"></i>
        <span>Satuan Pengawas Internal</span>
      </div>

      <h1>Sejarah SPI</h1>
      <h2>POLITEKNIK NEGERI JEMBER</h2>
      <p>Fondasi Tata Kelola Institusi yang Modern dan Akuntabel</p>
    </div>

    <div class="scroll-indicator">

    </div>
  </section>

  <!-- Main Content -->
  <div class="container main-content">
    <div class="content-card">
      <div class="section-title">
        <h2>Perjalanan Transformasi SPI</h2>
        <p style="color: #64748b; max-width: 800px; margin: 1rem auto 0;">
          Satuan Pengawas Internal (SPI) adalah unit fundamental dalam sistem pengendalian internal perguruan tinggi.
          Evolusinya membawa SPI dari sekadar fungsi pemeriksaan ke mitra strategis manajemen.
        </p>
      </div>

      <!-- Modern Timeline -->
      <div class="timeline-modern">
        @foreach($timelines as $index => $item)
          <div class="timeline-item-modern">
            <div class="timeline-number">{{ $index + 1 }}</div>
            <div class="timeline-content-modern">
              <span class="timeline-year">{{ $item->year }}</span>
              <h4>{{ $item->title }}</h4>
              <p>{{ $item->description }}</p>

              @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('admin.timeline.edit', $item->id) }}" class="btn btn-sm btn-primary mt-2">
                  <i class="fas fa-edit"></i> Edit
                </a>

                <form action="{{ route('admin.timeline.destroy', $item->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger mt-2"
                    onclick="return confirm('Apakah yakin ingin menghapus timeline ini?')">
                    <i class="fas fa-trash"></i> Hapus
                  </button>
                </form>
              @endif

            </div>
          </div>
        @endforeach


        @if(Auth::check() && Auth::user()->role === 'admin')
          <a href="{{ route('admin.timeline.create') }}" class="btn btn-success mt-3">
            <i class="fas fa-plus"></i> Tambah Fase Baru
          </a>
        @endif

      </div>


    </div>



    <!-- CTA Section -->
    <div class="cta-section">
      <div class="cta-content">
        <div class="cta-icon">
          <i class="fas fa-bullhorn"></i>
        </div>
        <h4>Komitmen Kami</h4>
        <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto; opacity: 0.95;">
          Kehadiran SPI adalah komitmen terhadap <strong>Integritas, Transparansi, dan Akuntabilitas</strong> dalam
          pelaksanaan Tri Dharma Perguruan Tinggi.
        </p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Smooth scroll for scroll indicator
    document.querySelector('.scroll-indicator').addEventListener('click', function () {
      document.querySelector('.main-content').scrollIntoView({
        behavior: 'smooth'
      });
    });

    // Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Animate elements on scroll
    document.querySelectorAll('.timeline-item-modern, .role-card-modern, .content-card').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = 'all 0.6s ease';
      observer.observe(el);
    });

    // Add parallax effect to shapes
    document.addEventListener('mousemove', function (e) {
      const shapes = document.querySelectorAll('.shape');
      const mouseX = e.clientX / window.innerWidth;
      const mouseY = e.clientY / window.innerHeight;

      shapes.forEach((shape, index) => {
        const speed = (index + 1) * 20;
        const x = (mouseX - 0.5) * speed;
        const y = (mouseY - 0.5) * speed;
        shape.style.transform = `translate(${x}px, ${y}px)`;
      });
    });
  </script>
</body>

</html>