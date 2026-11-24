<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Login Customer - CinemaTicket</title>

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
            --success: #059669;
            --success-soft: #ecfdf5;
            --shadow-md: 0 14px 36px rgba(28, 25, 23, .10);
            --shadow-lg: 0 28px 70px rgba(28, 25, 23, .16);
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

        .page {
            position: relative;
            isolation: isolate;
            min-height: calc(100vh - 76px);
            display: grid;
            place-items: center;
            padding: 56px 20px 72px;
            overflow: hidden;
        }

        .page::before,
        .page::after {
            content: "";
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            filter: blur(70px);
            pointer-events: none;
        }

        .page::before {
            width: 420px; height: 420px;
            top: -120px; right: -100px;
            background: radial-gradient(circle, #fde68a 0%, transparent 70%);
            opacity: .85;
        }

        .page::after {
            width: 380px; height: 380px;
            bottom: -160px; left: -110px;
            background: radial-gradient(circle, #c7d2fe 0%, transparent 70%);
            opacity: .75;
        }

        .card {
            width: 100%;
            max-width: 440px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: var(--shadow-lg);
            padding: 42px 38px 36px;
        }

        .logo {
            text-align: center;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 24px;
        }

        .logo .accent { color: var(--primary); }

        .eyebrow {
            display: flex;
            justify-content: center;
            margin-bottom: 14px;
        }

        .eyebrow span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 13px;
            background: var(--primary-soft);
            color: var(--primary-ink);
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .eyebrow span::before {
            content: "";
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--primary);
        }

        h1 {
            text-align: center;
            font-size: clamp(26px, 3vw, 32px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.03em;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.75;
            margin-bottom: 28px;
        }

        .message {
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 18px;
            border: 1px solid transparent;
        }

        .message div + div { margin-top: 4px; }

        .message.error {
            background: var(--danger-soft);
            color: #b91c1c;
            border-color: #fecaca;
        }

        .message.info {
            background: var(--primary-soft);
            color: var(--primary-ink);
            border-color: #fde68a;
        }

        .message.success {
            background: var(--success-soft);
            color: #065f46;
            border-color: #a7f3d0;
        }

        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-soft);
            margin-bottom: 8px;
        }

        input[type="email"],
        input[type="password"] {
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

        input::placeholder { color: #a8a29e; }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, .15);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            margin: 4px 0 24px;
            cursor: pointer;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .btn {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(245, 158, 11, .38);
        }

        .bottom {
            margin-top: 26px;
            text-align: center;
            font-size: 14px;
            color: var(--muted);
        }

        .bottom a {
            color: var(--primary-ink);
            font-weight: 700;
        }

        .bottom a:hover { text-decoration: underline; }

        .back {
            display: block;
            margin-top: 18px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .back:hover { color: var(--text); }

        @media (max-width: 520px) {
            .page { padding: 36px 16px 56px; }
            .card { padding: 32px 24px 28px; border-radius: 18px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="page">

        <div class="card">

            <div class="logo">
                CINEMA<span class="accent">TICKET</span>
            </div>

            <div class="eyebrow">
                <span>Customer Account</span>
            </div>

            <h1>Selamat Datang!</h1>

            <p class="subtitle">
                Login untuk memesan tiket dan melihat riwayat
                pembelian film favoritmu.
            </p>

            @if(session('info'))
                <div class="message info">{{ session('info') }}</div>
            @endif

            @if(session('success'))
                <div class="message success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="message error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('customer.login.process') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Masukkan email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <label class="remember">
                    <input type="checkbox" name="remember" value="1">
                    Ingat saya
                </label>

                <button type="submit" class="btn">
                    Login Sekarang →
                </button>

            </form>

            <div class="bottom">
                Belum punya akun?
                <a href="{{ route('customer.register') }}">Daftar sekarang</a>
            </div>

            <a href="{{ route('home') }}" class="back">
                ← Kembali ke Homepage
            </a>

        </div>

    </main>

</body>
</html>