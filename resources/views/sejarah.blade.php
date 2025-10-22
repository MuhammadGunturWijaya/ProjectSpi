
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
  <title>Sejarah Satuan Pengawas Internal (SPI)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    :root {
      --primary: #0d2d50;
      --secondary: #fca311;
      --accent: #1e88e5;
      --bg-light: #f7f9fb;
      --white: #fff;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--bg-light);
      color: #2c3e50;
      overflow-x: hidden;
      line-height: 1.7;
    }

    h1, h2, h3, h4, h5 {
      font-family: 'Montserrat', sans-serif;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, rgba(13,45,80,0.9), rgba(30,136,229,0.85)), url('https://source.unsplash.com/1600x600/?university,audit') center/cover;
      color: var(--white);
      text-align: center;
      padding: 160px 20px;
      position: relative;
    }
    .hero h1 {
      font-weight: 800;
      font-size: 3.5rem;
    }

    .hero h2 {
      font-weight: 800;
   
    }
    .hero p {
      font-size: 1.3rem;
      color: rgba(255,255,255,0.9);
    }
    .hero::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0; right: 0;
      height: 100px;
      background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJyB2aWV3Qm94PScwIDAgMTYwMCAxMDAwJyBmaWxsPScjZjd m OWZiJz48cGF0aCBkPSdNMCwwIEM1MDAsMTAwMCAxMDAwLDAgMTYwMCwxMDAwIFYwIEgwIFonLz48L3N2Zz4=") no-repeat bottom;
      background-size: cover;
    }

    /* Content Section */
    .content {
      max-width: 1100px;
      margin: -70px auto 50px;
      background: var(--white);
      border-radius: 15px;
      padding: 50px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      position: relative;
      z-index: 10;
    }

    /* Timeline */
    .timeline {
      position: relative;
      padding: 30px 0;
    }
    .timeline::before {
      content: '';
      position: absolute;
      top: 0; bottom: 0;
      left: 50%;
      width: 4px;
      background: linear-gradient(var(--accent), var(--secondary));
      transform: translateX(-50%);
    }
    .timeline-item {
      display: flex;
      margin-bottom: 50px;
      position: relative;
    }
    .timeline-item:nth-child(even) {
      flex-direction: row-reverse;
    }
    .timeline-dot {
      width: 30px; height: 30px;
      background: var(--secondary);
      border-radius: 50%;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      top: 20px;
      box-shadow: 0 0 0 8px rgba(252,163,17,0.3);
    }
    .timeline-box {
      width: 45%;
      background: var(--bg-light);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .timeline-box h4 {
      color: var(--accent);
    }

    /* Role Cards */
    .role-card {
      background: var(--white);
      border-radius: 15px;
      padding: 30px 20px;
      text-align: center;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      transition: 0.4s;
    }
    .role-card:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 10px 30px rgba(13,45,80,0.2);
    }
    .role-card i {
      font-size: 3rem;
      margin-bottom: 15px;
      background: linear-gradient(45deg,var(--secondary),var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Key Message */
    .key-message {
      background: linear-gradient(270deg, var(--primary), var(--accent), var(--secondary));
      background-size: 600% 600%;
      animation: gradientShift 8s ease infinite;
      padding: 50px;
      border-radius: 20px;
      color: var(--white);
      text-align: center;
      margin-top: 60px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    @keyframes gradientShift {
      0% {background-position: 0% 50%}
      50% {background-position: 100% 50%}
      100% {background-position: 0% 50%}
    }

    @media(max-width: 768px){
      .timeline-box {width: 80%;}
      .timeline::before{left: 10px;}
      .timeline-dot{left: 10px; transform: none;}
      .timeline-item{flex-direction: row !important; margin-left: 40px;}
    }
  </style>
</head>

<body>
  @include('layouts.navbar')

  <section class="hero">
    <div class="container">
      <i class="fas fa-shield-alt fa-3x mb-4 text-warning"></i>
      <h1 data-aos="fade-up">Sejarah Satuan Pengawas Internal (SPI)</h1>
      <h2 data-aos="fade-up" data-aos-delay="80"> POLITEKNIK NEGERI JEMBER</h2>
      <p data-aos="fade-up" data-aos-delay="200">Fondasi Tata Kelola Institusi yang Modern dan Akuntabel</p>
    </div>
  </section>

  <div class="content" data-aos="fade-up">
    <h2 class="text-center mb-4">Sejarah SPI</h2>
    <p class="text-center mb-5">Satuan Pengawas Internal (SPI) adalah unit fundamental dalam sistem pengendalian internal perguruan tinggi. Evolusinya membawa SPI dari sekadar fungsi pemeriksaan ke mitra strategis manajemen.</p>

    <!-- Timeline -->
    <div class="timeline">
      <div class="timeline-item" data-aos="fade-right">
        <div class="timeline-dot"></div>
        <div class="timeline-box">
          <h4>Fase Inisiasi</h4>
          <p>Pembentukan unit pengawasan sederhana pasca otonomi kampus, fokus pada verifikasi keuangan dasar.</p>
          <small class="text-muted">20XX</small>
        </div>
      </div>
      <div class="timeline-item" data-aos="fade-left">
        <div class="timeline-dot"></div>
        <div class="timeline-box">
          <h4>Fase Konsolidasi Fungsi</h4>
          <p>Perluasan cakupan pengawasan ke aset, SDM, dan kepatuhan regulasi pemerintah.</p>
          <small class="text-muted">20YY</small>
        </div>
      </div>
      <div class="timeline-item" data-aos="fade-right">
        <div class="timeline-dot"></div>
        <div class="timeline-box">
          <h4>Fase Audit Berbasis Risiko</h4>
          <p>Transformasi menjadi SPI modern dengan metodologi berbasis risiko dan peran konsultasi strategis.</p>
          <small class="text-muted">Saat Ini</small>
        </div>
      </div>
    </div>

    <!-- Roles -->
    <h3 class="text-center my-5" style="color:var(--accent)">Peran Kunci SPI</h3>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3" data-aos="zoom-in">
        <div class="role-card">
          <i class="fas fa-certificate"></i>
          <h6>Assurance Independen</h6>
          <p class="text-muted small">Jaminan objektif efektivitas pengendalian & manajemen risiko.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
        <div class="role-card">
          <i class="fas fa-balance-scale"></i>
          <h6>Kepatuhan Regulasi</h6>
          <p class="text-muted small">Memastikan kegiatan mematuhi standar hukum & kebijakan.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
        <div class="role-card">
          <i class="fas fa-lightbulb"></i>
          <h6>Konsultasi Strategis</h6>
          <p class="text-muted small">Konsultan pimpinan untuk efisiensi & kualitas layanan.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="600">
        <div class="role-card">
          <i class="fas fa-hand-holding-usd"></i>
          <h6>Pengawasan Sumber Daya</h6>
          <p class="text-muted small">Mengawasi aset, keuangan, & SDM agar akuntabel.</p>
        </div>
      </div>
    </div>

    <!-- Key Message -->
    <div class="key-message mt-5" data-aos="fade-up">
      <i class="fas fa-bullhorn mb-3"></i>
      <h4>Kehadiran SPI adalah komitmen terhadap <strong>Integritas, Transparansi, dan Akuntabilitas</strong> dalam Tri Dharma Perguruan Tinggi.</h4>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 1000, once: true });</script>
  @include('layouts.NavbarBawah')
</body>
</html>
