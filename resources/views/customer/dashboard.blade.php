<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Dashboard Customer - CinemaTicket</title>

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
            --success-ink: #065f46;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --danger-ink: #b91c1c;
            --info: #2563eb;
            --info-soft: #dbeafe;
            --info-ink: #1e3a8a;
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
        button { font-family: inherit; }

        .container {
            width: min(1180px, calc(100% - 64px));
            margin: 40px auto 96px;
        }

        /* ---------- WELCOME ---------- */

        .welcome {
            position: relative;
            overflow: hidden;
            padding: 34px 36px;
            background: linear-gradient(120deg, #fef3c7 0%, #ffffff 65%);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 28px;
        }

        .welcome::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            right: -80px;
            top: -110px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, .25), transparent 70%);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            background: var(--surface);
            color: var(--primary-ink);
            border: 1px solid #fde68a;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .welcome h1 {
            font-size: clamp(26px, 3vw, 32px);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .welcome h1 span { color: var(--primary); }

        .welcome p {
            color: var(--text-soft);
            font-size: 14px;
            line-height: 1.75;
            max-width: 600px;
        }

        .btn-gradient {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 20px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(245, 158, 11, .38);
        }

        .welcome .btn-gradient { margin-top: 20px; }

        /* ---------- FLASH ---------- */

        .alert {
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
            border: 1px solid transparent;
        }

        .alert-success { background: var(--success-soft); border-color: #a7f3d0; color: var(--success-ink); }
        .alert-error   { background: var(--danger-soft);  border-color: #fecaca; color: var(--danger-ink); }
        .alert-info    { background: var(--info-soft);    border-color: #bfdbfe; color: var(--info-ink); }

        /* ---------- STATISTIK / FILTER KARTU ---------- */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 36px;
        }

        .stat-card {
            display: flex;
            flex-direction: column;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: var(--shadow-xs);
            transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: #fcd34d;
            box-shadow: var(--shadow-md);
        }

        .stat-card.is-active {
            border-color: var(--primary);
            background: #fffbeb;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .stat-card.is-active .stat-number { color: var(--primary-ink); }

        .stat-desc {
            color: var(--muted);
            font-size: 11px;
            margin-top: 6px;
        }

        /* ---------- RIWAYAT ---------- */

        .section-heading { margin-bottom: 18px; }

        .section-heading h2 {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 14px;
        }

        .filter-tabs {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 6px;
            margin-bottom: 16px;
            scrollbar-width: none;
        }

        .filter-tabs::-webkit-scrollbar { display: none; }

        .filter-tab {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            padding: 10px 14px;
            background: var(--surface);
            border: 1px solid var(--border-strong);
            border-radius: 12px;
            color: var(--text-soft);
            font-size: 13px;
            font-weight: 700;
            transition: border-color .2s ease, color .2s ease, background .2s ease;
        }

        .filter-tab:hover {
            border-color: var(--primary);
            color: var(--primary-ink);
        }

        .filter-tab.is-active {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            border-color: transparent;
            color: #ffffff;
        }

        .filter-count {
            min-width: 22px;
            height: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 6px;
            background: var(--bg-soft);
            border-radius: 999px;
            font-size: 11px;
            color: var(--text-soft);
        }

        .filter-tab.is-active .filter-count {
            background: rgba(255, 255, 255, .25);
            color: #ffffff;
        }

        /* ---------- KARTU BOOKING ---------- */

        .booking-card {
            display: flex;
            gap: 22px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: var(--shadow-xs);
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .booking-card:hover {
            border-color: #fcd34d;
            box-shadow: var(--shadow-md);
        }

        .poster-wrap {
            position: relative;
            width: 100px;
            min-width: 100px;
            height: 140px;
            overflow: hidden;
            background: var(--bg-soft);
            border-radius: 12px;
        }

        .poster-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .poster-fallback {
            position: absolute;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 10px;
            line-height: 1.4;
        }

        .poster-wrap.is-fallback img { display: none; }
        .poster-wrap.is-fallback .poster-fallback { display: flex; }

        .booking-content {
            flex: 1;
            min-width: 0;
        }

        .booking-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 16px;
        }

        .movie-title {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.01em;
            line-height: 1.35;
            margin-bottom: 6px;
            overflow-wrap: anywhere;
        }

        .booking-code {
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-upcoming  { background: var(--info-soft);    color: var(--info); }
        .badge-completed { background: var(--success-soft); color: var(--success-ink); }
        .badge-pending   { background: var(--primary-soft); color: var(--primary-ink); }
        .badge-cancelled { background: var(--danger-soft);  color: var(--danger-ink); }

        .details {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px 18px;
            padding: 16px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .detail small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .detail strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .seat-list {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .seat {
            background: var(--primary-soft);
            color: var(--primary-ink);
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 11px;
            font-weight: 800;
        }

        .booking-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 16px;
        }

        .total-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .total {
            color: var(--primary-ink);
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(245, 158, 11, .25);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(245, 158, 11, .32);
        }

        .btn-action.is-disabled {
            background: var(--bg-soft);
            color: var(--muted);
            box-shadow: none;
            transform: none;
        }

        /* ---------- KOSONG ---------- */

        .empty {
            background: var(--surface);
            border: 1px dashed var(--border-strong);
            border-radius: var(--radius-lg);
            padding: 64px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: var(--primary-soft);
            font-size: 26px;
        }

        .empty h3 {
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .empty p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.75;
            max-width: 440px;
            margin: 0 auto 22px;
        }

        /* ---------- PAGINATION ---------- */

        .pager {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .pager-btn {
            display: inline-flex;
            align-items: center;
            min-height: 42px;
            padding: 0 16px;
            background: var(--surface);
            border: 1px solid var(--border-strong);
            border-radius: 12px;
            color: var(--text-soft);
            font-size: 13px;
            font-weight: 700;
            transition: border-color .2s ease, color .2s ease;
        }

        .pager-btn:hover {
            border-color: var(--primary);
            color: var(--primary-ink);
        }

        .pager-btn.is-disabled {
            opacity: .45;
            pointer-events: none;
        }

        .pager-info {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        footer {
            padding: 28px 24px;
            text-align: center;
            background: var(--surface);
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
        }

        /* ---------- RESPONSIVE ---------- */

        @media (max-width: 1050px) {
            .stats-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }

        @media (max-width: 700px) {
            .container { width: calc(100% - 32px); margin-top: 28px; }
            .welcome { padding: 24px; }
            .welcome h1 { font-size: 24px; }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
            .stat-card { padding: 14px; }
            .stat-number { font-size: 22px; }
            .booking-card { padding: 16px; gap: 14px; }
            .poster-wrap { width: 78px; min-width: 78px; height: 112px; }
            .movie-title { font-size: 15px; }
            .booking-top { flex-direction: column; gap: 10px; }
            .details { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .booking-bottom { align-items: flex-start; flex-direction: column; }
            .btn-action { width: 100%; }
        }

        @media (max-width: 430px) {
            .booking-card { flex-direction: column; }
            .poster-wrap { width: 100%; min-width: 0; height: 180px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>
</head>

<body>

    @include('layouts.partials.public-navbar')

    @php
        $now = now('Asia/Jakarta');

        $tabs = [
            'all'       => 'Semua',
            'upcoming'  => 'Upcoming',
            'pending'   => 'Pending Payment',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        $statCards = [
            'all'       => ['Total Pemesanan',     'Semua transaksi'],
            'upcoming'  => ['Upcoming',            'Lunas, belum selesai tayang'],
            'pending'   => ['Pending Payment',     'Menunggu pembayaran'],
            'completed' => ['Completed',           'Film sudah selesai tayang'],
            'cancelled' => ['Cancelled / Expired', 'Transaksi tidak aktif'],
        ];

        $emptyMessages = [
            'all'       => ['Belum Ada Riwayat Pemesanan', 'Kamu belum memiliki transaksi tiket. Yuk, temukan film favoritmu dan mulai pengalaman menonton bersama CinemaTicket!'],
            'upcoming'  => ['Belum Ada Tiket Upcoming', 'Kamu belum memiliki tiket lunas untuk jadwal yang akan atau sedang berlangsung.'],
            'pending'   => ['Tidak Ada Pembayaran Tertunda', 'Semua transaksi pembayaranmu sudah tidak menunggu pembayaran.'],
            'completed' => ['Belum Ada Riwayat Film Selesai', 'Tiket untuk film yang sudah selesai ditayangkan akan muncul di sini.'],
            'cancelled' => ['Tidak Ada Transaksi Dibatalkan', 'Kamu belum memiliki transaksi yang dibatalkan atau kedaluwarsa.'],
        ];
    @endphp

    <main class="container">

        {{-- WELCOME --}}
        <section class="welcome">
            <div class="eyebrow">Customer Dashboard</div>

            <h1>Halo, <span>{{ auth()->user()->name }}</span>!</h1>

            <p>
                Selamat datang kembali di CinemaTicket. Kelola semua pemesanan,
                pantau status pembayaran, dan akses tiket bioskopmu kapan saja melalui akun ini.
            </p>

            <a href="{{ route('home') }}#film" class="btn-gradient">Jelajahi Film →</a>
        </section>

        {{-- FLASH --}}
        @if(session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error" role="alert">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info" role="status">{{ session('info') }}</div>
        @endif

        {{-- STATISTIK --}}
        <nav class="stats-grid" aria-label="Filter riwayat pemesanan">
            @foreach($statCards as $key => [$label, $desc])
                <a
                    href="{{ route('customer.dashboard', ['filter' => $key]) }}"
                    class="stat-card {{ $filter === $key ? 'is-active' : '' }}"
                    @if($filter === $key) aria-current="true" @endif
                >
                    <span class="stat-label">{{ $label }}</span>
                    <span class="stat-number">{{ $filterCounts[$key] }}</span>
                    <span class="stat-desc">{{ $desc }}</span>
                </a>
            @endforeach
        </nav>

        {{-- RIWAYAT --}}
        <section>

            <div class="section-heading">
                <h2>Riwayat Pemesanan</h2>
                <p>Semua transaksi tiket yang terhubung dengan akunmu.</p>
            </div>

            <div class="filter-tabs" role="tablist">
                @foreach($tabs as $key => $label)
                    <a
                        href="{{ route('customer.dashboard', ['filter' => $key]) }}"
                        class="filter-tab {{ $filter === $key ? 'is-active' : '' }}"
                        role="tab"
                        aria-selected="{{ $filter === $key ? 'true' : 'false' }}"
                    >
                        {{ $label }}
                        <span class="filter-count">{{ $filterCounts[$key] }}</span>
                    </a>
                @endforeach
            </div>

            @forelse($pemesanans as $pemesanan)

                @php
                    $jadwal  = $pemesanan->jadwal;
                    $film    = $jadwal?->film;
                    $studio  = $jadwal?->studio;
                    $seats   = $pemesanan->detailKursis;
                    $payment = $pemesanan->pembayaran;

                    $showEnd = $jadwal
                        ? \Carbon\Carbon::parse($jadwal->tanggal_tayang . ' ' . $jadwal->jam_selesai, 'Asia/Jakarta')
                        : null;

                    $isEnded = $showEnd ? $showEnd->lt($now) : false;

                    $isPaid = $pemesanan->status === 'lunas'
                        && $payment?->status === 'berhasil';

                    if ($pemesanan->status === 'lunas') {
                        $category = $isEnded ? 'completed' : 'upcoming';
                    } elseif ($pemesanan->status === 'booking') {
                        $category = 'pending';
                    } else {
                        $category = 'cancelled';
                    }

                    $categoryLabel = [
                        'upcoming'  => 'Akan Tayang',
                        'completed' => 'Selesai',
                        'pending'   => 'Menunggu Bayar',
                        'cancelled' => 'Tidak Aktif',
                    ][$category];

                    $paymentLabel = match (true) {
                        $isPaid                                                    => 'Lunas',
                        $pemesanan->status === 'booking' && $payment?->status === 'gagal' => 'Gagal, coba lagi',
                        $pemesanan->status === 'booking' && $payment !== null      => 'Menunggu konfirmasi',
                        $pemesanan->status === 'booking'                           => 'Belum dibayar',
                        $pemesanan->status === 'dibatalkan'                        => 'Dibatalkan',
                        default                                                    => 'Kedaluwarsa',
                    };

                    $paymentMethod = $payment
                        ? strtoupper(str_replace('_', ' ', $payment->metode_pembayaran))
                        : '-';

                    $tanggal = $jadwal
                        ? \Carbon\Carbon::parse($jadwal->tanggal_tayang)->locale('id')->translatedFormat('l, d M Y')
                        : '-';

                    $jamTayang = $jadwal
                        ? substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5) . ' WIB'
                        : '-';
                @endphp

                <article class="booking-card">

                    <div class="poster-wrap">
                        @if($film?->poster)
                            <img
                                src="{{ asset('storage/' . ltrim($film->poster, '/')) }}"
                                alt="Poster {{ $film->judul }}"
                                loading="lazy"
                                decoding="async"
                                onerror="this.closest('.poster-wrap').classList.add('is-fallback')"
                            >
                        @endif
                        <div class="poster-fallback">CINEMA<br>TICKET</div>
                    </div>

                    <div class="booking-content">

                        <div class="booking-top">
                            <div>
                                <h3 class="movie-title">{{ $film?->judul ?? 'Film tidak tersedia' }}</h3>
                                <div class="booking-code">Kode Booking: {{ $pemesanan->kode_booking }}</div>
                            </div>

                            <span class="badge badge-{{ $category }}">{{ $categoryLabel }}</span>
                        </div>

                        <div class="details">

                            <div class="detail">
                                <small>Tanggal Tayang</small>
                                <strong>{{ $tanggal }}</strong>
                            </div>

                            <div class="detail">
                                <small>Jam Tayang</small>
                                <strong>{{ $jamTayang }}</strong>
                            </div>

                            <div class="detail">
                                <small>Studio</small>
                                <strong>{{ $studio?->nama ?? '-' }}</strong>
                            </div>

                            <div class="detail">
                                <small>Nomor Kursi</small>
                                <div class="seat-list">
                                    @forelse($seats as $detail)
                                        <span class="seat">{{ $detail->no_kursi }}</span>
                                    @empty
                                        <strong>-</strong>
                                    @endforelse
                                </div>
                            </div>

                            <div class="detail">
                                <small>Jumlah Tiket</small>
                                <strong>{{ $seats->count() }} Tiket</strong>
                            </div>

                            <div class="detail">
                                <small>Metode Pembayaran</small>
                                <strong>{{ $paymentMethod }}</strong>
                            </div>

                            <div class="detail">
                                <small>Status Pembayaran</small>
                                <strong>{{ $paymentLabel }}</strong>
                            </div>

                            <div class="detail">
                                <small>Tanggal Pemesanan</small>
                                <strong>{{ $pemesanan->created_at?->timezone('Asia/Jakarta')->format('d/m/Y H:i') ?? '-' }}</strong>
                            </div>

                        </div>

                        <div class="booking-bottom">

                            <div>
                                <div class="total-label">Total Pembayaran</div>
                                <div class="total">
                                    Rp {{ number_format((float) $pemesanan->total_harga, 0, ',', '.') }}
                                </div>
                            </div>

                            @if($isPaid)
                                <a href="{{ route('booking.tickets.index', $pemesanan->kode_booking) }}" class="btn-action">
                                    Lihat E-Ticket →
                                </a>
                            @elseif($pemesanan->status === 'booking')
                                <a href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}" class="btn-action">
                                    {{ $payment?->status === 'gagal' ? 'Coba Bayar Lagi' : 'Lanjutkan Pembayaran' }} →
                                </a>
                            @else
                                <span class="btn-action is-disabled">Transaksi Tidak Aktif</span>
                            @endif

                        </div>

                    </div>

                </article>

            @empty

                <div class="empty">
                    <div class="empty-icon">🎬</div>
                    <h3>{{ $emptyMessages[$filter][0] }}</h3>
                    <p>{{ $emptyMessages[$filter][1] }}</p>
                    <a href="{{ route('home') }}#film" class="btn-action">Jelajahi Film →</a>
                </div>

            @endforelse

            @if($pemesanans->hasPages())
                <nav class="pager" aria-label="Navigasi halaman">

                    @if($pemesanans->onFirstPage())
                        <span class="pager-btn is-disabled">← Sebelumnya</span>
                    @else
                        <a href="{{ $pemesanans->previousPageUrl() }}" class="pager-btn" rel="prev">← Sebelumnya</a>
                    @endif

                    <span class="pager-info">
                        Halaman {{ $pemesanans->currentPage() }} dari {{ $pemesanans->lastPage() }}
                    </span>

                    @if($pemesanans->hasMorePages())
                        <a href="{{ $pemesanans->nextPageUrl() }}" class="pager-btn" rel="next">Selanjutnya →</a>
                    @else
                        <span class="pager-btn is-disabled">Selanjutnya →</span>
                    @endif

                </nav>
            @endif

        </section>

    </main>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>