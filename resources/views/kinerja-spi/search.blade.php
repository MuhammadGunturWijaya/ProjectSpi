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
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pedomanPengawasan.css') }}">
</head>

<body>
    @include('layouts.navbar')

    <header>
        <div class="header-text-container">
            <h1>{{ $title }}</h1>
        </div>
    </header>

    <div class="search-wrapper">
        <form action="{{ route('kinerjaSPI.search') }}" method="GET" class="search-form" style="display: contents;">
            <div class="input-group">
                <input type="text" name="keyword" placeholder="Cari Kinerja SPI ..." value="{{ request('keyword') }}">
            </div>
            <button type="submit" class="search-btn"><i class="fa fa-search"></i> Cari</button>
            <button type="button" class="adv-btn" id="openAdvModal"><i class="fa fa-sliders-h"></i> Adv. Search</button>
        </form>
    </div>

    <!-- MODAL ADVANCED SEARCH -->
    <div id="advModal" class="modal">
        <div class="modal-box">
            <span class="close">&times;</span>
            <h2 class="modal-title"><i class="fa fa-sliders-h"></i> Advanced Search</h2>

            <form class="adv-form" action="{{ route('kinerjaSPI.search') }}" method="GET">
                <div class="form-group">
                    <label for="keyword">Tentang</label>
                    <input type="text" name="keyword" id="keyword" placeholder="Masukkan kata kunci ..."
                        value="{{ request('keyword') }}">
                </div>

                <div class="form-group">
                    <label for="nomor">Nomor</label>
                    <input type="text" name="nomor" id="nomor" placeholder="Contoh: 12" value="{{ request('nomor') }}">
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" name="tahun" id="tahun" placeholder="2023" value="{{ request('tahun') }}">
                </div>

                <div class="form-group">
                    <label for="bidang">Bidang</label>
                    <input type="text" name="bidang" id="bidang" placeholder="Contoh: Keuangan, Operasional ..."
                        value="{{ request('bidang') }}">
                </div>

                <div class="form-group">
                    <label for="subjek">Subjek</label>
                    <input type="text" name="subjek" id="subjek" placeholder="Contoh: Audit, Pengawasan ..."
                        value="{{ request('subjek') }}">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('advModal');
        const openBtn = document.getElementById('openAdvModal');
        const closeBtn = document.querySelector('.close');

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                modal.style.display = 'block';
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });
        }

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

    <div class="container">
        <h2 class="section-title">{{ $title }}</h2>
        
        <p class="search-info">Menampilkan {{ $kinerjaList->total() }} hasil untuk pencarian</p>

        <div class="document-grid">
            @forelse($kinerjaList as $kinerja)
                <div class="document-card">
                    <div class="card-icon">
                        <i class="fa fa-chart-line"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{ $kinerja->judul }}</h3>
                        <p class="card-subtitle">Tahun: {{ $kinerja->tahun ?? '-' }}</p>
                        @if($kinerja->bidang)
                            <p class="card-subtitle">Bidang: {{ $kinerja->bidang }}</p>
                        @endif
                        @if($kinerja->nomor)
                            <p class="card-subtitle">Nomor: {{ $kinerja->nomor }}</p>
                        @endif
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('kinerjaSPI.show', $kinerja->id) }}" class="action-btn view-btn">
                            <i class="fa fa-eye"></i> Lihat
                        </a>

                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <a href="{{ route('kinerjaSPI.edit', $kinerja->id) }}" class="action-btn edit-btn">
                                <i class="fa fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('kinerjaSPI.destroy', $kinerja->id) }}" method="POST"
                                class="inline-form" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="no-data-message">Tidak ada hasil yang ditemukan untuk pencarian Anda.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $kinerjaList->links() }}
        </div>
    </div>

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f7f9;
            color: #334e68;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1a202c;
            text-align: center;
            margin-bottom: 20px;
        }

        .search-info {
            text-align: center;
            color: #718096;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .document-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .document-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 3rem;
            color: #4a90e2;
            margin-bottom: 20px;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 100%;
        }

        .card-subtitle {
            font-size: 0.9rem;
            color: #718096;
            font-weight: 400;
            margin-bottom: 3px;
        }

        .card-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }

        .action-btn {
            padding: 10px 15px;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease-in-out;
            border: none;
            cursor: pointer;
            line-height: 1;
        }

        .action-btn i {
            font-size: 0.9rem;
        }

        .view-btn {
            background: #4a90e2;
            color: #ffffff;
        }

        .view-btn:hover {
            background: #357bd8;
            box-shadow: 0 4px 15px rgba(53, 123, 216, 0.3);
        }

        .edit-btn {
            background: #f7b731;
            color: #ffffff;
        }

        .edit-btn:hover {
            background: #e0a320;
            box-shadow: 0 4px 15px rgba(247, 183, 49, 0.3);
        }

        .delete-btn {
            background: #e74c3c;
            color: #ffffff;
        }

        .delete-btn:hover {
            background: #c0392b;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .inline-form {
            display: inline-block;
        }

        .no-data-message {
            grid-column: 1 / -1;
            text-align: center;
            font-size: 1.1rem;
            color: #718096;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
    </style>

    @include('layouts.NavbarBawah')
</body>
</html>