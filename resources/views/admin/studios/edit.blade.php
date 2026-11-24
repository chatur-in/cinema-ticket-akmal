@extends('layouts.admin')

@section('title', 'Edit Studio')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Edit Studio</h1>
        <p>Perbarui informasi <strong>{{ $studio->nama }}</strong>.</p>
    </div>

    <a href="{{ route('admin.studios.index') }}" class="btn-secondary">← Kembali</a>
</div>

@if($errors->any())
    <div class="alert-error" role="alert">
        <strong>Perubahan belum dapat disimpan.</strong>
        Periksa {{ $errors->count() }} isian berikut, lalu coba kembali.
    </div>
@endif

@if($studio->jadwals()->exists())
    <div class="alert-info" role="status">
        Studio ini memiliki jadwal tayang. Mengubah denah kursi atau status tidak
        memengaruhi jadwal yang sudah dibuat, tetapi perubahan kapasitas perlu diperiksa ulang.
    </div>
@endif

<div class="form-card">

    <form action="{{ route('admin.studios.update', $studio->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        @include('admin.studios._form', ['studio' => $studio])

        <div class="form-toolbar">
            <span class="form-hint">
                Kapasitas tersimpan: {{ $studio->kapasitas }} kursi
            </span>

            <div class="form-toolbar-actions">
                <a href="{{ route('admin.studios.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui Studio</button>
            </div>
        </div>
    </form>

</div>

@endsection