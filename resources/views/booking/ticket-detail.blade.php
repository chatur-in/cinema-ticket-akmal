<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Verifikasi Tiket - CinemaTicket</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

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
            --shadow-lg: 0 28px 70px rgba(28, 25, 23, .14);
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
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; text-decoration: none; }
        button { font-family: inherit; }

        .container {
            width: min(560px, calc(100% - 40px));
            margin: 56px auto;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .header {
            text-align: center;
            padding: 36px 28px 30px;
            background: linear-gradient(180deg, #ecfdf5, #ffffff);
            border-bottom: 1px solid var(--border);
        }

        .check {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: var(--success);
            color: #ffffff;
            font-size: 28px;
            font-weight: 800;
            box-shadow: 0 12px 28px rgba(5, 150, 105, .28);
        }

        .header h1 {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 8px;
        }

        .header p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .content { padding: 26px 28px 28px; }

        .brand {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--primary-ink);
            margin-bottom: 18px;
        }

        .ticket-code {
            padding: 18px;
            text-align: center;
            background: var(--bg-soft);
            border: 1.5px dashed var(--primary);
            border-radius: 16px;
            margin-bottom: 22px;
        }

        .ticket-code small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .ticket-code strong {
            color: var(--primary-ink);
            font-size: 18px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
        }

        .detail-row:last-of-type { border-bottom: none; }

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

        .seat {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 8px;
            background: var(--primary-soft);
            color: var(--primary-ink) !important;
            font-size: 16px !important;
            font-weight: 800 !important;
        }

        .qr {
            display: flex;
            justify-content: center;
            margin: 24px 0;
            padding: 16px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .valid {
            padding: 16px 18px;
            background: var(--success-soft);
            border: 1px solid #a7f3d0;
            border-radius: 14px;
            color: #065f46;
            text-align: center;
            font-size: 13px;
            line-height: 1.75;
        }

        .valid strong {
            display: block;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 22px;
        }

        .btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            text-align: center;
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

        @media print {
            @page { size: A4; margin: 15mm; }

            body { background: #ffffff; }

            .container { width: 100%; margin: 0; }

            .card {
                box-shadow: none;
                border: 1px solid #d6d3d1;
            }

            .header,
            .ticket-code,
            .valid,
            .seat {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .actions { display: none; }
        }

        @media (max-width: 500px) {
            .content { padding: 20px 18px 22px; }
            .actions { flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    <main class="container">

        <section class="card">

            <div class="header">
                <div class="check">✓</div>
                <h1>Tiket Valid</h1>
                <p>
                    Tiket ini telah terdaftar dan pembayaran sudah berhasil
                    diverifikasi oleh CinemaTicket.
                </p>
            </div>

            <div class="content">

                <div class="brand">CinemaTicket</div>

                <div class="ticket-code">
                    <small>Kode Tiket</small>
                    <strong>{{ $detailKursi->kode_tiket }}</strong>
                </div>

                <div class="detail-row">
                    <span>Film</span>
                    <strong>{{ $detailKursi->pemesanan->jadwal->film->judul }}</strong>
                </div>

                <div class="detail-row">
                    <span>Nama Pemesan</span>
                    <strong>{{ $detailKursi->pemesanan->nama_pemesan }}</strong>
                </div>

                <div class="detail-row">
                    <span>Kode Booking</span>
                    <strong>{{ $detailKursi->pemesanan->kode_booking }}</strong>
                </div>

                <div class="detail-row">
                    <span>Tanggal</span>
                    <strong>{{ \Carbon\Carbon::parse($detailKursi->pemesanan->jadwal->tanggal_tayang)->format('d M Y') }}</strong>
                </div>

                <div class="detail-row">
                    <span>Jam</span>
                    <strong>{{ substr($detailKursi->pemesanan->jadwal->jam_mulai, 0, 5) }}</strong>
                </div>

                <div class="detail-row">
                    <span>Studio</span>
                    <strong>{{ $detailKursi->pemesanan->jadwal->studio->nama }}</strong>
                </div>

                <div class="detail-row">
                    <span>Nomor Kursi</span>
                    <strong><span class="seat">{{ $detailKursi->no_kursi }}</span></strong>
                </div>

                <div class="detail-row">
                    <span>Harga Tiket</span>
                    <strong>Rp {{ number_format((float) $detailKursi->harga, 0, ',', '.') }}</strong>
                </div>

                <div class="qr">
                    <x-qr-code
                        :data="url()->current()"
                        size="210"
                        color="#1c1917"
                        margin="2"
                    />
                </div>

                <div class="valid">
                    <strong>✓ Pembayaran Terverifikasi</strong>
                    Tiket ini berstatus valid berdasarkan data pemesanan CinemaTicket.
                </div>

                <div class="actions">

                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        Cetak Tiket
                    </button>

                    <a href="{{ route('booking.tickets.index', $detailKursi->pemesanan->kode_booking) }}" class="btn btn-secondary">
                        Semua E-Ticket
                    </a>

                </div>

            </div>

        </section>

    </main>

</body>
</html>