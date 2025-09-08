<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah SDM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f9fafb, #eef2ff);
    }

    .card {
      border: none;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background: linear-gradient(135deg, #1e3a8a, #4f46e5);
      color: white;
      padding: 20px;
    }

    .card-header h4 {
      margin: 0;
      font-weight: 700;
    }

    .form-label {
      font-weight: 600;
      color: #374151;
    }

    .form-control {
      border-radius: 12px;
      padding: 12px 15px;
      border: 1px solid #d1d5db;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #4f46e5;
      box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
    }

    .input-group-text {
      background: #f3f4f6;
      border: 1px solid #d1d5db;
      border-right: none;
      border-radius: 12px 0 0 12px;
      color: #4f46e5;
    }

    textarea.form-control {
      resize: none;
    }

    .btn-success {
      background: linear-gradient(90deg, #16a34a, #22c55e);
      border: none;
      padding: 12px 24px;
      font-weight: 600;
      border-radius: 12px;
      transition: 0.3s;
    }

    .btn-success:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 18px rgba(22, 163, 74, 0.3);
    }

    .btn-secondary {
      border-radius: 12px;
      padding: 12px 24px;
      font-weight: 600;
    }
  </style>
</head>

<body>
  @include('layouts.navbar')

  <div class="container my-5">
    <div class="card">
      <div class="card-header">
        <h4><i class="bi bi-person-plus-fill me-2"></i> Tambah Sumber Daya Manusia</h4>
      </div>
      <div class="card-body p-4">
        <form action="{{ route('sdm.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label">Nama</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="text" name="nama" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
              <input type="text" name="jabatan" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Bidang</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-diagram-3"></i></span>
              <input type="text" name="bidang" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Biodata</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
              <textarea name="biodata" class="form-control" rows="3" required></textarea>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Pengalaman</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-award"></i></span>
              <input type="text" name="pengalaman" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
              <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Foto</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-image"></i></span>
              <input type="file" name="foto" class="form-control">
            </div>
          </div>

          <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('sdm.index') }}" class="btn btn-secondary">
              <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
              <i class="bi bi-save2 me-1"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('layouts.NavbarBawah')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
