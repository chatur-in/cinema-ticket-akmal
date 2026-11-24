@extends('layouts.admin')

@section('title', 'Tambah Studio')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Tambah Studio</h1>
        <p>Tambahkan studio baru beserta denah kursinya.</p>
    </div>

    <a href="{{ route('admin.studios.index') }}" class="btn-secondary">← Kembali</a>
</div>

@if($errors->any())
    <div class="alert-error" role="alert">
        <strong>Studio belum dapat disimpan.</strong>
        Periksa {{ $errors->count() }} isian berikut, lalu coba kembali.
    </div>
@endif

<div class="form-card">

    <form action="{{ route('admin.studios.store') }}" method="POST" novalidate>
        @csrf

        @include('admin.studios._form', ['studio' => null])

        <div class="form-toolbar">
            <span class="form-hint">Kolom bertanda wajib diisi.</span>

            <div class="form-toolbar-actions">
                <a href="{{ route('admin.studios.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Studio</button>
            </div>
        </div>
    </form>

</div>

@endsection