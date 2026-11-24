<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Ringkasan Pembayaran - CinemaTicket</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @include('layouts.partials.public-navbar-styles')

    <style>
        :root {
            --bg: #fafaf9;
            --bg-soft: #f4f4f5;
            --surface: #ffffff;
            --border: #e7e5e4;
            --border-strong: #d6d3d1;
            --text: #1c1917;
            --text-soft: #44403c;
            --muted: #78716c;
            --primary: #f59e0b;
            --primary-soft: #fef3c7;
            --primary-ink: #92400e;
            --success: #059669;
            --success-soft: #d1fae5;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --shadow-md: 0 14px 36px rgba(28, 25, 23, .10);
            --radius: 16px;
            --radius-lg: 22px;
            --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-sans);
            font-size: 15px;
            line-height: 1.6;
            color: var(--text);
            background: var(--bg);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; text-decoration: none; }

        .container {
            width: min(1040px, calc(100% - 64px));
            margin: 40px auto 96px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--primary-ink);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .back-link:hover { text-decoration: underline; }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            background: var(--primary-soft);
            color: var(--primary-ink);
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .eyebrow::before {
            content: "";
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--primary);
        }

        h1 {
            font-size: clamp(28px, 3.4vw, 36px);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.75;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 22px;
            margin-top: 32px;
            align-items: start;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-md);
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.01em;
            margin-bottom: 18px;
        }

        .booking-code {
            padding: 20px;
            border-radius: 16px;
            background: var(--bg-soft);
            border: 1.5px dashed var(--primary);
            margin-bottom: 20px;
        }

        .booking-code small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .booking-code strong {
            color: var(--primary-ink);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.04em;
            overflow-wrap: anywhere;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-row span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .detail-row strong {
            font-size: 14px;
            font-weight: 700;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .seat-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 6px;
        }

        .seat-tag {
            padding: 6px 10px;
            border-radius: 8px;
            background: var(--primary-soft);
            color: var(--primary-ink);
            font-size: 12px;
            font-weight: 800;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .price-row span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .price-row strong { font-size: 14px; font-weight: 700; }

        .total-box {
            margin-top: 18px;
            padding: 20px;
            border-radius: 16px;
            background: var(--bg-soft);
        }

        .total-box span {
            display: block;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .total-box strong {
            display: block;
            color: var(--primary-ink);
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .status::before {
            content: "";
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-booking,
        .status-menunggu {
            background: var(--primary-soft);
            color: var(--primary-ink);
        }

        .status-lunas,
        .status-berhasil {
            background: var(--success-soft);
            color: #065f46;
        }

        .status-gagal,
        .status-dibatalkan,
        .status-kedaluwarsa {
            background: var(--danger-soft);
            color: #b91c1c;
        }

        .info-box {
            padding: 16px 18px;
            border-radius: 14px;
            background: var(--primary-soft);
            border: 1px solid #fde68a;
            color: var(--primary-ink);
            font-size: 13px;
            line-height: 1.7;
            margin-top: 18px;
        }

        .info-box strong {
            display: block;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .info-box.success {
            background: var(--success-soft);
            border-color: #a7f3d0;
            color: #065f46;
        }

        .info-box.danger {
            background: var(--danger-soft);
            border-color: #fecaca;
            color: #b91c1c;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 0 20px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
        }

        .btn-secondary {
            background: var(--surface);
            border: 1px solid var(--border-strong);
            color: var(--text-soft);
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary-ink);
        }

        footer {
            padding: 28px 24px;
            text-align: center;
            background: var(--surface);
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
        }

        @media (max-width: 860px) {
            .content-grid { grid-template-columns: 1fr; }
            .container { width: calc(100% - 32px); margin-top: 28px; }
            h1 { font-size: 26px; }
        }

        @media (max-width: 500px) {
            .card { padding: 22px; }
            .actions { flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="container">

        <a href="{{ route('booking.success', $pemesanan->kode_booking) }}" class="back-link">
            ← Kembali ke konfirmasi booking
        </a>

        <div class="eyebrow">Payment Summary</div>

        <h1>Ringkasan Pembayaran</h1>

        <p class="subtitle">
            Periksa kembali informasi pemesanan dan rincian pembayaran sebelum melanjutkan.
        </p>

        <div class="content-grid">

            {{-- KOLOM KIRI --}}

            <div>

                <section class="card">

                    <h2>Informasi Pemesanan</h2>

                    <div class="booking-code">
                        <small>Kode Booking</small>
                        <strong>{{ $pemesanan->kode_booking }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Nama Pemesan</span>
                        <strong>{{ $pemesanan->nama_pemesan }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Nomor HP</span>
                        <strong>{{ $pemesanan->no_hp }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Status Booking</span>
                        <strong>
                            <span class="status status-{{ $pemesanan->status }}">
                                {{ ucfirst($pemesanan->status) }}
                            </span>
                        </strong>
                    </div>

                </section>

                <section class="card">

                    <h2>Informasi Penayangan</h2>

                    <div class="detail-row">
                        <span>Judul Film</span>
                        <strong>{{ $pemesanan->jadwal->film->judul }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Genre</span>
                        <strong>{{ $pemesanan->jadwal->film->genre }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Tanggal Tayang</span>
                        <strong>{{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d M Y') }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Jam Tayang</span>
                        <strong>
                            {{ date('H:i', strtotime($pemesanan->jadwal->jam_mulai)) }}
                            -
                            {{ date('H:i', strtotime($pemesanan->jadwal->jam_selesai)) }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Studio</span>
                        <strong>{{ $pemesanan->jadwal->studio->nama }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Kursi</span>
                        <div class="seat-list">
                            @foreach($pemesanan->detailKursis as $detail)
                                <span class="seat-tag">{{ $detail->no_kursi }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="detail-row">
                        <span>Jumlah Tiket</span>
                        <strong>{{ $pemesanan->detailKursis->count() }} Tiket</strong>
                    </div>

                </section>

            </div>

            {{-- KOLOM KANAN --}}

            <div>

                <section class="card">

                    <h2>Rincian Pembayaran</h2>

                    <div class="price-row">
                        <span>Harga per Tiket</span>
                        <strong>Rp {{ number_format((float) $pemesanan->jadwal->harga, 0, ',', '.') }}</strong>
                    </div>

                    <div class="price-row">
                        <span>Jumlah Tiket</span>
                        <strong>{{ $pemesanan->detailKursis->count() }} Tiket</strong>
                    </div>

                    <div class="price-row">
                        <span>Biaya Tambahan</span>
                        <strong>Rp 0</strong>
                    </div>

                    <div class="total-box">
                        <span>Total yang Harus Dibayar</span>
                        <strong>Rp {{ number_format((float) $pemesanan->total_harga, 0, ',', '.') }}</strong>
                    </div>

                </section>

                <section class="card">

                    <h2>Status Pembayaran</h2>

                    @if($pemesanan->pembayaran)

                        <div class="detail-row">
                            <span>Metode Pembayaran</span>
                            <strong>
                                {{ strtoupper(str_replace('_', ' ', $pemesanan->pembayaran->metode_pembayaran)) }}
                            </strong>
                        </div>

                        <div class="detail-row">
                            <span>Kode Referensi</span>
                            <strong>{{ $pemesanan->pembayaran->kode_referensi ?? '-' }}</strong>
                        </div>

                        <div class="detail-row">
                            <span>Status Pembayaran</span>
                            <strong>
                                <span class="status status-{{ $pemesanan->pembayaran->status }}">
                                    {{ ucfirst($pemesanan->pembayaran->status) }}
                                </span>
                            </strong>
                        </div>

                    @else

                        <div class="info-box">
                            <strong>Belum Ada Pembayaran</strong>
                            Kamu sudah berhasil melakukan booking. Silakan lanjutkan ke tahap
                            pemilihan metode pembayaran.
                        </div>

                    @endif

                </section>

                @if($pemesanan->status === 'lunas' && $pemesanan->pembayaran?->status === 'berhasil')

                    <div class="info-box success">
                        <strong>✓ Pembayaran Berhasil</strong>
                        Pembayaran telah terverifikasi dan pemesanan sudah berstatus lunas.
                        E-ticket kamu sudah tersedia dan dapat dicetak.
                    </div>

                @elseif($pemesanan->pembayaran?->status === 'gagal')

                    <div class="info-box danger">
                        <strong>Pembayaran Gagal</strong>
                        Pembayaran belum berhasil. Kamu masih dapat mencoba kembali.
                    </div>

                @elseif($pemesanan->pembayaran)

                    <div class="info-box">
                        <strong>Pembayaran Menunggu</strong>
                        Metode pembayaran telah dipilih. Silakan lanjutkan proses pembayaran.
                    </div>

                @else

                    <div class="info-box">
                        <strong>Belum Ada Pembayaran</strong>
                        Silakan pilih metode pembayaran untuk menyelesaikan transaksi.
                    </div>

                @endif

                <div class="actions">

                    <a href="{{ route('booking.success', $pemesanan->kode_booking) }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    @if($pemesanan->status === 'lunas' && $pemesanan->pembayaran?->status === 'berhasil')

                        <a href="{{ route('booking.tickets.index', $pemesanan->kode_booking) }}" class="btn btn-primary">
                            Lihat E-Ticket
                        </a>

                    @elseif($pemesanan->status === 'booking' && $pemesanan->pembayaran)

                        <a href="{{ route('booking.payment.process', $pemesanan->kode_booking) }}" class="btn btn-primary">
                            Lanjutkan Pembayaran
                        </a>

                    @elseif($pemesanan->status === 'booking')

                        <a href="{{ route('booking.payment.methods', $pemesanan->kode_booking) }}" class="btn btn-primary">
                            Pilih Metode Pembayaran
                        </a>

                    @endif

                </div>

            </div>

        </div>

    </main>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>