@extends('layouts.admin')

@section('title', 'Data Studio')

@section('content')

@php
    $cari      = request('search', '');
    $hasSearch = $cari !== '';
@endphp

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Data Studio</h1>
        <p>Kelola studio dan denah kursi bioskop.</p>
    </div>

    <a href="{{ route('admin.studios.create') }}" class="btn-primary">+ Tambah Studio</a>
</div>

@if(session('success'))
    <div class="alert-success" role="status">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert-error" role="alert">{{ session('error') }}</div>
@endif

<div class="table-card">

    <div class="crud-toolbar">
        <div>
            <h2>Daftar Studio</h2>
            <p class="panel-subtitle">
                Total {{ number_format($studios->total()) }} studio
                @if($hasSearch) &middot; hasil pencarian "{{ $cari }}" @endif
            </p>
        </div>

        <form action="{{ route('admin.studios.index') }}" method="GET" role="search">
            <label for="search" class="visually-hidden">Cari studio</label>
            <input
                type="search"
                id="search"
                name="search"
                class="search-input"
                placeholder="Cari nama atau tipe studio..."
                value="{{ $cari }}"
                maxlength="100"
            >
            <button type="submit" class="btn-secondary">Cari</button>

            @if($hasSearch)
                <a href="{{ route('admin.studios.index') }}" class="btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>Nama Studio</th>
                    <th>Tipe</th>
                    <th>Denah Kursi</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($studios as $studio)

                    <tr>

                        <td>
                            <span class="row-title">{{ $studio->nama }}</span>
                        </td>

                        <td>{{ $studio->tipe }}</td>

                        <td>
                            {{ $studio->jumlah_baris }} baris
                            &times;
                            {{ $studio->kursi_per_baris }} kursi
                        </td>

                        <td>
                            <strong>{{ number_format($studio->kapasitas) }} kursi</strong>
                        </td>

                        <td>
                            @if($studio->status === 'aktif')
                                <span class="pill pill-green">Aktif</span>
                            @else
                                <span class="pill pill-gray">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.studios.edit', $studio->id) }}"
                                    class="btn-edit"
                                    aria-label="Edit {{ $studio->nama }}"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.studios.destroy', $studio->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus studio ini? Studio yang masih memiliki jadwal tidak dapat dihapus.')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn-danger"
                                        aria-label="Hapus {{ $studio->nama }}"
                                    >
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="empty">
                            @if($hasSearch)
                                <strong>Studio tidak ditemukan</strong>
                                <span>Tidak ada studio yang cocok dengan "{{ $cari }}".</span>
                            @else
                                <strong>Belum ada data studio</strong>
                                <span>Tambahkan studio sebelum membuat jadwal tayang.</span>
                            @endif
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @include('admin.partials.pagination', ['paginator' => $studios])

</div>

@endsection