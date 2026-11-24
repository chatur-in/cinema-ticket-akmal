<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Booking Berhasil - CinemaTicket</title>

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
            --shadow-lg: 0 28px 70px rgba(28, 25, 23, .16);
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
            width: min(720px, calc(100% - 64px));
            margin: 48px auto 96px;
        }

        .success-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        /* HEADER */

        .success-header {
            position: relative;
            text-align: center;
            padding: 44px 28px 36px;
            background: linear-gradient(180deg, #ecfdf5, #ffffff);
            border-bottom: 1px solid var(--border);
        }

        .success-icon {
            width: 68px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: var(--success);
            color: #ffffff;
            font-size: 30px;
            font-weight: 800;
            box-shadow: 0 12px 28px rgba(5, 150, 105, .28);
        }

        .success-header h1 {
            font-size: clamp(24px, 3vw, 30px);
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 10px;
        }

        .success-header p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.75;
            max-width: 480px;
            margin: 0 auto;
        }

        /* KODE BOOKING */

        .booking-code {
            margin: 26px 28px 0;
            padding: 22px;
            text-align: center;
            background: var(--bg-soft);
            border: 1.5px dashed var(--primary);
            border-radius: 16px;
        }

        .booking-code small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .booking-code strong {
            display: block;
            color: var(--primary-ink);
            font-size: clamp(20px, 3vw, 26px);
            font-weight: 800;
            letter-spacing: 0.06em;
            overflow-wrap: anywhere;
        }

        .booking-code p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 10px;
            line-height: 1.6;
        }

        /* DETAIL */

        .booking-content {
            padding: 8px 28px 28px;
        }

        .booking-content h2 {
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.02em;
            color: var(--text-soft);
            margin: 24px 0 6px;
            text-transform: uppercase;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

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

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
            padding: 18px;
            background: var(--bg-soft);
            border-radius: 14px;
        }

        .total-row span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .total-row strong {
            color: var(--primary-ink);
            font-size: 22px;
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

        .status-booking {
            background: var(--primary-soft);
            color: var(--primary-ink);
        }

        .status-lunas {
            background: var(--success-soft);
            color: #065f46;
        }

        .status-cancelled {
            background: var(--danger-soft);
            color: #b91c1c;
        }

        /* NOTICE */

        .notice {
            margin: 0 28px 24px;
            padding: 16px 18px;
            border-radius: 14px;
            background: var(--primary-soft);
            border: 1px solid #fde68a;
            color: var(--primary-ink);
            font-size: 13px;
            line-height: 1.75;
        }

        .notice strong {
            display: block;
            margin-bottom: 4px;
            font-weight: 800;
        }

        /* TOMBOL */

        .actions {
            display: flex;
            gap: 12px;
            padding: 0 28px 30px;
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
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
        }

        .btn-primary:hover { box-shadow: 0 16px 32px rgba(245, 158, 11, .38); }

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

        @media (max-width: 600px) {
            .container { width: calc(100% - 32px); margin-top: 28px; }
            .booking-code { margin: 20px 18px 0; }
            .booking-content { padding: 6px 18px 22px; }
            .notice { margin: 0 18px 20px; }
            .actions { flex-direction: column; padding: 0 18px 24px; }
            .detail-row { gap: 10px; }
            .total-row strong { font-size: 19px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="container">

        <div class="success-card">

            {{-- HEADER --}}

            <div class="success-header">
                <div class="success-icon">✓</div>
                <h1>Pemesanan Berhasil!</h1>
                <p>
                    Terima kasih telah melakukan pemesanan tiket di CinemaTicket.
                    Berikut adalah rincian booking kamu.
                </p>
            </div>

            {{-- KODE BOOKING --}}

            <div class="booking-code">
                <small>Kode Booking</small>
                <strong>{{ $pemesanan->kode_booking }}</strong>
                <p>Simpan kode booking ini untuk proses pembayaran dan pemeriksaan pemesanan.</p>
            </div>

            {{-- RINCIAN --}}

            <div class="booking-content">

                <h2>Informasi Pemesan</h2>

                <div class="detail-row">
                    <span>Nama Pemesan</span>
                    <strong>{{ $pemesanan->nama_pemesan }}</strong>
                </div>

                <div class="detail-row">
                    <span>Nomor HP</span>
                    <strong>{{ $pemesanan->no_hp }}</strong>
                </div>

                <h2>Informasi Penayangan</h2>

                <div class="detail-row">
                    <span>Film</span>
                    <strong>{{ $pemesanan->jadwal->film->judul }}</strong>
                </div>

                <div class="detail-row">
                    <span>Tanggal</span>
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

                <div class="detail-row">
                    <span>Status Pemesanan</span>
                    <strong>
                        @if($pemesanan->status === 'booking')
                            <span class="status status-booking">Menunggu Pembayaran</span>
                        @elseif($pemesanan->status === 'lunas')
                            <span class="status status-lunas">Lunas</span>
                        @elseif($pemesanan->status === 'dibatalkan')
                            <span class="status status-cancelled">Dibatalkan</span>
                        @elseif($pemesanan->status === 'kedaluwarsa')
                            <span class="status status-cancelled">Kedaluwarsa</span>
                        @endif
                    </strong>
                </div>

                <div class="total-row">
                    <span>Total Pemesanan</span>
                    <strong>Rp {{ number_format((float) $pemesanan->total_harga, 0, ',', '.') }}</strong>
                </div>

            </div>

            {{-- INFORMASI --}}

            @if($pemesanan->status === 'booking')
                <div class="notice">
                    <strong>Informasi</strong>
                    Pemesanan berhasil dibuat dan berstatus menunggu pembayaran.
                    Silakan lanjutkan ke tahap pembayaran untuk mengonfirmasi tiketmu.
                </div>
            @endif

            {{-- TOMBOL --}}

            <div class="actions">

                @if($pemesanan->status === 'booking')
                    <a
                        href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}"
                        class="btn btn-primary"
                    >
                        Lanjutkan Pembayaran →
                    </a>
                @endif

                <a href="{{ route('home') }}" class="btn btn-secondary">
                    Kembali ke Beranda
                </a>

            </div>

        </div>

    </main>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>