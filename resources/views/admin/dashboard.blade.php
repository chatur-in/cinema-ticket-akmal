@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

@php
    $statusLabels = [
        'booking'     => 'Menunggu Bayar',
        'lunas'       => 'Lunas',
        'dibatalkan'  => 'Dibatalkan',
        'kedaluwarsa' => 'Kedaluwarsa',
    ];
@endphp

<div class="page-heading">
    <div>
        <div class="eyebrow">Overview</div>
        <h1>Dashboard</h1>
        <p>Selamat datang di panel administrator CinemaTicket. Berikut ringkasan data bioskop.</p>
    </div>

    <div class="date-pill">
        {{ now('Asia/Jakarta')->locale('id')->translatedFormat('l, d F Y') }}
    </div>
</div>


{{-- STATISTIK --}}
<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-top">
            Total Film
            <span class="stat-icon" aria-hidden="true">🎬</span>
        </div>
        <div class="stat-value">{{ number_format($stats['films']) }}</div>
        <div class="stat-description">Film terdaftar dalam sistem</div>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            Total Studio
            <span class="stat-icon" aria-hidden="true">🏢</span>
        </div>
        <div class="stat-value">{{ number_format($stats['studios']) }}</div>
        <div class="stat-description">Studio bioskop terdaftar</div>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            Total Jadwal
            <span class="stat-icon" aria-hidden="true">🗓️</span>
        </div>
        <div class="stat-value">{{ number_format($stats['schedules']) }}</div>
        <div class="stat-description">Jadwal penayangan tersimpan</div>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            Total Pemesanan
            <span class="stat-icon" aria-hidden="true">🎟️</span>
        </div>
        <div class="stat-value">{{ number_format($stats['orders']) }}</div>
        <div class="stat-description">Transaksi pemesanan tercatat</div>
    </div>

</div>


<div class="content-grid">

    {{-- PEMESANAN TERBARU --}}
    <section class="table-card">

        <div class="crud-toolbar">
            <div>
                <h2>Pemesanan Terbaru</h2>
                <p class="panel-subtitle">Lima transaksi terakhir yang tercatat dalam sistem.</p>
            </div>

            <a href="{{ route('admin.pemesanans.index') }}" class="btn-secondary">Lihat Semua</a>
        </div>

        <div class="table-wrap">

            <table>

                <thead>
                    <tr>
                        <th>Kode Booking</th>
                        <th>Pemesan</th>
                        <th>Film</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($latestOrders as $order)

                        <tr>
                            <td>
                                <a
                                    href="{{ route('admin.pemesanans.show', $order->id) }}"
                                    class="code-link-inline"
                                >
                                    {{ $order->kode_booking }}
                                </a>
                                <div class="muted">
                                    {{ $order->created_at?->timezone('Asia/Jakarta')->format('d/m/Y H:i') ?? '-' }}
                                </div>
                            </td>

                            <td>{{ $order->nama_pemesan }}</td>

                            <td>
                                {{ $order->jadwal?->film?->judul ?? '-' }}
                                <div class="muted">{{ $order->jadwal?->studio?->nama ?? '-' }}</div>
                            </td>

                            <td>
                                <span class="status status-{{ $order->status }}">
                                    {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                </span>
                            </td>

                            <td>
                                <strong>Rp {{ number_format((float) $order->total_harga, 0, ',', '.') }}</strong>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="empty">
                                <strong>Belum ada transaksi</strong>
                                <span>Transaksi akan muncul di sini setelah customer melakukan pemesanan.</span>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    {{-- RINGKASAN DAN PINTASAN --}}
    <aside class="table-card">

        <h2>Ringkasan Transaksi</h2>
        <p class="panel-subtitle">Status pemesanan saat ini.</p>

        <div style="margin-top: 14px;">
            <div class="summary-item">
                <span>Menunggu pembayaran</span>
                <strong>{{ number_format($stats['booking']) }}</strong>
            </div>

            <div class="summary-item">
                <span>Sudah lunas</span>
                <strong>{{ number_format($stats['paid']) }}</strong>
            </div>
        </div>

        <div class="summary-note" style="margin-top: 14px;">
            Angka ini dihitung langsung dari database. Pembayaran yang gagal atau kedaluwarsa tidak ditampilkan di sini.
        </div>

        <h3 style="font-size: var(--fs-sm); font-weight: 700; margin-top: 22px; color: var(--text);">
            Pintasan
        </h3>

        <nav class="quick-links" aria-label="Pintasan administrator">
            <a href="{{ route('admin.jadwals.create') }}">Tambah jadwal tayang</a>
            <a href="{{ route('admin.films.create') }}">Tambah film</a>
            <a href="{{ route('admin.pembayarans.index') }}">Tinjau pembayaran</a>
        </nav>

    </aside>

</div>

@endsection