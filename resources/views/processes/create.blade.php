@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Langkah Baru</h2>

        <form action="{{ route('processes.store') }}" method="POST">
            @csrf

           

            <script>
                const select = document.getElementById('iconSelect');
                const preview = document.getElementById('iconPreview');

                select.addEventListener('change', function () {
                    const iconClass = this.value;
                    preview.innerHTML = `<i class="${iconClass}"></i><p class="mt-2">${iconClass}</p>`;
                });
            </script>


            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('processes.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection