@extends('layouts.admin')

@section('title', 'Tambah Film')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Tambah Film</h1>
        <p>Masukkan informasi film baru ke dalam sistem.</p>
    </div>

    <a href="{{ route('admin.films.index') }}" class="btn-secondary">← Kembali</a>
</div>

@if($errors->any())
    <div class="alert-error" role="alert">
        <strong>Film belum dapat disimpan.</strong>
        Periksa {{ $errors->count() }} isian berikut, lalu coba kembali.
    </div>
@endif

<div class="form-card">

    <form
        action="{{ route('admin.films.store') }}"
        method="POST"
        enctype="multipart/form-data"
        novalidate
    >
        @csrf

        @include('admin.films._form', ['film' => null])

        <div class="form-toolbar">
            <span class="form-hint">Kolom bertanda wajib diisi.</span>

            <div class="form-toolbar-actions">
                <a href="{{ route('admin.films.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Film</button>
            </div>
        </div>
    </form>

</div>

@endsection