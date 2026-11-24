@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')

@section('content')

@php
    $statusLabels = [
        'menunggu' => 'Menunggu',
        'berhasil' => 'Berhasil',
        'gagal'    => 'Gagal',
    ];

    $methodLabels = [
        'transfer_bank' => 'Transfer Bank',
        'qris'          => 'QRIS',
        'e_wallet'      => 'E-Wallet',
    ];

    $hasFilter = $keyword !== '' || $status !== '';
@endphp

<style>
    .payment-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .payment-summary .order-stat strong { font-size: 25px; }

    .payment-summary .order-stat.is-warning strong { color: var(--warning); }
    .payment-summary .order-stat.is-success strong { color: var(--success); }
    .payment-summary .order-stat.is-danger  strong { color: var(--danger); }

    .revenue-note {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 14px 18px;
        margin-bottom: 20px;
        background: var(--success-soft);
        border: 1px solid #a7f3d0;
        border-radius: var(--radius);
        color: #065f46;
        font-size: var(--fs-sm);
    }

    .revenue-note strong {
        font-size: var(--fs-md);
        font-weight: 800;
    }

    .payment-table .code-link {
        color: var(--info);
        font-weight: 700;
        white-space: nowrap;
    }

    .payment-table .code-link:hover { text-decoration: underline; }

    .payment-table .col-muted {
        color: var(--muted);
        font-size: var(--fs-xs);
        margin-top: 4px;
    }

    .payment-table .amount {
        font-weight: 700;
        white-space: nowrap;
    }

    .payment-table .ref-code {
        font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        font-size: var(--fs-xs);
        color: var(--text-soft);
        overflow-wrap: anywhere;
    }

    .payment-table .empty-state {
        text-align: center;
        padding: 48px 16px !important;
    }

    .payment-table .empty-state strong {
        display: block;
        color: var(--text);
        font-size: var(--fs-md);
        margin-bottom: 6px;
    }

    .payment-table .empty-state span {
        color: var(--muted);
        font-size: var(--fs-sm);
    }

    .result-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 14px;
        color: var(--muted);
        font-size: var(--fs-sm);
    }

    .result-info strong { color: var(--text); }

    .is-disabled {
        opacity: .5;
        pointer-events: none;
    }

    @media (max-width: 1100px) {
        .payment-summary { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .payment-table .col-optional { display: none; }
    }

    @media (max-width: 640px) {
        .payment-summary { grid-template-columns: 1fr 1fr; gap: 10px; }
    }
</style>


{{-- HEADER --}}
<div class="page-heading">
    <div>
        <div class="eyebrow">Manajemen Transaksi</div>
        <h1>Manajemen Pembayaran</h1>
        <p>Pantau seluruh pembayaran tiket yang tercatat di CinemaTicket.</p>
    </div>
</div>


{{-- RINGKASAN --}}
<div class="payment-summary" aria-label="Ringkasan status pembayaran">

    <div class="order-stat">
        <span>Total Pembayaran</span>
        <strong>{{ number_format($stats['total']) }}</strong>
    </div>

    <div class="order-stat is-warning">
        <span>Menunggu</span>
        <strong>{{ number_format($stats['menunggu']) }}</strong>
    </div>

    <div class="order-stat is-success">
        <span>Berhasil</span>
        <strong>{{ number_format($stats['berhasil']) }}</strong>
    </div>

    <div class="order-stat is-danger">
        <span>Gagal</span>
        <strong>{{ number_format($stats['gagal']) }}</strong>
    </div>

</div>

<div class="revenue-note">
    <span>Total nominal pembayaran yang berhasil</span>
    <strong>Rp {{ number_format((float) $stats['nominal_berhasil'], 0, ',', '.') }}</strong>
</div>


{{-- TABEL --}}
<div class="table-card">

    <h2>Daftar Transaksi Pembayaran</h2>
    <p class="panel-subtitle">Seluruh pembayaran yang telah tercatat dalam database.</p>

    {{-- FILTER --}}
    <form
        action="{{ route('admin.pembayarans.index') }}"
        method="GET"
        class="filter-form"
        role="search"
    >
        <label for="q" class="visually-hidden">Cari pembayaran</label>
        <input
            type="search"
            id="q"
            name="q"
            value="{{ $keyword }}"
            placeholder="Cari kode booking, pemesan, HP, film, atau referensi..."
            maxlength="100"
        >

        <label for="status" class="visually-hidden">Filter status pembayaran</label>
        <select id="status" name="status">
            <option value="">Semua Status</option>
            @foreach($statusLabels as $value => $label)
                <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
            @endforeach
        </select>

        <button type="submit" class="filter-button">Cari</button>

        <a
            href="{{ route('admin.pembayarans.index') }}"
            class="reset-button {{ $hasFilter ? '' : 'is-disabled' }}"
            @unless($hasFilter) aria-disabled="true" tabindex="-1" @endunless
        >
            Reset
        </a>
    </form>

    {{-- INFO HASIL --}}
    @if($pembayarans->total() > 0)
        <div class="result-info">
            <span>
                Menampilkan
                <strong>{{ $pembayarans->firstItem() }}–{{ $pembayarans->lastItem() }}</strong>
                dari
                <strong>{{ number_format($pembayarans->total()) }}</strong>
                pembayaran
            </span>

            @if($hasFilter)
                <span>Filter aktif</span>
            @endif
        </div>
    @endif

    {{-- DATA --}}
    <div class="table-wrap">

        <table class="payment-table">

            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Pemesan</th>
                    <th class="col-optional">Film</th>
                    <th>Metode</th>
                    <th>Jumlah</th>
                    <th class="col-optional">Kode Referensi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pembayarans as $pembayaran)

                    @php
                        $pemesanan = $pembayaran->pemesanan;
                    @endphp

                    <tr>

                        {{-- KODE BOOKING --}}
                        <td>
                            <a
                                href="{{ route('admin.pemesanans.show', $pemesanan->id) }}"
                                class="code-link"
                            >
                                {{ $pemesanan->kode_booking }}
                            </a>
                            <div class="col-muted">
                                {{ $pembayaran->created_at?->format('d/m/Y H:i') ?? '-' }}
                            </div>
                        </td>

                        {{-- PEMESAN --}}
                        <td>
                            <div class="customer-name">{{ $pemesanan->nama_pemesan }}</div>
                            <div class="customer-phone">{{ $pemesanan->no_hp }}</div>
                        </td>

                        {{-- FILM --}}
                        <td class="col-optional">
                            <div class="film-name">{{ $pemesanan->jadwal?->film?->judul ?? '-' }}</div>
                        </td>

                        {{-- METODE --}}
                        <td>
                            {{ $methodLabels[$pembayaran->metode_pembayaran] ?? ucfirst($pembayaran->metode_pembayaran) }}
                        </td>

                        {{-- JUMLAH --}}
                        <td>
                            <span class="amount">
                                Rp {{ number_format((float) $pembayaran->jumlah_bayar, 0, ',', '.') }}
                            </span>
                        </td>

                        {{-- REFERENSI --}}
                        <td class="col-optional">
                            <span class="ref-code">{{ $pembayaran->kode_referensi ?? '-' }}</span>
                        </td>

                        {{-- STATUS --}}
                        <td>
                            <span class="status status-{{ $pembayaran->status === 'berhasil' ? 'lunas' : ($pembayaran->status === 'gagal' ? 'dibatalkan' : 'booking') }}">
                                {{ $statusLabels[$pembayaran->status] ?? ucfirst($pembayaran->status) }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <a
                                href="{{ route('admin.pembayarans.show', $pembayaran->id) }}"
                                class="detail-button"
                                aria-label="Lihat detail pembayaran {{ $pemesanan->kode_booking }}"
                            >
                                Detail
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="empty-state">
                            @if($hasFilter)
                                <strong>Tidak ada pembayaran yang cocok</strong>
                                <span>Coba ubah kata kunci atau filter, lalu cari kembali.</span>
                            @else
                                <strong>Belum ada data pembayaran</strong>
                                <span>Pembayaran akan tercatat setelah customer memilih metode pembayaran.</span>
                            @endif
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    @if($pembayarans->hasPages())
        <nav class="pagination-wrap" aria-label="Navigasi halaman">

            @if($pembayarans->onFirstPage())
                <span class="pagination-disabled">← Sebelumnya</span>
            @else
                <a href="{{ $pembayarans->previousPageUrl() }}" rel="prev">← Sebelumnya</a>
            @endif

            <span>
                Halaman {{ $pembayarans->currentPage() }} dari {{ $pembayarans->lastPage() }}
            </span>

            @if($pembayarans->hasMorePages())
                <a href="{{ $pembayarans->nextPageUrl() }}" rel="next">Selanjutnya →</a>
            @else
                <span class="pagination-disabled">Selanjutnya →</span>
            @endif

        </nav>
    @endif

</div>

@endsection