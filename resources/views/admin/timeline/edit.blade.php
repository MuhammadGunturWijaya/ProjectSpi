
@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Fase SPI</h2>
    <form action="{{ route('admin.timeline.update', $timeline->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tahun/Fase</label>
            <input type="text" name="year" class="form-control" value="{{ $timeline->year }}" required>
        </div>
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $timeline->title }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="5" required>{{ $timeline->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
