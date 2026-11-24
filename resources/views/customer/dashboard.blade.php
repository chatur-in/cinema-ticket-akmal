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
            --accent: #6366f1;
            --accent-soft: #eef2ff;
            --success: #059669;
            --success-soft: #d1fae5;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --info: #2563eb;
            --info-soft: #dbeafe;
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

        /* WELCOME */

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

        .welcome-action {
            display: inline-flex;
            align-items: center;
            margin-top: 20px;
            padding: 12px 20px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .welcome-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(245, 158, 11, .38);
        }

        /* FLASH */

        .alert {
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
            border: 1px solid transparent;
        }

        .alert.success {
            background: var(--success-soft);
            border-color: #a7f3d0;
            color: #065f46;
        }

        .alert.error {
            background: var(--danger-soft);
            border-color: #fecaca;
            color: #b91c1c;
        }

        .alert.info {
            background: var(--info-soft);
            border-color: #bfdbfe;
            color: #1e3a8a;
        }

        /* STATISTIK / FILTER KARTU */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 36px;
        }

        .stat-card {
            display: block;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: var(--shadow-xs);
            transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: #fcd34d;
            box-shadow: var(--shadow-md);
        }

        .stat-card.active {
            border-color: var(--primary);
            background: #fffbeb;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.02em;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .stat-number {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text);
        }

        .stat-card.active .stat-number { color: var(--primary-ink); }

        .stat-description {
            color: var(--muted);
            font-size: 11px;
            margin-top: 6px;
        }

        /* RIWAYAT */

        .section-heading {
            margin-bottom: 18px;
        }

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
        }

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

        .filter-tab.active {
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

        .filter-tab.active .filter-count {
            background: rgba(255, 255, 255, .25);
            color: #ffffff;
        }

        /* KARTU BOOKING */

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
            width: 100px;
            min-width: 100px;
            height: 140px;
            overflow: hidden;
            background: var(--bg-soft);
            border-radius: 12px;
        }

        .poster {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .poster-fallback {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            padding: 10px;
        }

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
        }

        .booking-code {
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status::before {
            content: "";
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status.upcoming {
            background: var(--info-soft);
            color: var(--info);
        }

        .status.completed {
            background: var(--success-soft);
            color: #065f46;
        }

        .status.pending {
            background: var(--primary-soft);
            color: var(--primary-ink);
        }

        .status.cancelled {
            background: var(--danger-soft);
            color: #b91c1c;
        }

        .status.other {
            background: var(--bg-soft);
            color: var(--text-soft);
        }

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
            margin-bottom: 4px;
        }

        .total {
            color: var(--primary-ink);
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .action {
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

        .action:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(245, 158, 11, .32);
        }

        .action.disabled {
            background: var(--bg-soft);
            color: var(--muted);
            box-shadow: none;
            cursor: default;
            transform: none;
        }

        /* KOSONG */

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

        .pagination { margin-top: 24px; }

        footer {
            padding: 28px 24px;
            text-align: center;
            background: var(--surface);
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
        }

        /* RESPONSIVE */

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
            .action { width: 100%; }
        }

        @media (max-width: 430px) {
            .booking-card { flex-direction: column; }
            .poster-wrap { width: 100%; min-width: 0; height: 180px; }
            .details { grid-template-columns: 1fr 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="container">

        {{-- WELCOME --}}

        <section class="welcome">

            <div class="eyebrow">Customer Dashboard</div>

            <h1>Halo, <span>{{ auth()->user()->name }}</span>!</h1>

            <p>
                Selamat datang kembali di CinemaTicket. Kelola semua pemesanan,
                pantau status pembayaran, dan akses tiket bioskopmu kapan saja melalui akun ini.
            </p>

            <a href="{{ route('home') }}#film" class="welcome-action">
                Jelajahi Film →
            </a>

        </section>

        {{-- FLASH --}}

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        @if(session('info'))
            <div class="alert info">{{ session('info') }}</div>
        @endif

        {{-- STATISTIK --}}

        <section class="stats-grid">

            <a href="{{ route('customer.dashboard', ['filter' => 'all']) }}"
               class="stat-card {{ $filter === 'all' ? 'active' : '' }}">
                <div class="stat-label">Total Pemesanan</div>
                <div class="stat-number">{{ $filterCounts['all'] }}</div>
                <div class="stat-description">Semua transaksi</div>
            </a>

            <a href="{{ route('customer.dashboard', ['filter' => 'upcoming']) }}"
               class="stat-card {{ $filter === 'upcoming' ? 'active' : '' }}">
                <div class="stat-label">Upcoming</div>
                <div class="stat-number">{{ $filterCounts['upcoming'] }}</div>
                <div class="stat-description">Akan / sedang tayang</div>
            </a>

            <a href="{{ route('customer.dashboard', ['filter' => 'pending']) }}"
               class="stat-card {{ $filter === 'pending' ? 'active' : '' }}">
                <div class="stat-label">Pending Payment</div>
                <div class="stat-number">{{ $filterCounts['pending'] }}</div>
                <div class="stat-description">Menunggu pembayaran</div>
            </a>

            <a href="{{ route('customer.dashboard', ['filter' => 'completed']) }}"
               class="stat-card {{ $filter === 'completed' ? 'active' : '' }}">
                <div class="stat-label">Completed</div>
                <div class="stat-number">{{ $filterCounts['completed'] }}</div>
                <div class="stat-description">Film sudah selesai tayang</div>
            </a>

            <a href="{{ route('customer.dashboard', ['filter' => 'cancelled']) }}"
               class="stat-card {{ $filter === 'cancelled' ? 'active' : '' }}">
                <div class="stat-label">Cancelled / Expired</div>
                <div class="stat-number">{{ $filterCounts['cancelled'] }}</div>
                <div class="stat-description">Transaksi tidak aktif</div>
            </a>

        </section>

        {{-- RIWAYAT --}}

        <section>

            <div class="section-heading">
                <h2>Riwayat Pemesanan</h2>
                <p>Semua transaksi tiket yang terhubung dengan akunmu.</p>
            </div>

            @php
                $tabs = [
                    'all' => 'Semua',
                    'upcoming' => 'Upcoming',
                    'pending' => 'Pending Payment',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ];
            @endphp

            <div class="filter-tabs">
                @foreach($tabs as $key => $label)
                    <a href="{{ route('customer.dashboard', ['filter' => $key]) }}"
                       class="filter-tab {{ $filter === $key ? 'active' : '' }}">
                        {{ $label }}
                        <span class="filter-count">{{ $filterCounts[$key] }}</span>
                    </a>
                @endforeach
            </div>

            @forelse($pemesanans as $pemesanan)

                @php
                    $jadwal = $pemesanan->jadwal;
                    $film = $jadwal?->film;
                    $studio = $jadwal?->studio;

                    $showEnd = $jadwal
                        ? \Carbon\Carbon::parse($jadwal->tanggal_tayang . ' ' . $jadwal->jam_selesai, 'Asia/Jakarta')
                        : null;

                    $isCompleted = $showEnd ? $showEnd->lt(now('Asia/Jakarta')) : false;

                    $isPaid = (
                        $pemesanan->status === 'lunas'
                        && $pemesanan->pembayaran?->status === 'berhasil'
                    );

                    $category = match($pemesanan->status) {
                        'lunas' => $isCompleted ? 'completed' : 'upcoming',
                        'booking' => 'pending',
                        'dibatalkan', 'kedaluwarsa' => 'cancelled',
                        default => 'other',
                    };

                    $categoryLabel = match($category) {
                        'upcoming' => 'Belum Selesai',
                        'completed' => 'Selesai',
                        'pending' => 'Menunggu Pembayaran',
                        'cancelled' => 'Tidak Aktif',
                        default => 'Lainnya',
                    };

                    $paymentLabel = match($pemesanan->status) {
                        'lunas' => 'Lunas',
                        'booking' => match($pemesanan->pembayaran?->status) {
                            'gagal' => 'Pembayaran Gagal',
                            'menunggu' => 'Menunggu Pembayaran',
                            default => 'Belum Dibayar',
                        },
                        'dibatalkan' => 'Dibatalkan',
                        'kedaluwarsa' => 'Kedaluwarsa',
                        default => ucfirst($pemesanan->status),
                    };

                    $seatCount = $pemesanan->detailKursis->count();
                    $paymentMethod = $pemesanan->pembayaran?->metode_pembayaran;
                @endphp

                <article class="booking-card">

                    <div class="poster-wrap">
                        @if($film && $film->poster)
                            <img
                                src="{{ asset('storage/' . ltrim($film->poster, '/')) }}"
                                alt="{{ $film->judul }}"
                                class="poster"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >
                            <div class="poster-fallback" style="display:none;">CINEMA<br>TICKET</div>
                        @else
                            <div class="poster-fallback">CINEMA<br>TICKET</div>
                        @endif
                    </div>

                    <div class="booking-content">

                        <div class="booking-top">
                            <div>
                                <h3 class="movie-title">{{ $film?->judul ?? 'Film tidak tersedia' }}</h3>
                                <div class="booking-code">Booking: {{ $pemesanan->kode_booking }}</div>
                            </div>

                            <span class="status {{ $category }}">{{ $categoryLabel }}</span>
                        </div>

                        <div class="details">

                            <div class="detail">
                                <small>Tanggal Tayang</small>
                                <strong>
                                    {{ $jadwal
                                        ? \Carbon\Carbon::parse($jadwal->tanggal_tayang)->locale('id')->translatedFormat('d F Y')
                                        : '-' }}
                                </strong>
                            </div>

                            <div class="detail">
                                <small>Jam Tayang</small>
                                <strong>{{ $jadwal ? substr($jadwal->jam_mulai, 0, 5) . ' WIB' : '-' }}</strong>
                            </div>

                            <div class="detail">
                                <small>Studio</small>
                                <strong>{{ $studio?->nama ?? '-' }}</strong>
                            </div>

                            <div class="detail">
                                <small>Nomor Kursi</small>
                                <div class="seat-list">
                                    @forelse($pemesanan->detailKursis as $detail)
                                        <span class="seat">{{ $detail->no_kursi }}</span>
                                    @empty
                                        <strong>-</strong>
                                    @endforelse
                                </div>
                            </div>

                            <div class="detail">
                                <small>Jumlah Tiket</small>
                                <strong>{{ $seatCount }} Tiket</strong>
                            </div>

                            <div class="detail">
                                <small>Metode Pembayaran</small>
                                <strong>{{ $paymentMethod ? strtoupper(str_replace('_', ' ', $paymentMethod)) : '-' }}</strong>
                            </div>

                            <div class="detail">
                                <small>Status Pembayaran</small>
                                <strong>{{ $paymentLabel }}</strong>
                            </div>

                            <div class="detail">
                                <small>Tanggal Pemesanan</small>
                                <strong>
                                    {{ $pemesanan->created_at
                                        ? $pemesanan->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i')
                                        : '-' }}
                                </strong>
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
                                <a href="{{ route('booking.tickets.index', $pemesanan->kode_booking) }}" class="action">
                                    Lihat E-Ticket →
                                </a>
                            @elseif($pemesanan->status === 'booking')
                                <a href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}" class="action">
                                    Lanjutkan Pembayaran →
                                </a>
                            @elseif(in_array($pemesanan->status, ['dibatalkan', 'kedaluwarsa']))
                                <span class="action disabled">Transaksi Tidak Aktif</span>
                            @endif

                        </div>

                    </div>

                </article>

            @empty

                <div class="empty">

                    <div class="empty-icon">🎬</div>

                    @if($filter === 'all')
                        <h3>Belum Ada Riwayat Pemesanan</h3>
                        <p>Kamu belum memiliki transaksi tiket. Yuk, temukan film favoritmu dan mulai pengalaman menonton bersama CinemaTicket!</p>
                    @elseif($filter === 'upcoming')
                        <h3>Belum Ada Tiket Upcoming</h3>
                        <p>Kamu belum memiliki tiket lunas untuk jadwal yang akan atau sedang berlangsung.</p>
                    @elseif($filter === 'pending')
                        <h3>Tidak Ada Pembayaran Tertunda</h3>
                        <p>Semua transaksi pembayaranmu sudah tidak memiliki status menunggu.</p>
                    @elseif($filter === 'completed')
                        <h3>Belum Ada Riwayat Film Selesai</h3>
                        <p>Tiket untuk film yang sudah selesai ditayangkan akan muncul di sini.</p>
                    @elseif($filter === 'cancelled')
                        <h3>Tidak Ada Transaksi Dibatalkan</h3>
                        <p>Kamu belum memiliki transaksi yang dibatalkan atau kedaluwarsa.</p>
                    @endif

                    <a href="{{ route('home') }}#film" class="action">Jelajahi Film →</a>

                </div>

            @endforelse

            @if($pemesanans->hasPages())
                <div class="pagination">
                    {{ $pemesanans->links() }}
                </div>
            @endif

        </section>

    </main>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>