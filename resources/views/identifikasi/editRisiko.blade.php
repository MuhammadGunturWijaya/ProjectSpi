<!DOCTYPE html>
<html lang="id">

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

    <!-- isinya disini -->
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Form Identifikasi Risiko</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('identifikasi.risiko.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="abjad" class="form-label">Abjad</label>
                            <input type="text" class="form-control" id="abjad" name="abjad" required>
                        </div>
                        <div class="col-md-2">
                            <label for="no" class="form-label">No</label>
                            <input type="number" class="form-control" id="no" name="no" required>
                        </div>
                        <div class="col-md-8">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="proses_bisnis" class="form-label">Proses Bisnis</label>
                        <input type="text" class="form-control" id="proses_bisnis" name="proses_bisnis" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori_risiko" class="form-label">Kategori Risiko</label>
                        <input type="text" class="form-control" id="kategori_risiko" name="kategori_risiko" required>
                    </div>

                    <div class="mb-3">
                        <label for="uraian_risiko" class="form-label">Uraian Risiko</label>
                        <textarea class="form-control" id="uraian_risiko" name="uraian_risiko" rows="3"
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="penyebab_risiko" class="form-label">Penyebab Risiko</label>
                        <textarea class="form-control" id="penyebab_risiko" name="penyebab_risiko" rows="2"
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="sumber_risiko" class="form-label">Sumber Risiko</label>
                        <select class="form-select" id="sumber_risiko" name="sumber_risiko" required>
                            <option value="" selected disabled>Pilih Sumber Risiko</option>
                            <option value="internal">Internal</option>
                            <option value="eksternal">Eksternal</option>
                            <option value="internal_eksternal">Internal & Eksternal</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="akibat" class="form-label">Akibat / Potensi Kerugian</label>
                        <textarea class="form-control" id="akibat" name="akibat" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="pemilik_risiko" class="form-label">Pemilik Risiko</label>
                        <input type="text" class="form-control" id="pemilik_risiko" name="pemilik_risiko" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Risiko</button>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')
</body>

</html>