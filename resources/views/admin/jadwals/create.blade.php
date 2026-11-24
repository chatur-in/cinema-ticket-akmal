@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Tambah Jadwal</h1>
        <p>Atur penayangan film pada studio dan waktu tertentu.</p>
    </div>

    <a href="{{ route('admin.jadwals.index') }}" class="btn-secondary">← Kembali</a>
</div>

@if($errors->any())
    <div class="alert-error" role="alert">
        <strong>Jadwal belum dapat disimpan.</strong>
        Periksa {{ $errors->count() }} isian berikut, lalu coba kembali.
    </div>
@endif

@if($films->isEmpty() || $studios->isEmpty())
    <div class="alert-error" role="alert">
        <strong>Jadwal belum dapat dibuat.</strong>
        Pastikan tersedia minimal satu film berstatus tayang dan satu studio berstatus aktif.
    </div>
@endif

<div class="form-card">

    <form action="{{ route('admin.jadwals.store') }}" method="POST" novalidate>
        @csrf

        @include('admin.jadwals._form', ['jadwal' => null])

        <div class="form-toolbar">
            <span class="form-hint">Kolom bertanda wajib diisi.</span>

            <div class="form-toolbar-actions">
                <a href="{{ route('admin.jadwals.index') }}" class="btn-secondary">Batal</a>
                <button
                    type="submit"
                    class="btn-primary"
                    @disabled($films->isEmpty() || $studios->isEmpty())
                >
                    Simpan Jadwal
                </button>
            </div>
        </div>
    </form>

</div>

@endsection