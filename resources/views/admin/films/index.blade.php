@extends('layouts.admin')

@section('title', 'Data Film')

@section('content')

@php
    $cari      = request('search', '');
    $hasSearch = $cari !== '';
@endphp

<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Data</div>
        <h1>Data Film</h1>
        <p>Kelola film yang tayang dan tidak tayang di CinemaTicket.</p>
    </div>

    <a href="{{ route('admin.films.create') }}" class="btn-primary">+ Tambah Film</a>
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
            <h2>Daftar Film</h2>
            <p class="panel-subtitle">
                Total {{ number_format($films->total()) }} film
                @if($hasSearch) &middot; hasil pencarian "{{ $cari }}" @endif
            </p>
        </div>

        <form action="{{ route('admin.films.index') }}" method="GET" role="search">
            <label for="search" class="visually-hidden">Cari film</label>
            <input
                type="search"
                id="search"
                name="search"
                class="search-input"
                placeholder="Cari judul atau genre..."
                value="{{ $cari }}"
                maxlength="100"
            >
            <button type="submit" class="btn-secondary">Cari</button>

            @if($hasSearch)
                <a href="{{ route('admin.films.index') }}" class="btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>Poster</th>
                    <th>Judul Film</th>
                    <th>Genre</th>
                    <th>Durasi</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($films as $film)

                    <tr>

                        <td>
                            @if($film->poster)
                                <img
                                    src="{{ asset('storage/' . $film->poster) }}"
                                    class="poster-thumb"
                                    alt="Poster {{ $film->judul }}"
                                    loading="lazy"
                                    decoding="async"
                                >
                            @else
                                <span class="poster-thumb-empty" aria-label="Poster belum tersedia">🎬</span>
                            @endif
                        </td>

                        <td>
                            <span class="row-title">{{ $film->judul }}</span>
                        </td>

                        <td>{{ $film->genre }}</td>

                        <td>{{ $film->durasi_menit }} menit</td>

                        <td>
                            <span class="pill pill-gray">{{ $film->rating_usia }}</span>
                        </td>

                        <td>
                            @if($film->status === 'tayang')
                                <span class="pill pill-green">Tayang</span>
                            @else
                                <span class="pill pill-gray">Tidak Tayang</span>
                            @endif
                        </td>

                        <td>
                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.films.edit', $film->id) }}"
                                    class="btn-edit"
                                    aria-label="Edit film {{ $film->judul }}"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.films.destroy', $film->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus film ini? Film yang masih memiliki jadwal tidak dapat dihapus.')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn-danger"
                                        aria-label="Hapus film {{ $film->judul }}"
                                    >
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty">
                            @if($hasSearch)
                                <strong>Film tidak ditemukan</strong>
                                <span>Tidak ada film yang cocok dengan "{{ $cari }}".</span>
                            @else
                                <strong>Belum ada data film</strong>
                                <span>Tambahkan film pertama untuk mulai membuat jadwal.</span>
                            @endif
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @include('admin.partials.pagination', ['paginator' => $films])

</div>

@endsection