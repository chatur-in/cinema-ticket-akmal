<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">

    <title>@yield('title', 'Dashboard') | CinemaTicket Admin</title>

    {{-- CSS admin (edit di resources/css/admin/admin.css) --}}
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">

    {{-- Gaya khusus per halaman (opsional) --}}
    @stack('styles')
</head>

<body>

<div class="admin-shell">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-mark">CT</span>
            <span class="brand-text">
                <strong>CinemaTicket</strong>
                <small>Admin Panel</small>
            </span>
        </a>

        <nav class="sidebar-nav" aria-label="Navigasi admin">

            <div class="sidebar-section">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">▦</span>
                Dashboard
            </a>

            <div class="sidebar-section">Manajemen Data</div>

            <a href="{{ route('admin.films.index') }}"
               class="nav-link {{ request()->routeIs('admin.films.*') ? 'active' : '' }}">
                <span class="nav-icon">▣</span>
                Film
            </a>

            <a href="{{ route('admin.studios.index') }}"
               class="nav-link {{ request()->routeIs('admin.studios.*') ? 'active' : '' }}">
                <span class="nav-icon">▤</span>
                Studio
            </a>

            <a href="{{ route('admin.jadwals.index') }}"
               class="nav-link {{ request()->routeIs('admin.jadwals.*') ? 'active' : '' }}">
                <span class="nav-icon">◷</span>
                Jadwal
            </a>

            <div class="sidebar-section">Transaksi</div>

            <a href="{{ route('admin.pemesanans.index') }}"
               class="nav-link {{ request()->routeIs('admin.pemesanans.*') ? 'active' : '' }}">
                <span class="nav-icon">▧</span>
                Pemesanan
            </a>

            <a href="{{ route('admin.pembayarans.index') }}"
               class="nav-link {{ request()->routeIs('admin.pembayarans.*') ? 'active' : '' }}">
                <span class="nav-icon">◇</span>
                Pembayaran
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="admin-card">
                <div class="avatar">
                    {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="admin-meta">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>Administrator</small>
                </div>
            </div>

            <form
                method="POST"
                action="{{ route('admin.logout') }}"
                onsubmit="return confirm('Apakah kamu yakin ingin logout dari panel administrator?');"
            >
                @csrf
                <button type="submit" class="logout-button">
                    ↪ Logout
                </button>
            </form>

        </div>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        <header class="topbar">
            <div class="breadcrumb">
                <span>CinemaTicket</span>
                <span>/</span>
                <strong>@yield('title', 'Dashboard')</strong>
            </div>

            <div class="topbar-user">
                <span class="avatar" style="width:30px;height:30px;font-size:12px;">
                    {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                </span>
                {{ auth()->user()->name }}
            </div>
        </header>

        <section class="content">

            @if(session('info'))
                <div class="alert-info" role="status">{{ session('info') }}</div>
            @endif

            @yield('content')
        </section>

        <footer class="admin-footer">
            © {{ date('Y') }} CinemaTicket. All rights reserved.
        </footer>

    </main>

</div>

</body>
</html>