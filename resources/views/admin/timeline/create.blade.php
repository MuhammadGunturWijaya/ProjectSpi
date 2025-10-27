@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Timeline</h2>

    <form action="{{ route('admin.timeline.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tahun</label>
            <input type="text" name="year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
