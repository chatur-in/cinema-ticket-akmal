<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Metode Pembayaran - CinemaTicket</title>

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
        button { font-family: inherit; }

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
        }

        .card h2 {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.01em;
            margin-bottom: 8px;
        }

        .card-description {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        /* OPSI METODE */

        .method-list {
            display: grid;
            gap: 12px;
        }

        .method-option {
            display: block;
            position: relative;
            cursor: pointer;
        }

        .method-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .method-content {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 18px;
            border: 1.5px solid var(--border);
            background: var(--surface);
            border-radius: 14px;
            transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
        }

        .method-option:hover .method-content {
            border-color: #fcd34d;
        }

        .method-option input:checked + .method-content {
            border-color: var(--primary);
            background: #fffbeb;
            box-shadow: 0 6px 18px rgba(245, 158, 11, .12);
        }

        .method-option input:focus-visible + .method-content {
            outline: 2px solid var(--primary);
            outline-offset: 3px;
        }

        .method-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-soft);
            border-radius: 12px;
            font-size: 22px;
        }

        .method-text { flex: 1; }

        .method-text strong {
            display: block;
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .method-text small {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .radio-indicator {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            border: 2px solid var(--border-strong);
            border-radius: 50%;
            transition: border-color .2s ease;
        }

        .method-option input:checked + .method-content .radio-indicator {
            border: 6px solid var(--primary);
        }

        .error-message {
            color: var(--danger);
            font-size: 13px;
            font-weight: 600;
            margin-top: 14px;
        }

        .info-box {
            margin-top: 22px;
            padding: 16px 18px;
            border-radius: 14px;
            background: var(--primary-soft);
            border: 1px solid #fde68a;
            color: var(--primary-ink);
            font-size: 13px;
            line-height: 1.75;
        }

        .info-box strong {
            display: block;
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
            padding: 0 20px;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
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

        /* RINGKASAN KANAN */

        .booking-code {
            padding: 18px;
            border-radius: 14px;
            background: var(--bg-soft);
            border: 1.5px dashed var(--primary);
            margin-bottom: 18px;
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
            font-size: 18px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
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
            padding: 5px 9px;
            border-radius: 7px;
            background: var(--primary-soft);
            color: var(--primary-ink);
            font-size: 12px;
            font-weight: 800;
        }

        .total-box {
            margin-top: 18px;
            padding: 20px;
            border-radius: 14px;
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
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.02em;
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
            .method-content { padding: 14px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="container">

        <a href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}" class="back-link">
            ← Kembali ke ringkasan pembayaran
        </a>

        <div class="eyebrow">Payment Method</div>

        <h1>Pilih Metode Pembayaran</h1>

        <p class="subtitle">
            Pilih metode pembayaran yang ingin kamu gunakan untuk menyelesaikan transaksi.
        </p>

        <div class="content-grid">

            {{-- KOLOM KIRI --}}

            <div>

                <form action="{{ route('booking.payment.store-method', $pemesanan->kode_booking) }}" method="POST">

                    @csrf

                    <section class="card">

                        <h2>Metode Pembayaran</h2>

                        <p class="card-description">
                            Silakan pilih salah satu metode pembayaran berikut.
                        </p>

                        <div class="method-list">

                            <label class="method-option">
                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="transfer_bank"
                                    @checked(old('metode_pembayaran', $pemesanan->pembayaran?->metode_pembayaran) === 'transfer_bank')
                                >
                                <span class="method-content">
                                    <span class="method-icon">🏦</span>
                                    <span class="method-text">
                                        <strong>Transfer Bank</strong>
                                        <small>Pembayaran melalui transfer bank.</small>
                                    </span>
                                    <span class="radio-indicator"></span>
                                </span>
                            </label>

                            <label class="method-option">
                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="qris"
                                    @checked(old('metode_pembayaran', $pemesanan->pembayaran?->metode_pembayaran) === 'qris')
                                >
                                <span class="method-content">
                                    <span class="method-icon">▦</span>
                                    <span class="method-text">
                                        <strong>QRIS</strong>
                                        <small>Pembayaran menggunakan kode QR.</small>
                                    </span>
                                    <span class="radio-indicator"></span>
                                </span>
                            </label>

                            <label class="method-option">
                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="e_wallet"
                                    @checked(old('metode_pembayaran', $pemesanan->pembayaran?->metode_pembayaran) === 'e_wallet')
                                >
                                <span class="method-content">
                                    <span class="method-icon">📱</span>
                                    <span class="method-text">
                                        <strong>E-Wallet</strong>
                                        <small>Pembayaran menggunakan dompet digital.</small>
                                    </span>
                                    <span class="radio-indicator"></span>
                                </span>
                            </label>

                        </div>

                        @error('metode_pembayaran')
                            <div class="error-message">{{ $message }}</div>
                        @enderror

                        @error('pembayaran')
                            <div class="error-message">{{ $message }}</div>
                        @enderror

                        <div class="info-box">
                            <strong>Informasi Pembayaran</strong>
                            Sistem CinemaTicket menggunakan simulasi pembayaran untuk keperluan
                            pengujian aplikasi. Tidak ada transaksi uang sungguhan pada tahap ini.
                        </div>

                        <div class="actions">

                            <a href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}" class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan Metode
                            </button>

                        </div>

                    </section>

                </form>

            </div>

            {{-- KOLOM KANAN --}}

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
                        <span>Film</span>
                        <strong>{{ $pemesanan->jadwal->film->judul }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Tanggal Tayang</span>
                        <strong>{{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d M Y') }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Jam Tayang</span>
                        <strong>{{ substr($pemesanan->jadwal->jam_mulai, 0, 5) }}</strong>
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

                    <div class="total-box">
                        <span>Total Pembayaran</span>
                        <strong>Rp {{ number_format((float) $pemesanan->total_harga, 0, ',', '.') }}</strong>
                    </div>

                </section>

            </div>

        </div>

    </main>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>