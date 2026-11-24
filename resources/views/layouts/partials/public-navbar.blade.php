@php
    $ctUser       = auth()->user();
    $ctRole       = $ctUser?->role;
    $ctIsCustomer = $ctRole === 'customer';
    $ctIsAdmin    = $ctRole === 'admin';

    $ctUrl = [
        'home'      => route('home'),
        'login'     => route('customer.login'),
        'register'  => route('customer.register'),
        'admin'     => route('admin.login'),
        'account'   => route('customer.dashboard'),
        'dashboard' => route('admin.dashboard'),
        'logout'    => route('customer.logout'),
    ];

    $ctOnLogin = request()->routeIs('customer.login');
    $ctOnFilm  = request()->routeIs('films.show');
@endphp

<header class="ct-site-header ct-site-header--light" data-ct-navbar>

    <nav class="ct-nav-shell" aria-label="Navigasi utama">

        <a href="{{ $ctUrl['home'] }}" class="ct-brand">
            CINEMA<span>TICKET</span>
        </a>

        <button
            type="button"
            class="ct-nav-toggle"
            data-ct-toggle
            aria-label="Buka menu navigasi"
            aria-expanded="false"
            aria-controls="ctPublicNavPanel"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="ct-nav-panel" id="ctPublicNavPanel" data-ct-panel>

            <div class="ct-nav-links">
                <a href="{{ $ctUrl['home'] }}#home" class="ct-nav-link">Home</a>

                <a
                    href="{{ $ctUrl['home'] }}#film"
                    class="ct-nav-link {{ $ctOnFilm ? 'is-active' : '' }}"
                >Film</a>

                <a href="{{ $ctUrl['home'] }}#about" class="ct-nav-link">Tentang</a>
            </div>

            <div class="ct-nav-actions">

                @if($ctIsCustomer)

                    <a
                        href="{{ $ctUrl['account'] }}"
                        class="ct-nav-action ct-nav-account"
                        @if(request()->routeIs('customer.dashboard')) aria-current="page" @endif
                    >
                        {{ request()->routeIs('customer.dashboard') ? 'Dashboard Saya' : 'Akun Saya' }}
                    </a>

                    <form
                        action="{{ $ctUrl['logout'] }}"
                        method="POST"
                        onsubmit="return confirm('Apakah kamu yakin ingin logout dari akun CinemaTicket?');"
                    >
                        @csrf
                        <button type="submit" class="ct-nav-action ct-nav-logout">Logout</button>
                    </form>

                @elseif($ctIsAdmin)

                    <a href="{{ $ctUrl['dashboard'] }}" class="ct-nav-action ct-nav-admin">
                        Dashboard Admin
                    </a>

                @else

                    <a
                        href="{{ $ctUrl['login'] }}"
                        class="ct-nav-action ct-nav-login {{ $ctOnLogin ? 'is-current' : '' }}"
                        @if($ctOnLogin) aria-current="page" @endif
                    >
                        Login
                    </a>

                    <a href="{{ $ctUrl['register'] }}" class="ct-nav-action ct-nav-register">
                        Daftar
                    </a>

                    <a
                        href="{{ $ctUrl['admin'] }}"
                        class="ct-nav-action ct-nav-admin"
                        title="Login administrator"
                    >
                        Login Admin
                    </a>

                @endif

            </div>

        </div>

    </nav>

</header>

<script>
    (() => {
        const header = document.querySelector('[data-ct-navbar]');
        if (!header || header.dataset.ctReady === '1') return;
        header.dataset.ctReady = '1';

        const toggle = header.querySelector('[data-ct-toggle]');
        const panel  = header.querySelector('[data-ct-panel]');
        if (!toggle || !panel) return;

        const setMenu = (open) => {
            panel.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', String(open));
            toggle.setAttribute(
                'aria-label',
                open ? 'Tutup menu navigasi' : 'Buka menu navigasi'
            );
        };

        toggle.addEventListener('click', () => {
            setMenu(toggle.getAttribute('aria-expanded') !== 'true');
        });

        document.addEventListener('click', (event) => {
            if (!header.contains(event.target)) setMenu(false);
            else if (event.target.closest('.ct-nav-panel a')) setMenu(false);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') setMenu(false);
        });
    })();
</script>