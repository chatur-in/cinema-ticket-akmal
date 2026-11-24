@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Edit Jadwal</h1>
        <p>
            Perbarui jadwal <strong>{{ $jadwal->film?->judul ?? 'film' }}</strong>
            di {{ $jadwal->studio?->nama ?? 'studio' }}.
        </p>
    </div>

    <a href="{{ route('admin.jadwals.index') }}" class="btn-secondary">← Kembali</a>
</div>

@if($errors->any())
    <div class="alert-error" role="alert">
        <strong>Perubahan belum dapat disimpan.</strong>
        Periksa {{ $errors->count() }} isian berikut, lalu coba kembali.
    </div>
@endif

@if($jadwal->pemesanans()->exists())
    <div class="alert-info" role="status">
        Jadwal ini sudah memiliki pemesanan. Film dan studio tidak dapat diubah
        setelah ada transaksi, dan perubahan jam perlu diperiksa dengan teliti.
    </div>
@endif

<div class="form-card">

    <form action="{{ route('admin.jadwals.update', $jadwal->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        @include('admin.jadwals._form', ['jadwal' => $jadwal])

        <div class="form-toolbar">
            <span class="form-hint">
                Terakhir diubah {{ $jadwal->updated_at?->timezone('Asia/Jakarta')->format('d/m/Y H:i') ?? '-' }}
            </span>

            <div class="form-toolbar-actions">
                <a href="{{ route('admin.jadwals.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Perbarui Jadwal</button>
            </div>
        </div>
    </form>

</div>

@endsection