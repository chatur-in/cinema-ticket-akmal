<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>{{ $film->judul }} - CinemaTicket</title>

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
            --primary-hover: #d97706;
            --primary-soft: #fef3c7;
            --primary-ink: #92400e;
            --accent: #6366f1;
            --success: #059669;
            --success-soft: #d1fae5;
            --shadow-xs: 0 1px 2px rgba(28, 25, 23, .04);
            --shadow-sm: 0 2px 8px rgba(28, 25, 23, .06);
            --shadow-md: 0 14px 36px rgba(28, 25, 23, .10);
            --shadow-lg: 0 28px 70px rgba(28, 25, 23, .16);
            --radius: 16px;
            --radius-lg: 22px;
            --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; scroll-padding-top: 96px; }

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
        button, input, select { font-family: inherit; }
        img { display: block; max-width: 100%; }

        .page-wrap {
            width: min(1120px, calc(100% - 64px));
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

        /* =========================================
           DETAIL FILM
        ========================================= */

        .detail-card {
            display: grid;
            grid-template-columns: minmax(230px, 320px) minmax(0, 1fr);
            gap: 44px;
            padding: 32px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }

        .poster-wrap {
            width: 100%;
            aspect-ratio: 3 / 4;
            overflow: hidden;
            border-radius: var(--radius);
            background: linear-gradient(160deg, #e7e5e4, #d6d3d1);
            box-shadow: var(--shadow-md);
        }

        .poster-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .poster-empty {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            gap: 10px;
        }

        .poster-empty strong { font-size: 52px; }

        .detail-content h1 {
            font-size: clamp(28px, 3.6vw, 40px);
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 14px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 12px;
            border-radius: 999px;
            background: var(--success-soft);
            color: #065f46;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .status::before {
            content: "";
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--success);
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 28px;
        }

        .meta-box {
            padding: 14px 16px;
            background: var(--bg-soft);
            border-radius: 12px;
        }

        .meta-label {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .meta-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            overflow-wrap: anywhere;
        }

        h2 {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 10px;
        }

        .synopsis {
            color: var(--text-soft);
            font-size: 15px;
            line-height: 1.85;
            white-space: pre-line;
        }

        .detail-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 22px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
            transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
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
            color: var(--text);
            border-color: var(--border-strong);
        }

        .btn-secondary:hover { border-color: var(--primary); color: var(--primary-ink); }

        /* =========================================
           JADWAL
        ========================================= */

        .schedule-section { margin-top: 56px; }

        .schedule-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 22px;
        }

        .schedule-heading h2 {
            font-size: clamp(24px, 2.6vw, 30px);
            letter-spacing: -0.03em;
            margin-bottom: 8px;
        }

        .schedule-subtitle {
            color: var(--muted);
            font-size: 14px;
        }

        .schedule-count {
            display: inline-flex;
            align-items: center;
            padding: 9px 14px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 999px;
            box-shadow: var(--shadow-xs);
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .filter-panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 22px;
            margin-bottom: 22px;
            box-shadow: var(--shadow-xs);
            scroll-margin-top: 90px;
        }

        .filter-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .filter-title span { color: var(--primary); }

        .filter-form {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .date-field {
            flex: 1;
            min-width: 220px;
        }

        .date-field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-soft);
            margin-bottom: 8px;
        }

        .date-field input {
            width: 100%;
            height: 48px;
            padding: 0 14px;
            background: var(--surface);
            border: 1px solid var(--border-strong);
            border-radius: 12px;
            color: var(--text);
            font-size: 14px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .date-field input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, .15);
        }

        .filter-button,
        .reset-button {
            height: 48px;
            padding: 0 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .2s ease, background .2s ease;
        }

        .filter-button {
            background: var(--text);
            color: #ffffff;
            border: none;
        }

        .filter-button:hover { background: #292524; transform: translateY(-2px); }

        .reset-button {
            background: var(--surface);
            color: var(--text-soft);
            border: 1px solid var(--border-strong);
        }

        .reset-button:hover { border-color: var(--primary); color: var(--primary-ink); }

        .filter-error {
            color: #b91c1c;
            font-size: 13px;
            font-weight: 600;
            margin-top: 12px;
        }

        .filter-result {
            color: var(--muted);
            font-size: 13px;
            margin-top: 14px;
        }

        .filter-result strong { color: var(--primary-ink); }

        /* GRID JADWAL */

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .schedule-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: var(--shadow-xs);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }

        .schedule-card:hover {
            transform: translateY(-4px);
            border-color: #fcd34d;
            box-shadow: var(--shadow-md);
        }

        .schedule-card.selected {
            border: 2px solid var(--primary);
            background: #fffbeb;
        }

        .schedule-date {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 16px;
        }

        .date-label {
            color: var(--text);
            font-size: 15px;
            font-weight: 800;
        }

        .schedule-active {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 999px;
            background: var(--success-soft);
            color: #065f46;
            font-size: 11px;
            font-weight: 700;
        }

        .schedule-active::before {
            content: "";
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--success);
        }

        .schedule-time {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .time-icon {
            width: 46px; height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--primary-soft);
            color: var(--primary-ink);
            font-size: 20px;
            flex-shrink: 0;
        }

        .time-info small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .time-info strong {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .time-info span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .schedule-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 16px;
        }

        .schedule-detail-box {
            padding: 12px 14px;
            border-radius: 12px;
            background: var(--bg-soft);
            min-width: 0;
        }

        .schedule-detail-box small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }

        .schedule-detail-box strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .schedule-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding-top: 14px;
            border-top: 1px solid var(--border);
            margin-bottom: 16px;
        }

        .schedule-price span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .schedule-price strong {
            color: var(--primary-ink);
            font-size: 18px;
            font-weight: 800;
        }

        .select-schedule-button {
            width: 100%;
            min-height: 46px;
            padding: 12px;
            background: var(--surface);
            color: var(--primary-ink);
            border: 1px solid var(--border-strong);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s ease, color .2s ease, border-color .2s ease;
        }

        .select-schedule-button:hover,
        .select-schedule-button.selected {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            border-color: transparent;
        }

        .empty-schedule {
            grid-column: 1 / -1;
            padding: 56px 24px;
            text-align: center;
            background: var(--surface);
            border: 1px dashed var(--border-strong);
            border-radius: var(--radius-lg);
        }

        .empty-schedule h3 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .empty-schedule p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.75;
        }

        /* =========================================
           KONFIRMASI (FLOATING)
        ========================================= */

        .selection-confirmation {
            position: fixed;
            left: 50%;
            bottom: 20px;
            transform: translateX(-50%);
            width: min(780px, calc(100% - 32px));
            z-index: 900;
            padding: 22px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
        }

        .selection-confirmation[hidden] { display: none; }

        .confirmation-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 16px;
        }

        .confirmation-heading h3 {
            font-size: 16px;
            font-weight: 800;
        }

        .confirmation-heading span {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 999px;
            background: var(--success-soft);
            color: #065f46;
            font-size: 12px;
            font-weight: 700;
        }

        .confirmation-details {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 18px;
        }

        .confirmation-item {
            background: var(--bg-soft);
            padding: 12px 14px;
            border-radius: 12px;
            min-width: 0;
        }

        .confirmation-item small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }

        .confirmation-item strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .confirmation-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .change-selection {
            background: transparent;
            border: none;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .change-selection:hover { color: var(--text); }

        .continue-button {
            padding: 13px 22px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
        }

        .continue-button:hover { box-shadow: 0 16px 32px rgba(245, 158, 11, .38); }

        /* =========================================
           FOOTER
        ========================================= */

        footer {
            padding: 28px 24px;
            text-align: center;
            background: var(--surface);
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 860px) {
            .detail-card {
                grid-template-columns: 1fr;
                gap: 28px;
                padding: 22px;
            }

            .poster-wrap {
                width: min(100%, 300px);
                margin: 0 auto;
            }

            .schedule-grid { grid-template-columns: 1fr; }

            .schedule-heading {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 600px) {
            .page-wrap {
                width: calc(100% - 32px);
                margin-top: 28px;
            }

            .meta-grid { grid-template-columns: 1fr; }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .date-field { min-width: 100%; }

            .filter-button,
            .reset-button { width: 100%; }

            .confirmation-details { grid-template-columns: 1fr 1fr; }

            .selection-confirmation { padding: 16px; }

            .confirmation-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .continue-button { width: 100%; }
        }

        @media (max-width: 380px) {
            .confirmation-details { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="page-wrap">

        <a href="{{ route('home') }}#film" class="back-link">
            ← Kembali ke daftar film
        </a>

        {{-- DETAIL FILM --}}

        <article class="detail-card">

            <div class="poster-wrap">

                @if($film->poster)
                    <img
                        src="{{ asset('storage/' . $film->poster) }}"
                        alt="Poster {{ $film->judul }}"
                    >
                @else
                    <div class="poster-empty">
                        <strong>🎬</strong>
                        <span>POSTER BELUM TERSEDIA</span>
                    </div>
                @endif

            </div>

            <div class="detail-content">

                <div class="eyebrow">Informasi Film</div>

                <h1>{{ $film->judul }}</h1>

                <span class="status">Sedang Tayang</span>

                <div class="meta-grid">

                    <div class="meta-box">
                        <span class="meta-label">Genre</span>
                        <span class="meta-value">{{ $film->genre }}</span>
                    </div>

                    <div class="meta-box">
                        <span class="meta-label">Durasi</span>
                        <span class="meta-value">{{ $film->durasi_menit }} Menit</span>
                    </div>

                    <div class="meta-box">
                        <span class="meta-label">Rating Usia</span>
                        <span class="meta-value">{{ $film->rating_usia }}</span>
                    </div>

                </div>

                <h2>Sinopsis</h2>

                <p class="synopsis">
                    {{ $film->sinopsis ?: 'Sinopsis film belum tersedia.' }}
                </p>

                <div class="detail-actions">

                    <a href="{{ route('home') }}#film" class="btn btn-primary">
                        Lihat Film Lain
                    </a>

                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        Kembali ke Beranda
                    </a>

                </div>

            </div>

        </article>

        {{-- JADWAL TAYANG --}}

        <section class="schedule-section">

            <div class="schedule-heading">

                <div>
                    <div class="eyebrow">Movie Schedule</div>
                    <h2>Jadwal Tayang</h2>
                    <p class="schedule-subtitle">
                        Pilih jadwal penayangan yang sesuai dengan waktumu.
                    </p>
                </div>

                <div class="schedule-count">
                    {{ $jadwals->count() }} Jadwal Tersedia
                </div>

            </div>

            {{-- FILTER --}}

            <div class="filter-panel" id="filter-jadwal">

                <div class="filter-title">
                    <span>▦</span>
                    Filter Jadwal Berdasarkan Tanggal
                </div>

                <form
                    action="{{ route('films.show', $film) }}"
                    method="GET"
                    class="filter-form"
                    id="filter-form"
                >

                    <div class="date-field">

                        <label for="tanggal">Pilih Tanggal Penayangan</label>

                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            value="{{ $selectedDate }}"
                            min="{{ now('Asia/Jakarta')->toDateString() }}"
                        >

                    </div>

                    <button type="submit" class="filter-button">
                        Cari Jadwal
                    </button>

                    @if($selectedDate)
                        <a
                            href="{{ route('films.show', $film) }}"
                            class="reset-button"
                            id="reset-filter"
                        >
                            Reset Filter
                        </a>
                    @endif

                </form>

                @error('tanggal')
                    <div class="filter-error">{{ $message }}</div>
                @enderror

                <div class="filter-result">
                    @if($selectedDate)
                        Menampilkan jadwal tanggal:
                        <strong>
                            {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
                        </strong>
                    @else
                        Menampilkan seluruh jadwal yang akan datang.
                    @endif
                </div>

            </div>

            {{-- DAFTAR JADWAL --}}

            <div class="schedule-grid">

                @forelse($jadwals as $jadwal)

                    <div class="schedule-card" data-schedule-id="{{ $jadwal->id }}">

                        <div class="schedule-date">

                            <span class="date-label">
                                {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d M Y') }}
                            </span>

                            <span class="schedule-active">Aktif</span>

                        </div>

                        <div class="schedule-time">

                            <div class="time-icon">◷</div>

                            <div class="time-info">
                                <small>Jam Penayangan</small>
                                <strong>{{ date('H:i', strtotime($jadwal->jam_mulai)) }}</strong>
                                <span>- {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</span>
                            </div>

                        </div>

                        <div class="schedule-details">

                            <div class="schedule-detail-box">
                                <small>Studio</small>
                                <strong>{{ $jadwal->studio->nama }}</strong>
                            </div>

                            <div class="schedule-detail-box">
                                <small>Tipe Studio</small>
                                <strong>{{ $jadwal->studio->tipe }}</strong>
                            </div>

                        </div>

                        <div class="schedule-price">
                            <span>Harga Tiket</span>
                            <strong>Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}</strong>
                        </div>

                        <button
                            type="button"
                            class="select-schedule-button"
                            data-schedule-id="{{ $jadwal->id }}"
                            data-date="{{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d M Y') }}"
                            data-time="{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}"
                            data-studio="{{ $jadwal->studio->nama }}"
                            data-studio-type="{{ $jadwal->studio->tipe }}"
                            data-price="Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}"
                        >
                            Pilih Jadwal
                        </button>

                    </div>

                @empty

                    <div class="empty-schedule">

                        <h3>Jadwal Belum Tersedia</h3>

                        <p>
                            @if($selectedDate)
                                Tidak ada jadwal aktif untuk film {{ $film->judul }}
                                pada tanggal
                                {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}.
                            @else
                                Saat ini belum ada jadwal penayangan aktif
                                untuk film {{ $film->judul }}.
                            @endif
                        </p>

                    </div>

                @endforelse

            </div>

        </section>

    </main>

    {{-- KONFIRMASI JADWAL TERPILIH --}}

    <div class="selection-confirmation" id="selection-confirmation" hidden>

        <div class="confirmation-heading">
            <h3>Konfirmasi Jadwal Pilihan</h3>
            <span>✓ Jadwal dipilih</span>
        </div>

        <div class="confirmation-details">

            <div class="confirmation-item">
                <small>Film</small>
                <strong>{{ $film->judul }}</strong>
            </div>

            <div class="confirmation-item">
                <small>Tanggal</small>
                <strong id="confirm-date">-</strong>
            </div>

            <div class="confirmation-item">
                <small>Jam Tayang</small>
                <strong id="confirm-time">-</strong>
            </div>

            <div class="confirmation-item">
                <small>Studio</small>
                <strong id="confirm-studio">-</strong>
            </div>

            <div class="confirmation-item">
                <small>Tipe Studio</small>
                <strong id="confirm-studio-type">-</strong>
            </div>

            <div class="confirmation-item">
                <small>Harga per Tiket</small>
                <strong id="confirm-price">-</strong>
            </div>

        </div>

        <div class="confirmation-actions">

            <button type="button" class="change-selection" id="change-selection">
                Ganti Jadwal
            </button>

            <form
                action="{{ route('booking.schedule.select') }}"
                method="POST"
                id="schedule-selection-form"
            >
                @csrf
                <input type="hidden" name="jadwal_id" id="selected-jadwal-id">

                <button type="submit" class="continue-button">
                    Lanjutkan Pilih Kursi →
                </button>
            </form>

        </div>

    </div>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

    {{-- JAVASCRIPT (logika dipertahankan dari versi sebelumnya) --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const filterPanel = document.getElementById('filter-jadwal');
            const scheduleGrid = document.querySelector('.schedule-grid');
            const scheduleCount = document.querySelector('.schedule-count');
            const confirmationPanel = document.getElementById('selection-confirmation');
            const selectedScheduleInput = document.getElementById('selected-jadwal-id');

            let activeRequest = null;

            function clearScheduleSelection() {
                selectedScheduleInput.value = '';
                confirmationPanel.hidden = true;

                document.querySelectorAll('.schedule-card').forEach(card => {
                    card.classList.remove('selected');
                });

                document.querySelectorAll('.select-schedule-button').forEach(button => {
                    button.classList.remove('selected');
                    button.textContent = 'Pilih Jadwal';
                });
            }

            async function refreshSchedule(targetUrl, updateHistory = true) {

                if (activeRequest) {
                    activeRequest.abort();
                }

                activeRequest = new AbortController();

                try {

                    const response = await fetch(targetUrl, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        },
                        credentials: 'same-origin',
                        cache: 'no-store',
                        signal: activeRequest.signal
                    });

                    if (!response.ok) {
                        throw new Error('Gagal mengambil jadwal.');
                    }

                    const html = await response.text();
                    const parser = new DOMParser();
                    const newDocument = parser.parseFromString(html, 'text/html');

                    const newFilter = newDocument.querySelector('#filter-jadwal');
                    const newGrid = newDocument.querySelector('.schedule-grid');
                    const newCount = newDocument.querySelector('.schedule-count');

                    if (!newFilter || !newGrid || !newCount) {
                        throw new Error('Elemen jadwal tidak ditemukan.');
                    }

                    filterPanel.innerHTML = newFilter.innerHTML;
                    scheduleGrid.innerHTML = newGrid.innerHTML;
                    scheduleCount.textContent = newCount.textContent.trim();

                    clearScheduleSelection();

                    if (updateHistory) {
                        const newUrl = new URL(targetUrl, window.location.origin);

                        if (window.location.href !== newUrl.href) {
                            history.pushState({}, '', newUrl.href);
                        }
                    }

                } catch (error) {

                    if (error.name === 'AbortError') {
                        return;
                    }

                    console.error(error);

                    let errorElement = filterPanel.querySelector('.filter-error');

                    if (!errorElement) {
                        errorElement = document.createElement('div');
                        errorElement.className = 'filter-error';
                        filterPanel.appendChild(errorElement);
                    }

                    errorElement.textContent = 'Jadwal gagal diperbarui. Silakan coba kembali.';
                }
            }

            document.addEventListener('submit', function (event) {

                const form = event.target.closest('#filter-form');

                if (!form) return;

                event.preventDefault();

                const targetUrl = new URL(form.action, window.location.origin);
                const formData = new FormData(form);

                targetUrl.search = '';

                for (const [key, value] of formData.entries()) {
                    if (value !== '') {
                        targetUrl.searchParams.set(key, value);
                    }
                }

                refreshSchedule(targetUrl.toString(), true);
            });

            document.addEventListener('click', function (event) {

                const resetButton = event.target.closest('#reset-filter');

                if (resetButton) {
                    event.preventDefault();
                    refreshSchedule(resetButton.href, true);
                    return;
                }

                const selectButton = event.target.closest('.select-schedule-button');

                if (!selectButton) return;

                clearScheduleSelection();

                const card = selectButton.closest('.schedule-card');

                card.classList.add('selected');
                selectButton.classList.add('selected');
                selectButton.textContent = 'Jadwal Dipilih ✓';

                selectedScheduleInput.value = selectButton.dataset.scheduleId;

                document.getElementById('confirm-date').textContent = selectButton.dataset.date;
                document.getElementById('confirm-time').textContent = selectButton.dataset.time;
                document.getElementById('confirm-studio').textContent = selectButton.dataset.studio;
                document.getElementById('confirm-studio-type').textContent = selectButton.dataset.studioType;
                document.getElementById('confirm-price').textContent = selectButton.dataset.price;

                confirmationPanel.hidden = false;
            });

            document.getElementById('change-selection').addEventListener('click', function () {
                clearScheduleSelection();
            });

            window.addEventListener('popstate', function () {
                refreshSchedule(window.location.href, false);
            });

        });
    </script>

</body>
</html>