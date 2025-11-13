<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola pernyataan Survey - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light">
    @include('layouts.navbar')

    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <h1 class="fw-bold">
                        <i class="fas fa-list-check me-2"></i> Kelola pernyataan Survey
                    </h1>
                    <p class="text-muted">Tambah, edit, atau hapus pernyataan custom untuk survey</p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form Tambah pernyataan -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Pernyataan Baru
                    </h5>
                    <form action="{{ route('survey.question.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="question_text" class="form-control" 
                                   placeholder="Masukkan teks pernyataan baru..." required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus me-1"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Daftar pernyataan -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-list me-2"></i> Daftar pernyataan Custom
                    </h5>
                    
                    @if($questions->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                            <p>Belum ada pernyataan custom. Tambahkan pernyataan di atas.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">#</th>
                                        <th>pernyataan</th>
                                        <th width="150" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($questions as $question)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div id="text-{{ $question->id }}">
                                                    {{ $question->question_text }}
                                                </div>
                                                <form id="form-{{ $question->id }}" 
                                                      action="{{ route('survey.question.update', $question) }}" 
                                                      method="POST" 
                                                      style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group">
                                                        <input type="text" name="question_text" 
                                                               class="form-control" 
                                                               value="{{ $question->question_text }}" 
                                                               required>
                                                        <button class="btn btn-success btn-sm" type="submit">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button class="btn btn-secondary btn-sm" 
                                                                type="button" 
                                                                onclick="cancelEdit({{ $question->id }})">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-warning" 
                                                        onclick="editQuestion({{ $question->id }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('survey.question.delete', $question) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus pernyataan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('survey.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Survey
                </a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editQuestion(id) {
            document.getElementById('text-' + id).style.display = 'none';
            document.getElementById('form-' + id).style.display = 'block';
        }

        function cancelEdit(id) {
            document.getElementById('text-' + id).style.display = 'block';
            document.getElementById('form-' + id).style.display = 'none';
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    @include('layouts.NavbarBawah')
</body>
</html>