<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Proses Pembayaran - CinemaTicket</title>

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
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.01em;
            margin-bottom: 16px;
        }

        /* HEADER PEMBAYARAN */

        .payment-header {
            text-align: center;
            padding: 28px 18px;
            background: var(--bg-soft);
            border-radius: 18px;
            margin-bottom: 20px;
        }

        .payment-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            border-radius: 50%;
            background: var(--primary-soft);
            font-size: 28px;
        }

        .payment-header h2 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .payment-header p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .method-badge {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 14px;
            border-radius: 999px;
            background: var(--surface);
            border: 1px solid var(--border-strong);
            color: var(--primary-ink);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
        }

        .amount-box {
            text-align: center;
            padding: 22px;
            border-radius: 16px;
            background: var(--bg-soft);
            border: 1.5px dashed var(--primary);
            margin-bottom: 22px;
        }

        .amount-box span {
            display: block;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .amount-box strong {
            display: block;
            color: var(--primary-ink);
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .sim-title {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .sim-desc {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 4px;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.7;
            margin-top: 18px;
            border: 1px solid transparent;
        }

        .alert-success {
            background: var(--success-soft);
            border-color: #a7f3d0;
            color: #065f46;
        }

        .alert-danger {
            background: var(--danger-soft);
            border-color: #fecaca;
            color: #b91c1c;
        }

        .simulation-buttons {
            display: grid;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            width: 100%;
            min-height: 52px;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
        }

        .btn-primary:hover { box-shadow: 0 16px 32px rgba(245, 158, 11, .38); }

        .btn-danger {
            background: #ffffff;
            color: var(--danger);
            border: 1.5px solid #fecaca;
        }

        .btn-danger:hover {
            background: var(--danger-soft);
            border-color: var(--danger);
        }

        .notice {
            margin-top: 20px;
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
            font-weight: 800;
            margin-bottom: 4px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 22px;
        }

        .btn-link {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 16px;
            border-radius: 14px;
            background: var(--surface);
            border: 1px solid var(--border-strong);
            color: var(--text-soft);
            font-size: 13px;
            font-weight: 700;
            transition: border-color .2s ease, color .2s ease;
        }

        .btn-link:hover {
            border-color: var(--primary);
            color: var(--primary-ink);
        }

        /* KANAN */

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

        .booking-code {
            padding: 18px;
            border-radius: 14px;
            background: var(--bg-soft);
            border: 1.5px dashed var(--primary);
            margin-bottom: 16px;
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

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 11px;
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

        .status-menunggu {
            background: var(--primary-soft);
            color: var(--primary-ink);
        }

        .status-berhasil {
            background: var(--success-soft);
            color: #065f46;
        }

        .status-gagal {
            background: var(--danger-soft);
            color: #b91c1c;
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
            .amount-box strong { font-size: 24px; }
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

        <div class="eyebrow">Payment Process</div>

        <h1>Proses Pembayaran</h1>

        <p class="subtitle">
            Selesaikan simulasi pembayaran untuk mengonfirmasi pemesanan tiket CinemaTicket.
        </p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @error('pembayaran')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="content-grid">

            {{-- KOLOM KIRI --}}

            <div>

                <section class="card">

                    <div class="payment-header">
                        <div class="payment-icon">💳</div>
                        <h2>Konfirmasi Pembayaran</h2>
                        <p>Metode pembayaran yang kamu pilih:</p>

                        <span class="method-badge">
                            @switch($pemesanan->pembayaran->metode_pembayaran)
                                @case('transfer_bank')
                                    TRANSFER BANK
                                    @break
                                @case('qris')
                                    QRIS
                                    @break
                                @case('e_wallet')
                                    E-WALLET
                                    @break
                                @default
                                    {{ strtoupper($pemesanan->pembayaran->metode_pembayaran) }}
                            @endswitch
                        </span>
                    </div>

                    <div class="amount-box">
                        <span>Total yang Harus Dibayar</span>
                        <strong>Rp {{ number_format((float) $pemesanan->total_harga, 0, ',', '.') }}</strong>
                    </div>

                    <div class="sim-title">Simulasi Transaksi</div>
                    <p class="sim-desc">
                        Pilih hasil simulasi di bawah ini untuk menguji proses pembayaran aplikasi.
                    </p>

                    @if($pemesanan->pembayaran->status === 'gagal')
                        <div class="alert alert-danger">
                            Pembayaran sebelumnya gagal. Kamu dapat mencoba kembali menggunakan
                            metode pembayaran yang sama.
                        </div>
                    @endif

                    @if($pemesanan->status === 'booking' && $pemesanan->pembayaran->status !== 'berhasil')

                        <div class="simulation-buttons">

                            <form action="{{ route('booking.payment.simulate', $pemesanan->kode_booking) }}" method="POST">
                                @csrf
                                <input type="hidden" name="hasil" value="berhasil">
                                <button type="submit" class="btn btn-primary">
                                    ✓ Simulasikan Pembayaran Berhasil
                                </button>
                            </form>

                            <form action="{{ route('booking.payment.simulate', $pemesanan->kode_booking) }}" method="POST">
                                @csrf
                                <input type="hidden" name="hasil" value="gagal">
                                <button type="submit" class="btn btn-danger">
                                    ✕ Simulasikan Pembayaran Gagal
                                </button>
                            </form>

                        </div>

                    @else

                        <div class="alert alert-success">
                            Pembayaran telah berhasil diselesaikan.
                        </div>

                    @endif

                    <div class="notice">
                        <strong>Catatan Simulasi</strong>
                        Halaman ini hanya digunakan untuk simulasi pembayaran dalam proyek
                        akademik CinemaTicket. Tidak ada transaksi uang sungguhan dan tidak
                        terhubung dengan bank maupun payment gateway.
                    </div>

                    <div class="actions">

                        <a href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}" class="btn-link">
                            Kembali ke Ringkasan
                        </a>

                        @if($pemesanan->status === 'booking')
                            <a href="{{ route('booking.payment.methods', $pemesanan->kode_booking) }}" class="btn-link">
                                Ganti Metode
                            </a>
                        @endif

                    </div>

                </section>

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

                </section>

                <section class="card">

                    <h2>Status Pembayaran</h2>

                    <div class="detail-row">
                        <span>Status Booking</span>
                        <strong>{{ ucfirst($pemesanan->status) }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Status Pembayaran</span>
                        <strong>
                            <span class="status status-{{ $pemesanan->pembayaran->status }}">
                                {{ ucfirst($pemesanan->pembayaran->status) }}
                            </span>
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Kode Referensi</span>
                        <strong>{{ $pemesanan->pembayaran->kode_referensi ?? '-' }}</strong>
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