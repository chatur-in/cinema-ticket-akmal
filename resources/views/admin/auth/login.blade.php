<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <meta name="color-scheme" content="light">
    <title>Login Admin - CinemaTicket</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            color-scheme: light;

            --bg: #fafaf9;
            --surface: #ffffff;
            --border: #e7e5e4;
            --border-strong: #d6d3d1;
            --text: #1c1917;
            --text-soft: #44403c;
            --muted: #78716c;
            --subtle: #a8a29e;

            --primary: #f59e0b;
            --primary-ink: #92400e;
            --primary-soft: #fef3c7;

            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --danger-ink: #b91c1c;

            --success: #059669;
            --success-soft: #d1fae5;
            --success-ink: #065f46;

            --info: #2563eb;
            --info-soft: #dbeafe;
            --info-ink: #1e3a8a;

            --shadow-lg: 0 28px 70px rgba(28, 25, 23, .14);
            --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { background: var(--bg); }

        body {
            font-family: var(--font-sans);
            font-size: 15px;
            line-height: 1.6;
            color: var(--text);
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Dekorasi latar, sama dengan halaman publik */
        body::before,
        body::after {
            content: "";
            position: fixed;
            z-index: 0;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        body::before {
            width: 460px;
            height: 460px;
            top: -140px;
            right: -120px;
            background: radial-gradient(circle, #fde68a 0%, transparent 70%);
            opacity: .85;
        }

        body::after {
            width: 420px;
            height: 420px;
            bottom: -160px;
            left: -120px;
            background: radial-gradient(circle, #c7d2fe 0%, transparent 70%);
            opacity: .75;
        }

        a { color: inherit; text-decoration: none; }
        button, input { font-family: inherit; }

        .card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: var(--shadow-lg);
            padding: 42px 38px 34px;
        }

        .logo {
            text-align: center;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 24px;
        }

        .logo span { color: var(--primary); }

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
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .eyebrow span::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--primary);
        }

        h1 {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 18px;
            border: 1px solid transparent;
        }

        .alert div + div { margin-top: 4px; }

        .alert-error {
            background: var(--danger-soft);
            border-color: #fecaca;
            color: var(--danger-ink);
        }

        .alert-success {
            background: var(--success-soft);
            border-color: #a7f3d0;
            color: var(--success-ink);
        }

        .alert-info {
            background: var(--info-soft);
            border-color: #bfdbfe;
            color: var(--info-ink);
        }

        .form-group { margin-bottom: 18px; }

        label.field-label {
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

        input::placeholder { color: var(--subtle); }

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
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(245, 158, 11, .38);
        }

        .btn:focus-visible,
        .remember input:focus-visible,
        .back:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 3px;
        }

        .back {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            transition: color .2s ease;
        }

        .back:hover { color: var(--text); }

        .copyright {
            margin-top: 26px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            text-align: center;
            color: var(--subtle);
            font-size: 12px;
        }

        @media (max-width: 480px) {
            body { padding: 20px 14px; }
            .card { padding: 32px 24px 26px; border-radius: 18px; }
            h1 { font-size: 24px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition-duration: .01ms !important; }
        }
    </style>
</head>

<body>

    <main class="card">

        <div class="logo">CINEMA<span>TICKET</span></div>

        <div class="eyebrow">
            <span>Administrator</span>
        </div>

        <h1>Masuk ke Dashboard</h1>

        <p class="subtitle">
            Silakan masuk menggunakan akun administrator untuk mengelola CinemaTicket.
        </p>

        @if(session('info'))
            <div class="alert alert-info" role="status">{{ session('info') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" role="alert">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.process') }}" novalidate>
            @csrf

            <div class="form-group">
                <label class="field-label" for="email">Email Administrator</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="admin@cinematicket.test"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label class="field-label" for="password">Password</label>
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
                Ingat saya di perangkat ini
            </label>

            <button type="submit" class="btn">Masuk ke Dashboard →</button>
        </form>

        <a href="{{ route('home') }}" class="back">← Kembali ke Homepage</a>

        <div class="copyright">© {{ date('Y') }} CinemaTicket. All Rights Reserved.</div>

    </main>

</body>
</html>