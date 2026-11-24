@extends('layouts.admin')

@section('title', 'Detail Pemesanan')

@section('content')

@php
    $jadwal   = $pemesanan->jadwal;
    $film     = $jadwal?->film;
    $studio   = $jadwal?->studio;
    $kursi    = $pemesanan->detailKursis;
    $payment  = $pemesanan->pembayaran;

    $statusLabels = [
        'booking'     => 'Menunggu Bayar',
        'lunas'       => 'Lunas',
        'dibatalkan'  => 'Dibatalkan',
        'kedaluwarsa' => 'Kedaluwarsa',
    ];

    $paymentLabels = [
        'menunggu' => 'Menunggu',
        'berhasil' => 'Berhasil',
        'gagal'    => 'Gagal',
    ];

    $methodLabels = [
        'transfer_bank' => 'Transfer Bank',
        'qris'          => 'QRIS',
        'e_wallet'      => 'E-Wallet',
    ];

    $hargaPerTiket = $kursi->isNotEmpty()
        ? (float) $kursi->first()->harga
        : (float) ($jadwal?->harga ?? 0);

    $tanggalTayang = $jadwal
        ? \Carbon\Carbon::parse($jadwal->tanggal_tayang)->locale('id')->translatedFormat('l, d F Y')
        : '-';
@endphp

<style>
    .detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(300px, .9fr);
        gap: 20px;
        align-items: start;
    }

    .detail-stack {
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-width: 0;
    }

    .detail-card h2 {
        font-size: var(--fs-md);
        font-weight: 700;
        margin-bottom: 4px;
    }

    .detail-card .panel-subtitle { margin-bottom: 14px; }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
        font-size: var(--fs-sm);
    }

    .detail-row:last-child { border-bottom: none; }

    .detail-row span { color: var(--muted); }

    .detail-row strong {
        color: var(--text);
        font-weight: 600;
        text-align: right;
        overflow-wrap: anywhere;
    }

    .code-chip {
        font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        font-size: var(--fs-sm);
        font-weight: 700;
        color: var(--info);
        background: var(--info-soft);
        padding: 4px 9px;
        border-radius: var(--radius-sm);
    }

    .seat-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .seat-chip {
        display: inline-flex;
        align-items: center;
        padding: 7px 12px;
        border-radius: var(--radius-sm);
        background: var(--primary-soft);
        color: var(--primary-ink);
        font-size: var(--fs-sm);
        font-weight: 800;
    }

    .summary-total {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #fff;
        border-radius: var(--radius-lg);
        padding: 24px;
        box-shadow: var(--shadow-md);
    }

    .summary-total span {
        color: #cbd5e1;
        font-size: var(--fs-sm);
    }

    .summary-total strong {
        display: block;
        color: #fbbf24;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin-top: 8px;
    }

    .summary-total small {
        display: block;
        color: #94a3b8;
        font-size: var(--fs-xs);
        margin-top: 6px;
    }

    .status-banner {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 16px;
        border-radius: var(--radius);
        font-size: var(--fs-sm);
        line-height: 1.6;
        border: 1px solid transparent;
    }

    .status-banner strong { display: block; margin-bottom: 2px; }

    .status-banner.is-success { background: var(--success-soft); border-color: #a7f3d0; color: #065f46; }
    .status-banner.is-warning { background: var(--warning-soft); border-color: #fde68a; color: var(--primary-ink); }
    .status-banner.is-danger  { background: var(--danger-soft);  border-color: #fecaca; color: #991b1b; }
    .status-banner.is-neutral { background: var(--neutral-soft); border-color: var(--border); color: var(--text-soft); }

    .action-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .action-row .btn-secondary,
    .action-row .btn-primary {
        flex: 1;
        min-width: 160px;
    }

    .muted-empty {
        color: var(--muted);
        font-size: var(--fs-sm);
    }

    @media (max-width: 1100px) {
        .detail-layout { grid-template-columns: 1fr; }
    }
</style>


{{-- HEADER --}}
<div class="page-heading">
    <div>
        <div class="eyebrow">Detail Transaksi</div>
        <h1>Detail Pemesanan</h1>
        <p>
            Kode booking
            <span class="code-chip">{{ $pemesanan->kode_booking }}</span>
        </p>
    </div>

    <a href="{{ route('admin.pemesanans.index') }}" class="btn-secondary">← Kembali</a>
</div>


{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="alert-success" role="status">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert-error" role="alert">{{ session('error') }}</div>
@endif


<div class="detail-layout">

    {{-- KOLOM KIRI --}}
    <div class="detail-stack">

        {{-- PEMESAN --}}
        <section class="table-card detail-card">
            <h2>Informasi Pemesan</h2>
            <p class="panel-subtitle">Data yang dimasukkan customer saat pemesanan.</p>

            <div class="detail-row">
                <span>Nama Pemesan</span>
                <strong>{{ $pemesanan->nama_pemesan }}</strong>
            </div>

            <div class="detail-row">
                <span>Nomor HP</span>
                <strong>{{ $pemesanan->no_hp }}</strong>
            </div>

            <div class="detail-row">
                <span>Tanggal Pemesanan</span>
                <strong>{{ $pemesanan->created_at?->format('d/m/Y H:i') ?? '-' }}</strong>
            </div>
        </section>

        {{-- PENAYANGAN --}}
        <section class="table-card detail-card">
            <h2>Informasi Penayangan</h2>
            <p class="panel-subtitle">Film, jadwal, dan studio yang dipesan.</p>

            <div class="detail-row">
                <span>Film</span>
                <strong>{{ $film?->judul ?? '-' }}</strong>
            </div>

            <div class="detail-row">
                <span>Genre &amp; Rating</span>
                <strong>
                    {{ $film?->genre ?? '-' }}
                    @if($film) &middot; {{ $film->rating_usia }} @endif
                </strong>
            </div>

            <div class="detail-row">
                <span>Tanggal Tayang</span>
                <strong>{{ $tanggalTayang }}</strong>
            </div>

            <div class="detail-row">
                <span>Jam Tayang</span>
                <strong>
                    @if($jadwal)
                        {{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }} WIB
                    @else
                        -
                    @endif
                </strong>
            </div>

            <div class="detail-row">
                <span>Studio</span>
                <strong>{{ $studio?->nama ?? '-' }}{{ $studio ? ' · ' . $studio->tipe : '' }}</strong>
            </div>
        </section>

        {{-- KURSI --}}
        <section class="table-card detail-card">
            <h2>Kursi yang Dipesan</h2>
            <p class="panel-subtitle">{{ $kursi->count() }} kursi pada transaksi ini.</p>

            @if($kursi->isNotEmpty())
                <div class="seat-chips">
                    @foreach($kursi as $detail)
                        <span class="seat-chip">{{ $detail->no_kursi }}</span>
                    @endforeach
                </div>
            @else
                <p class="muted-empty">Belum ada kursi yang tercatat.</p>
            @endif
        </section>

    </div>

    {{-- KOLOM KANAN --}}
    <div class="detail-stack">

        {{-- STATUS PEMESANAN --}}
        <section class="table-card detail-card">
            <h2>Status Pemesanan</h2>

            <div style="margin: 12px 0 16px;">
                <span class="status status-{{ $pemesanan->status }}">
                    {{ $statusLabels[$pemesanan->status] ?? ucfirst($pemesanan->status) }}
                </span>
            </div>

            @switch($pemesanan->status)
                @case('lunas')
                    <div class="status-banner is-success">
                        <div>
                            <strong>Pembayaran selesai</strong>
                            E-ticket sudah diterbitkan untuk setiap kursi.
                        </div>
                    </div>
                    @break

                @case('booking')
                    <div class="status-banner is-warning">
                        <div>
                            <strong>Menunggu pembayaran</strong>
                            Customer belum menyelesaikan pembayaran.
                        </div>
                    </div>
                    @break

                @case('dibatalkan')
                    <div class="status-banner is-danger">
                        <div>
                            <strong>Pemesanan dibatalkan</strong>
                            Kursi pada transaksi ini tidak lagi berlaku.
                        </div>
                    </div>
                    @break

                @default
                    <div class="status-banner is-neutral">
                        <div>
                            <strong>Pemesanan kedaluwarsa</strong>
                            Batas waktu pembayaran telah terlewati.
                        </div>
                    </div>
            @endswitch

            <div style="margin-top: 16px;">
                <div class="detail-row">
                    <span>Jumlah Tiket</span>
                    <strong>{{ $kursi->count() }} tiket</strong>
                </div>

                <div class="detail-row">
                    <span>Harga per Tiket</span>
                    <strong>Rp {{ number_format($hargaPerTiket, 0, ',', '.') }}</strong>
                </div>
            </div>
        </section>

        {{-- TOTAL --}}
        <section class="summary-total">
            <span>Total Pemesanan</span>
            <strong>Rp {{ number_format((float) $pemesanan->total_harga, 0, ',', '.') }}</strong>
            <small>{{ $kursi->count() }} tiket × Rp {{ number_format($hargaPerTiket, 0, ',', '.') }}</small>
        </section>

        {{-- PEMBAYARAN --}}
        <section class="table-card detail-card">
            <h2>Pembayaran</h2>

            @if($payment)
                <div class="detail-row">
                    <span>Metode</span>
                    <strong>{{ $methodLabels[$payment->metode_pembayaran] ?? ucfirst($payment->metode_pembayaran) }}</strong>
                </div>

                <div class="detail-row">
                    <span>Status</span>
                    <strong>
                        <span class="status status-{{ $payment->status === 'berhasil' ? 'lunas' : ($payment->status === 'gagal' ? 'dibatalkan' : 'booking') }}">
                            {{ $paymentLabels[$payment->status] ?? ucfirst($payment->status) }}
                        </span>
                    </strong>
                </div>

                <div class="detail-row">
                    <span>Kode Referensi</span>
                    <strong>{{ $payment->kode_referensi ?? '-' }}</strong>
                </div>

                <div class="detail-row">
                    <span>Waktu Bayar</span>
                    <strong>{{ $payment->waktu_bayar?->timezone('Asia/Jakarta')->format('d/m/Y H:i') ?? 'Belum dibayar' }}</strong>
                </div>

                <div style="margin-top: 14px;">
                    <a href="{{ route('admin.pembayarans.show', $payment->id) }}" class="btn-secondary" style="width:100%;">
                        Lihat Detail Pembayaran
                    </a>
                </div>
            @else
                <p class="muted-empty">Customer belum memilih metode pembayaran.</p>
            @endif
        </section>

        {{-- AKSI --}}
        <div class="action-row">
            @if($pemesanan->status === 'lunas' && $payment?->status === 'berhasil')
                <a
                    href="{{ route('booking.tickets.index', $pemesanan->kode_booking) }}"
                    class="btn-primary"
                    target="_blank"
                    rel="noopener"
                >
                    Lihat E-Ticket
                </a>
            @endif
        </div>

        <div class="status-banner is-neutral">
            <div>
                <strong>Informasi administrator</strong>
                Halaman ini hanya untuk memantau detail transaksi. Perubahan status pembayaran dilakukan melalui proses pembayaran customer.
            </div>
        </div>

    </div>

</div>

@endsection