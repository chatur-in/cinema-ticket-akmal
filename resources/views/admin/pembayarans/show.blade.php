@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')

@php
    $pemesanan = $pembayaran->pemesanan;
    $jadwal    = $pemesanan->jadwal;
    $film      = $jadwal?->film;
    $studio    = $jadwal?->studio;
    $kursi     = $pemesanan->detailKursis;

    $methodLabels = [
        'transfer_bank' => 'Transfer Bank',
        'qris'          => 'QRIS',
        'e_wallet'      => 'E-Wallet',
    ];

    $statusLabels = [
        'menunggu' => 'Menunggu',
        'berhasil' => 'Berhasil',
        'gagal'    => 'Gagal',
    ];

    $paymentBadge = match ($pembayaran->status) {
        'berhasil' => 'lunas',
        'gagal'    => 'dibatalkan',
        default    => 'booking',
    };

    $hargaPerTiket = $kursi->isNotEmpty()
        ? (float) $kursi->first()->harga
        : (float) ($jadwal?->harga ?? 0);

    $tanggalTayang = $jadwal
        ? \Carbon\Carbon::parse($jadwal->tanggal_tayang)->locale('id')->translatedFormat('l, d F Y')
        : '-';
@endphp

<style>
    .pay-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(300px, .9fr);
        gap: 20px;
        align-items: start;
    }

    .pay-detail-stack {
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-width: 0;
    }

    .pay-card h2 {
        font-size: var(--fs-md);
        font-weight: 700;
        margin-bottom: 4px;
    }

    .pay-card .panel-subtitle { margin-bottom: 14px; }

    .pay-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
        font-size: var(--fs-sm);
    }

    .pay-row:last-child { border-bottom: none; }

    .pay-row span { color: var(--muted); }

    .pay-row strong {
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

    .ref-code {
        font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        font-size: var(--fs-xs);
        overflow-wrap: anywhere;
    }

    .seat-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: flex-end;
    }

    .seat-chip {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: var(--radius-sm);
        background: var(--primary-soft);
        color: var(--primary-ink);
        font-size: var(--fs-xs);
        font-weight: 800;
    }

    .amount-total {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #fff;
        border-radius: var(--radius-lg);
        padding: 24px;
        box-shadow: var(--shadow-md);
    }

    .amount-total span {
        color: #cbd5e1;
        font-size: var(--fs-sm);
    }

    .amount-total strong {
        display: block;
        color: #fbbf24;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin-top: 8px;
    }

    .amount-total small {
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

    .action-row > * {
        flex: 1;
        min-width: 160px;
        text-align: center;
    }

    .muted-empty {
        color: var(--muted);
        font-size: var(--fs-sm);
    }

    @media (max-width: 1100px) {
        .pay-detail-layout { grid-template-columns: 1fr; }
    }
</style>


{{-- HEADER --}}
<div class="page-heading">
    <div>
        <div class="eyebrow">Detail Transaksi</div>
        <h1>Detail Pembayaran</h1>
        <p>
            Referensi pembayaran
            <span class="code-chip">{{ $pembayaran->kode_referensi ?? 'Belum ada referensi' }}</span>
        </p>
    </div>

    <a href="{{ route('admin.pembayarans.index') }}" class="btn-secondary">← Kembali</a>
</div>


<div class="pay-detail-layout">

    {{-- KOLOM KIRI --}}
    <div class="pay-detail-stack">

        {{-- INFORMASI PEMBAYARAN --}}
        <section class="table-card pay-card">
            <h2>Informasi Pembayaran</h2>
            <p class="panel-subtitle">Data transaksi pembayaran yang tercatat sistem.</p>

            <div class="pay-row">
                <span>Kode Referensi</span>
                <strong><span class="ref-code">{{ $pembayaran->kode_referensi ?? '-' }}</span></strong>
            </div>

            <div class="pay-row">
                <span>Metode Pembayaran</span>
                <strong>{{ $methodLabels[$pembayaran->metode_pembayaran] ?? ucfirst($pembayaran->metode_pembayaran) }}</strong>
            </div>

            <div class="pay-row">
                <span>Status</span>
                <strong>
                    <span class="status status-{{ $paymentBadge }}">
                        {{ $statusLabels[$pembayaran->status] ?? ucfirst($pembayaran->status) }}
                    </span>
                </strong>
            </div>

            <div class="pay-row">
                <span>Waktu Pembayaran</span>
                <strong>
                    {{ $pembayaran->waktu_bayar?->timezone('Asia/Jakarta')->format('d/m/Y H:i') ?? 'Belum dibayar' }}
                </strong>
            </div>

            <div class="pay-row">
                <span>Tanggal Pencatatan</span>
                <strong>{{ $pembayaran->created_at?->timezone('Asia/Jakarta')->format('d/m/Y H:i') ?? '-' }}</strong>
            </div>
        </section>

        {{-- INFORMASI PEMESAN --}}
        <section class="table-card pay-card">
            <h2>Informasi Pemesan</h2>
            <p class="panel-subtitle">Pemesanan yang terhubung dengan pembayaran ini.</p>

            <div class="pay-row">
                <span>Kode Booking</span>
                <strong>
                    <a href="{{ route('admin.pemesanans.show', $pemesanan->id) }}" class="code-link-inline">
                        {{ $pemesanan->kode_booking }}
                    </a>
                </strong>
            </div>

            <div class="pay-row">
                <span>Nama Pemesan</span>
                <strong>{{ $pemesanan->nama_pemesan }}</strong>
            </div>

            <div class="pay-row">
                <span>Nomor HP</span>
                <strong>{{ $pemesanan->no_hp }}</strong>
            </div>

            <div class="pay-row">
                <span>Status Pemesanan</span>
                <strong>
                    <span class="status status-{{ $pemesanan->status }}">
                        {{ ['booking' => 'Menunggu Bayar', 'lunas' => 'Lunas', 'dibatalkan' => 'Dibatalkan', 'kedaluwarsa' => 'Kedaluwarsa'][$pemesanan->status] ?? ucfirst($pemesanan->status) }}
                    </span>
                </strong>
            </div>
        </section>

        {{-- INFORMASI PENAYANGAN --}}
        <section class="table-card pay-card">
            <h2>Informasi Penayangan</h2>
            <p class="panel-subtitle">Film, jadwal, dan kursi yang dibayar.</p>

            <div class="pay-row">
                <span>Film</span>
                <strong>{{ $film?->judul ?? '-' }}</strong>
            </div>

            <div class="pay-row">
                <span>Tanggal Tayang</span>
                <strong>{{ $tanggalTayang }}</strong>
            </div>

            <div class="pay-row">
                <span>Jam Tayang</span>
                <strong>
                    @if($jadwal)
                        {{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }} WIB
                    @else
                        -
                    @endif
                </strong>
            </div>

            <div class="pay-row">
                <span>Studio</span>
                <strong>{{ $studio?->nama ?? '-' }}{{ $studio ? ' · ' . $studio->tipe : '' }}</strong>
            </div>

            <div class="pay-row">
                <span>Kursi</span>
                @if($kursi->isNotEmpty())
                    <div class="seat-chips">
                        @foreach($kursi as $detail)
                            <span class="seat-chip">{{ $detail->no_kursi }}</span>
                        @endforeach
                    </div>
                @else
                    <strong>-</strong>
                @endif
            </div>
        </section>

    </div>

    {{-- KOLOM KANAN --}}
    <div class="pay-detail-stack">

        {{-- TOTAL --}}
        <section class="amount-total">
            <span>Jumlah Pembayaran</span>
            <strong>Rp {{ number_format((float) $pembayaran->jumlah_bayar, 0, ',', '.') }}</strong>
            <small>{{ $kursi->count() }} tiket × Rp {{ number_format($hargaPerTiket, 0, ',', '.') }}</small>
        </section>

        {{-- STATUS TRANSAKSI --}}
        <section class="table-card pay-card">
            <h2>Status Transaksi</h2>

            <div style="margin: 12px 0 16px;">
                <span class="status status-{{ $paymentBadge }}">
                    {{ $statusLabels[$pembayaran->status] ?? ucfirst($pembayaran->status) }}
                </span>
            </div>

            @switch($pembayaran->status)
                @case('berhasil')
                    <div class="status-banner is-success">
                        <div>
                            <strong>Pembayaran berhasil</strong>
                            Pemesanan sudah lunas dan e-ticket tersedia untuk setiap kursi.
                        </div>
                    </div>
                    @break

                @case('gagal')
                    <div class="status-banner is-danger">
                        <div>
                            <strong>Pembayaran gagal</strong>
                            Transaksi belum berhasil. Customer dapat mencoba kembali.
                        </div>
                    </div>
                    @break

                @default
                    <div class="status-banner is-warning">
                        <div>
                            <strong>Menunggu pembayaran</strong>
                            Metode sudah dipilih, tetapi pembayaran belum diselesaikan.
                        </div>
                    </div>
            @endswitch
        </section>

        {{-- AKSI --}}
        <div class="action-row">
            <a href="{{ route('admin.pemesanans.show', $pemesanan->id) }}" class="btn-secondary">
                Detail Pemesanan
            </a>

            @if($pemesanan->status === 'lunas' && $pembayaran->status === 'berhasil')
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
                Status pembayaran diperbarui otomatis oleh proses pembayaran customer. Halaman ini hanya untuk memantau.
            </div>
        </div>

    </div>

</div>

@endsection