<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Data Pemesan - CinemaTicket</title>

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
            --shadow-xs: 0 1px 2px rgba(28, 25, 23, .04);
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
        button, input { font-family: inherit; }

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
            grid-template-columns: 1.1fr .9fr;
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
            margin-bottom: 22px;
        }

        .form-group { margin-bottom: 20px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-soft);
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            height: 50px;
            padding: 0 16px;
            background: var(--surface);
            border: 1px solid var(--border-strong);
            border-radius: 12px;
            color: var(--text);
            font-size: 14px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .form-group input[readonly] {
            background: var(--bg-soft);
            color: var(--text-soft);
            cursor: not-allowed;
        }

        .form-group input:focus:not([readonly]) {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, .15);
        }

        .form-group input::placeholder { color: #a8a29e; }

        .field-error {
            color: var(--danger);
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }

        .help-text {
            color: var(--muted);
            font-size: 12px;
            margin-top: 8px;
            line-height: 1.6;
        }

        .notice {
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 12px;
            background: var(--primary-soft);
            border: 1px solid #fde68a;
            color: var(--primary-ink);
            font-size: 13px;
            line-height: 1.7;
        }

        .btn-submit {
            width: 100%;
            height: 52px;
            margin-top: 10px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(245, 158, 11, .38);
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .btn-back:hover { color: var(--text); }

        /* RINGKASAN */

        .summary-item {
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .summary-item:last-child { border-bottom: none; }

        .summary-item small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .summary-item strong {
            font-size: 14px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .seat-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-top: 6px;
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
            gap: 10px;
            margin-top: 18px;
            padding: 18px;
            background: var(--bg-soft);
            border-radius: 14px;
        }

        .price-row span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .price-row strong {
            color: var(--primary-ink);
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .alert-error {
            background: var(--danger-soft);
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 13px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 13px;
            line-height: 1.7;
        }

        .alert-error div + div { margin-top: 4px; }

        footer {
            padding: 28px 24px;
            text-align: center;
            background: var(--surface);
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
        }

        @media (max-width: 800px) {
            .content-grid { grid-template-columns: 1fr; }
            .container { width: calc(100% - 32px); margin-top: 28px; }
            h1 { font-size: 26px; }
        }

        @media (max-width: 500px) {
            .card { padding: 22px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="container">

        <a href="{{ route('booking.seats') }}" class="back-link">
            ← Kembali ke pemilihan kursi
        </a>

        <div class="eyebrow">Customer Information</div>

        <h1>Data Pemesan</h1>

        <p class="subtitle">
            Lengkapi identitas pemesan untuk menyelesaikan proses booking tiket bioskop.
        </p>

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="content-grid">

            {{-- FORM IDENTITAS --}}

            <section class="card">

                <h2>Informasi Pemesan</h2>

                <form action="{{ route('booking.store') }}" method="POST">

                    @csrf

                    <div class="form-group">
                        <label for="nama_pemesan">Nama Lengkap</label>
                        <input
                            type="text"
                            id="nama_pemesan"
                            value="{{ auth()->user()->name }}"
                            readonly
                        >
                        <p class="help-text">
                            Nama pemesan diambil otomatis dari akun CinemaTicket kamu.
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">Nomor HP</label>
                        <input
                            type="tel"
                            name="no_hp"
                            id="no_hp"
                            placeholder="Contoh: 081234567890"
                            value="{{ old('no_hp') }}"
                            maxlength="20"
                            minlength="8"
                            pattern="[0-9+() -]{8,20}"
                            inputmode="tel"
                            autocomplete="tel"
                            required
                        >
                        <p class="help-text">
                            Gunakan nomor HP aktif agar informasi pemesanan dapat dihubungi.
                        </p>
                        @error('no_hp')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="notice">
                        Pastikan nama dan nomor HP sudah benar sebelum membuat pemesanan.
                    </div>

                    <button type="submit" class="btn-submit">
                        Buat Pemesanan →
                    </button>

                    <a href="{{ route('booking.seats') }}" class="btn-back">
                        Ubah Pilihan Kursi
                    </a>

                </form>

            </section>

            {{-- RINGKASAN --}}

            <section class="card">

                <h2>Ringkasan Pemesanan</h2>

                <div class="summary-item">
                    <small>Film</small>
                    <strong>{{ $jadwal->film->judul }}</strong>
                </div>

                <div class="summary-item">
                    <small>Tanggal Penayangan</small>
                    <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d M Y') }}</strong>
                </div>

                <div class="summary-item">
                    <small>Jam Tayang</small>
                    <strong>
                        {{ date('H:i', strtotime($jadwal->jam_mulai)) }}
                        -
                        {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                    </strong>
                </div>

                <div class="summary-item">
                    <small>Studio</small>
                    <strong>{{ $jadwal->studio->nama }} ({{ $jadwal->studio->tipe }})</strong>
                </div>

                <div class="summary-item">
                    <small>Kursi Dipilih</small>
                    <div class="seat-tags">
                        @foreach($selectedSeats as $seat)
                            <span class="seat-tag">{{ $seat }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="summary-item">
                    <small>Jumlah Kursi</small>
                    <strong>{{ $seatCount }} Kursi</strong>
                </div>

                <div class="summary-item">
                    <small>Harga per Tiket</small>
                    <strong>Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}</strong>
                </div>

                <div class="price-row">
                    <span>Total Harga</span>
                    <strong>Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong>
                </div>

            </section>

        </div>

    </main>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>