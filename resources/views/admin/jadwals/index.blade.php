@extends('layouts.admin')

@section('title', 'Data Jadwal')

@section('content')

@php
    $cari        = request('search', '');
    $statusF     = request('status', '');
    $studioSort  = request('studio_sort');
    $nextSort    = $studioSort === 'asc' ? 'desc' : 'asc';
    $sortIcon    = $studioSort === 'asc' ? '↑' : ($studioSort === 'desc' ? '↓' : '↕');
    $hasFilter   = $cari !== '' || $statusF !== '';
@endphp

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Jadwal Tayang</h1>
        <p>Kelola jadwal penayangan film di seluruh studio.</p>
    </div>

    <a href="{{ route('admin.jadwals.create') }}" class="btn-primary">+ Tambah Jadwal</a>
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
            <h2>Daftar Jadwal Tayang</h2>
            <p class="panel-subtitle">Total {{ number_format($jadwals->total()) }} jadwal terdaftar.</p>
        </div>

        <form action="{{ route('admin.jadwals.index') }}" method="GET" role="search">
            <label for="search" class="visually-hidden">Cari film atau studio</label>
            <input
                type="search"
                id="search"
                name="search"
                class="search-input"
                placeholder="Cari judul film atau studio..."
                value="{{ $cari }}"
                maxlength="100"
            >

            <label for="status" class="visually-hidden">Filter status jadwal</label>
            <select id="status" name="status" class="search-input">
                <option value="">Semua Status</option>
                <option value="aktif" @selected($statusF === 'aktif')>Aktif</option>
                <option value="dibatalkan" @selected($statusF === 'dibatalkan')>Dibatalkan</option>
            </select>

            <button type="submit" class="btn-secondary">Filter</button>

            @if($hasFilter)
                <a href="{{ route('admin.jadwals.index') }}" class="btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>Film</th>
                    <th>
                        <a
                            href="{{ request()->fullUrlWithQuery(['studio_sort' => $nextSort, 'page' => null]) }}"
                            class="sort-link {{ $studioSort ? 'is-active' : '' }}"
                            title="Urutkan berdasarkan studio"
                        >
                            Studio <span>{{ $sortIcon }}</span>
                        </a>
                    </th>
                    <th>Tanggal</th>
                    <th>Jam Tayang</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($jadwals as $jadwal)

                    <tr>

                        <td>
                            <span class="row-title">{{ $jadwal->film?->judul ?? '-' }}</span>
                        </td>

                        <td>{{ $jadwal->studio?->nama ?? '-' }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->locale('id')->translatedFormat('d M Y') }}
                        </td>

                        <td>
                            {{ substr($jadwal->jam_mulai, 0, 5) }}
                            &ndash;
                            {{ substr($jadwal->jam_selesai, 0, 5) }}
                        </td>

                        <td>
                            <strong>Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}</strong>
                        </td>

                        <td>
                            @if($jadwal->status === 'aktif')
                                <span class="pill pill-green">Aktif</span>
                            @else
                                <span class="pill pill-gray">Dibatalkan</span>
                            @endif
                        </td>

                        <td>
                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.jadwals.edit', $jadwal->id) }}"
                                    class="btn-edit"
                                    aria-label="Edit jadwal {{ $jadwal->film?->judul ?? '' }}"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.jadwals.destroy', $jadwal->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini? Jadwal yang sudah memiliki pemesanan tidak dapat dihapus.')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Hapus</button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty">
                            @if($hasFilter)
                                <strong>Jadwal tidak ditemukan</strong>
                                <span>Coba ubah kata kunci atau filter status.</span>
                            @else
                                <strong>Belum ada jadwal penayangan</strong>
                                <span>Tambahkan jadwal setelah film dan studio tersedia.</span>
                            @endif
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @include('admin.partials.pagination', ['paginator' => $jadwals])

</div>

@endsection