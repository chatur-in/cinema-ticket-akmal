@extends('layouts.admin')

@section('title', 'Edit Film')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Edit Film</h1>
        <p>Perbarui informasi film <strong>{{ $film->judul }}</strong>.</p>
    </div>

    <a href="{{ route('admin.films.index') }}" class="btn-secondary">← Kembali</a>
</div>

@if($errors->any())
    <div class="alert-error" role="alert">
        <strong>Perubahan belum dapat disimpan.</strong>
        Periksa {{ $errors->count() }} isian berikut, lalu coba kembali.
    </div>
@endif

<div class="form-card">

    <form
        action="{{ route('admin.films.update', $film->id) }}"
        method="POST"
        enctype="multipart/form-data"
        novalidate
    >
        @csrf
        @method('PUT')

        @include('admin.films._form', ['film' => $film])

        <div class="form-toolbar">
            <span class="form-hint">
                Terakhir diubah {{ $film->updated_at?->timezone('Asia/Jakarta')->format('d/m/Y H:i') ?? '-' }}
            </span>

            <div class="form-toolbar-actions">
                <a href="{{ route('admin.films.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui Film</button>
            </div>
        </div>
    </form>

</div>

@endsection