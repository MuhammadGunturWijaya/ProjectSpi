@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Langkah Proses Bisnis</h2>

    <form action="{{ route('processes.update', $process->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul Langkah</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $process->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $process->description }}</textarea>
        </div>


        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('processes.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
