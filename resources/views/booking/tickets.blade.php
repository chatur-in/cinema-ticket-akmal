<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>E-Ticket - CinemaTicket</title>

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
        button { font-family: inherit; }

        .container {
            width: min(960px, calc(100% - 64px));
            margin: 40px auto 96px;
        }

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

        .success-alert {
            margin: 26px 0;
            padding: 16px 18px;
            border-radius: 14px;
            background: var(--success-soft);
            border: 1px solid #a7f3d0;
            color: #065f46;
            font-size: 14px;
            line-height: 1.7;
        }

        .success-alert strong { font-weight: 800; }

        /* KARTU TIKET */

        .ticket-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin: 24px 0;
            box-shadow: var(--shadow-md);
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 22px 28px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
        }

        .ticket-brand {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            opacity: .9;
            margin-bottom: 6px;
        }

        .ticket-header h2 {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .paid-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 13px;
            background: rgba(255, 255, 255, .22);
            border: 1px solid rgba(255, 255, 255, .5);
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.06em;
            white-space: nowrap;
        }

        .ticket-body {
            display: grid;
            grid-template-columns: 1fr 240px;
            gap: 26px;
            padding: 28px;
        }

        .ticket-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 18px;
        }

        .info-item small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .info-item strong {
            display: block;
            font-size: 14px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .ticket-code {
            color: var(--primary-ink);
            font-size: 15px !important;
            font-weight: 800 !important;
        }

        .seat-highlight {
            display: inline-block;
            padding: 8px 14px;
            background: var(--primary-soft);
            color: var(--primary-ink);
            border-radius: 10px;
            font-size: 20px !important;
            font-weight: 800 !important;
        }

        .qr-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 18px;
            background: var(--bg-soft);
            border: 1.5px dashed var(--border-strong);
            border-radius: 16px;
            text-align: center;
        }

        .qr-frame {
            background: #ffffff;
            padding: 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-panel small {
            color: var(--muted);
            font-size: 12px;
            margin-top: 12px;
            line-height: 1.6;
        }

        .ticket-footer {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 16px 28px;
            border-top: 1.5px dashed var(--border-strong);
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .ticket-footer strong {
            color: var(--primary-ink);
            font-weight: 800;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin: 30px 0;
        }

        .btn {
            flex: 1;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-height: 50px;
            padding: 0 18px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
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

        @media (max-width: 650px) {
            .container { width: calc(100% - 32px); margin-top: 28px; }
            .ticket-body { grid-template-columns: 1fr; }
            .qr-panel { min-height: 240px; }
            .ticket-info { gap: 16px 12px; }
            .ticket-header h2 { font-size: 17px; }
            .actions { flex-direction: column; }
        }

        /* CETAK: latar putih, QR tetap tajam */

        @media print {
            @page {
                size: A4;
                margin: 12mm;
            }

            body {
                background: #ffffff;
                color: #1c1917;
            }

            .navbar,
            .ct-site-header,
            .success-alert,
            .actions,
            footer,
            .eyebrow,
            .subtitle,
            h1 {
                display: none !important;
            }

            .container {
                width: 100%;
                margin: 0;
            }

            .ticket-card {
                box-shadow: none;
                border: 1px solid #d6d3d1;
                margin: 0;
                border-radius: 0;
                break-after: page;
                page-break-after: always;
            }

            .ticket-card:last-child {
                break-after: auto;
                page-break-after: auto;
            }

            .ticket-header,
            .paid-badge,
            .qr-panel,
            .seat-highlight {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="container">

        <div class="eyebrow">Your Digital Ticket</div>

        <h1>E-Ticket CinemaTicket</h1>

        <p class="subtitle">
            Pembayaran berhasil. Berikut tiket elektronik untuk setiap kursi yang kamu pesan.
        </p>

        <div class="success-alert">
            <strong>✓ Pembayaran terverifikasi!</strong>
            Semua tiket di bawah ini telah diterbitkan. Simpan atau cetak tiket sebelum datang ke bioskop.
        </div>

        @foreach($pemesanan->detailKursis as $detail)

            <section class="ticket-card">

                <div class="ticket-header">
                    <div>
                        <div class="ticket-brand">CinemaTicket</div>
                        <h2>{{ $pemesanan->jadwal->film->judul }}</h2>
                    </div>

                    <span class="paid-badge">PAID / LUNAS</span>
                </div>

                <div class="ticket-body">

                    <div class="ticket-info">

                        <div class="info-item">
                            <small>Kode Tiket</small>
                            <strong class="ticket-code">{{ $detail->kode_tiket }}</strong>
                        </div>

                        <div class="info-item">
                            <small>Kode Booking</small>
                            <strong>{{ $pemesanan->kode_booking }}</strong>
                        </div>

                        <div class="info-item">
                            <small>Nama Pemesan</small>
                            <strong>{{ $pemesanan->nama_pemesan }}</strong>
                        </div>

                        <div class="info-item">
                            <small>Tanggal Tayang</small>
                            <strong>{{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d M Y') }}</strong>
                        </div>

                        <div class="info-item">
                            <small>Jam Tayang</small>
                            <strong>
                                {{ substr($pemesanan->jadwal->jam_mulai, 0, 5) }}
                                -
                                {{ substr($pemesanan->jadwal->jam_selesai, 0, 5) }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <small>Studio</small>
                            <strong>{{ $pemesanan->jadwal->studio->nama }}</strong>
                        </div>

                        <div class="info-item">
                            <small>Nomor Kursi</small>
                            <strong class="seat-highlight">{{ $detail->no_kursi }}</strong>
                        </div>

                        <div class="info-item">
                            <small>Harga Tiket</small>
                            <strong>Rp {{ number_format((float) $detail->harga, 0, ',', '.') }}</strong>
                        </div>

                    </div>

                    <div class="qr-panel">

                        <div class="qr-frame">
                            <x-qr-code
                                :data="route('booking.ticket.show', $detail->kode_tiket)"
                                size="210"
                                color="#1c1917"
                                margin="2"
                            />
                        </div>

                        <small>
                            Pindai QR Code untuk membuka halaman verifikasi tiket.
                        </small>

                    </div>

                </div>

                <div class="ticket-footer">
                    <span>Tunjukkan QR Code saat memasuki bioskop.</span>
                    <strong>CINEMATICKET</strong>
                </div>

            </section>

        @endforeach

        <div class="actions">

            <button type="button" class="btn btn-primary" onclick="window.print()">
                Cetak Semua E-Ticket
            </button>

            <a href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}" class="btn btn-secondary">
                Kembali ke Ringkasan
            </a>

        </div>

    </main>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>