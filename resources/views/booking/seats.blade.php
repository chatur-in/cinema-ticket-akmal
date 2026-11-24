<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Pilih Kursi - CinemaTicket</title>

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
            --seat-taken: #e7e5e4;
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

        .page-wrap {
            width: min(1080px, calc(100% - 64px));
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
            font-size: clamp(28px, 3.4vw, 38px);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.75;
        }

        /* INFO FILM */

        .movie-info {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin: 28px 0;
        }

        .info-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 16px 18px;
            box-shadow: var(--shadow-xs);
            min-width: 0;
        }

        .info-box small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .info-box strong {
            font-size: 15px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        /* PESAN */

        .message {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 14px;
            line-height: 1.6;
            border: 1px solid transparent;
        }

        .error-message {
            background: var(--danger-soft);
            color: #b91c1c;
            border-color: #fecaca;
        }

        .success-message {
            background: var(--success-soft);
            color: #065f46;
            border-color: #a7f3d0;
        }

        .warning-message {
            background: var(--primary-soft);
            color: var(--primary-ink);
            border: 1px solid #fde68a;
            padding: 13px 16px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        /* KARTU DENAH */

        .seat-container {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px 28px;
            box-shadow: var(--shadow-md);
        }

        .seat-heading {
            text-align: center;
            margin-bottom: 28px;
        }

        .seat-heading h2 {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .seat-heading p {
            color: var(--muted);
            font-size: 13px;
        }

        /* LAYAR */

        .screen-area {
            max-width: 560px;
            margin: 0 auto 40px;
            text-align: center;
        }

        .screen {
            height: 10px;
            width: 100%;
            border-radius: 50%;
            background: linear-gradient(90deg, transparent, #f59e0b, #fbbf24, #f59e0b, transparent);
            box-shadow: 0 8px 26px rgba(245, 158, 11, .35);
            margin-bottom: 12px;
        }

        .screen-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3em;
        }

        /* DENAH KURSI */

        .seat-map {
            width: 100%;
            overflow-x: auto;
            padding: 6px 0 16px;
        }

        .seat-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-width: max-content;
            margin-bottom: 10px;
        }

        .row-label {
            width: 24px;
            text-align: center;
            color: var(--primary-ink);
            font-size: 12px;
            font-weight: 800;
        }

        .seat-line {
            display: grid;
            grid-template-columns: repeat(var(--seat-columns), minmax(34px, 1fr));
            gap: 8px;
        }

        .seat {
            position: relative;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px 9px 5px 5px;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .15s ease, background .15s ease, border-color .15s ease;
            user-select: none;
        }

        .seat input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .seat.available {
            background: var(--surface);
            border: 1.5px solid var(--border-strong);
            color: var(--text-soft);
        }

        .seat.available:hover {
            border-color: var(--primary);
            background: #fffbeb;
            transform: translateY(-2px);
        }

        .seat.selected {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            border: 1.5px solid #f59e0b;
            color: #ffffff;
            box-shadow: 0 6px 14px rgba(245, 158, 11, .35);
        }

        .seat.occupied {
            background: var(--seat-taken);
            border: 1.5px solid var(--seat-taken);
            color: #a8a29e;
            cursor: not-allowed;
            opacity: .75;
        }

        /* LEGENDA */

        .seat-legend {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 22px;
            margin-top: 22px;
            padding-top: 22px;
            border-top: 1px solid var(--border);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-soft);
            font-size: 13px;
            font-weight: 600;
        }

        .legend-color {
            width: 18px;
            height: 18px;
            border-radius: 5px;
        }

        .legend-available {
            background: var(--surface);
            border: 1.5px solid var(--border-strong);
        }

        .legend-selected {
            background: linear-gradient(135deg, #f59e0b, #f97316);
        }

        .legend-occupied {
            background: var(--seat-taken);
        }

        /* RINGKASAN */

        .selection-summary {
            margin-top: 28px;
            padding: 22px 24px;
            background: var(--bg-soft);
            border-radius: var(--radius);
        }

        .selection-summary h3 {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid var(--border);
        }

        .summary-row:last-of-type { border-bottom: none; }

        .summary-row span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .summary-row strong {
            font-size: 14px;
            font-weight: 700;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .total-price {
            color: var(--primary-ink) !important;
            font-size: 20px !important;
            font-weight: 800 !important;
        }

        /* TOMBOL */

        .seat-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-top: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 22px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-back {
            background: var(--surface);
            border: 1px solid var(--border-strong);
            color: var(--text-soft);
        }

        .btn-back:hover { border-color: var(--primary); color: var(--primary-ink); }

        .btn-submit {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            border: none;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
        }

        .btn-submit:hover { box-shadow: 0 16px 32px rgba(245, 158, 11, .38); }

        .btn-submit:disabled {
            opacity: .45;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* FOOTER */

        footer {
            padding: 28px 24px;
            text-align: center;
            background: var(--surface);
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
        }

        /* RESPONSIVE */

        @media (max-width: 760px) {
            .movie-info { grid-template-columns: 1fr; }
            .seat-container { padding: 22px 14px; }
            .seat { width: 32px; height: 34px; font-size: 9px; }
            .seat-line { gap: 5px; }
            .seat-row { gap: 7px; }
            .seat-legend { gap: 14px; }
            .seat-actions { flex-direction: column-reverse; align-items: stretch; }
            .btn { width: 100%; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="page-wrap">

        <a href="{{ route('films.show', $jadwal->film_id) }}#filter-jadwal" class="back-link">
            ← Kembali ke jadwal film
        </a>

        <div class="eyebrow">Booking Ticket</div>

        <h1>Pilih Kursi Bioskop</h1>

        <p class="subtitle">
            Pilih tempat duduk favoritmu sebelum melanjutkan proses pemesanan tiket.
        </p>

        {{-- INFO FILM DAN JADWAL --}}

        <div class="movie-info">

            <div class="info-box">
                <small>Film</small>
                <strong>{{ $jadwal->film->judul }}</strong>
            </div>

            <div class="info-box">
                <small>Tanggal dan Jam</small>
                <strong>
                    {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d M Y') }}
                    <br>
                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }}
                    -
                    {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                </strong>
            </div>

            <div class="info-box">
                <small>Studio</small>
                <strong>{{ $jadwal->studio->nama }} ({{ $jadwal->studio->tipe }})</strong>
            </div>

        </div>

        @if(session('success'))
            <div class="message success-message">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="message error-message">{{ $errors->first() }}</div>
        @endif

        @if($capacityMismatch)
            <div class="warning-message">
                Perhatian: konfigurasi denah menghasilkan
                {{ $configuredCapacity }} kursi, sedangkan kapasitas yang tercatat pada studio adalah
                {{ $jadwal->studio->kapasitas }} kursi.
                Denah sementara mengikuti jumlah baris dan kursi per baris.
            </div>
        @endif

        {{-- FORM DENAH KURSI --}}

        <form action="{{ route('booking.store-seats') }}" method="POST" id="seat-form">

            @csrf

            <div class="seat-container">

                <div class="seat-heading">
                    <h2>Denah Tempat Duduk</h2>
                    <p>Studio {{ $jadwal->studio->nama }}</p>
                </div>

                <div class="screen-area">
                    <div class="screen"></div>
                    <div class="screen-label">SCREEN</div>
                </div>

                <div class="seat-map">

                    @forelse($seatMap as $row)

                        <div class="seat-row">

                            <div class="row-label">{{ $row['label'] }}</div>

                            <div
                                class="seat-line"
                                style="--seat-columns: {{ count($row['seats']) }}"
                            >

                                @foreach($row['seats'] as $seat)

                                    @php
                                        $isSelected = in_array(
                                            $seat['number'],
                                            $selectedSeats,
                                            true
                                        ) && !$seat['occupied'];
                                    @endphp

                                    <label
                                        class="seat
                                            {{ $seat['occupied']
                                                ? 'occupied'
                                                : ($isSelected ? 'selected' : 'available')
                                            }}"
                                        title="{{ $seat['number'] }}"
                                    >

                                        <input
                                            type="checkbox"
                                            class="seat-input"
                                            name="seats[]"
                                            value="{{ $seat['number'] }}"
                                            {{ $isSelected ? 'checked' : '' }}
                                            {{ $seat['occupied'] ? 'disabled' : '' }}
                                        >

                                        <span>{{ $seat['number'] }}</span>

                                    </label>

                                @endforeach

                            </div>

                            <div class="row-label">{{ $row['label'] }}</div>

                        </div>

                    @empty

                        <div class="message error-message">
                            Konfigurasi kursi studio belum tersedia.
                        </div>

                    @endforelse

                </div>

                {{-- LEGENDA --}}

                <div class="seat-legend">

                    <div class="legend-item">
                        <div class="legend-color legend-available"></div>
                        Tersedia
                    </div>

                    <div class="legend-item">
                        <div class="legend-color legend-selected"></div>
                        Dipilih
                    </div>

                    <div class="legend-item">
                        <div class="legend-color legend-occupied"></div>
                        Terisi
                    </div>

                </div>

                {{-- RINGKASAN --}}

                <div class="selection-summary">

                    <h3>Ringkasan Pilihan Kursi</h3>

                    <div class="summary-row">
                        <span>Kursi Dipilih</span>
                        <strong id="selected-seat-list">Belum ada kursi</strong>
                    </div>

                    <div class="summary-row">
                        <span>Jumlah Kursi</span>
                        <strong id="selected-seat-count">0 Kursi</strong>
                    </div>

                    <div class="summary-row">
                        <span>Harga per Kursi</span>
                        <strong>Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}</strong>
                    </div>

                    <div class="summary-row">
                        <span>Total Harga</span>
                        <strong class="total-price" id="selected-total-price">Rp 0</strong>
                    </div>

                </div>

                {{-- TOMBOL --}}

                <div class="seat-actions">

                    <a href="{{ route('films.show', $jadwal->film_id) }}#filter-jadwal" class="btn btn-back">
                        Kembali ke Jadwal
                    </a>

                    <button type="submit" class="btn btn-submit" id="submit-seats" disabled>
                        Lanjutkan ke Data Pemesan
                    </button>

                </div>

            </div>

        </form>

    </main>

    <footer>
        © {{ date('Y') }} CinemaTicket. Sistem Pemesanan Tiket Bioskop.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const seatInputs = document.querySelectorAll('.seat-input:not(:disabled)');
            const selectedList = document.getElementById('selected-seat-list');
            const selectedCount = document.getElementById('selected-seat-count');
            const totalPrice = document.getElementById('selected-total-price');
            const submitButton = document.getElementById('submit-seats');
            const seatForm = document.getElementById('seat-form');
            const pricePerSeat = {{ (float) $jadwal->harga }};

            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            });

            function updateSeatSummary() {

                const selectedSeats = [];

                seatInputs.forEach(input => {

                    const label = input.closest('.seat');

                    if (input.checked) {
                        selectedSeats.push(input.value);
                        label.classList.add('selected');
                        label.classList.remove('available');
                    } else {
                        label.classList.remove('selected');
                        label.classList.add('available');
                    }

                });

                const count = selectedSeats.length;
                const total = count * pricePerSeat;

                selectedList.textContent = count > 0
                    ? selectedSeats.join(', ')
                    : 'Belum ada kursi';

                selectedCount.textContent = count + ' Kursi';
                totalPrice.textContent = formatter.format(total);
                submitButton.disabled = count === 0;
            }

            seatInputs.forEach(input => {
                input.addEventListener('change', updateSeatSummary);
            });

            seatForm.addEventListener('submit', function (event) {

                const selectedSeats = Array.from(seatInputs).filter(input => input.checked);

                if (selectedSeats.length === 0) {
                    event.preventDefault();
                    alert('Silakan pilih minimal satu kursi.');
                }

            });

            updateSeatSummary();

        });
    </script>

</body>
</html>