@php
    $ctUser = auth()->user();

    $ctIsCustomer = $ctUser && $ctUser->role === 'customer';
    $ctIsAdmin = $ctUser && $ctUser->role === 'admin';
@endphp

<header class="ct-site-header ct-site-header--light" data-ct-navbar>

    <nav class="ct-nav-shell" aria-label="Navigasi utama">

        {{-- LOGO --}}

        <a href="{{ route('home') }}" class="ct-brand">
            CINEMA<span>TICKET</span>
        </a>


        {{-- MOBILE TOGGLE --}}

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


        {{-- NAVIGATION PANEL --}}

        <div
            class="ct-nav-panel"
            id="ctPublicNavPanel"
            data-ct-panel
        >

            <div class="ct-nav-links">

                <a
                    href="{{ route('home') }}#home"
                    class="ct-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}"
                >
                    Home
                </a>

                <a
                    href="{{ route('home') }}#film"
                    class="ct-nav-link {{ request()->routeIs('films.show') ? 'is-active' : '' }}"
                >
                    Film
                </a>

                <a
                    href="{{ route('home') }}#about"
                    class="ct-nav-link"
                >
                    Tentang
                </a>

            </div>


            {{-- CUSTOMER SUDAH LOGIN --}}

            <div class="ct-nav-actions">

                @if($ctIsCustomer)

                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="ct-nav-action ct-nav-account"
                    >
                        {{ request()->routeIs('customer.dashboard') ? 'Dashboard Saya' : 'Akun Saya' }}
                    </a>

                    <form
                        action="{{ route('customer.logout') }}"
                        method="POST"
                        onsubmit="return confirm('Apakah kamu yakin ingin logout dari akun CinemaTicket?');"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="ct-nav-action ct-nav-logout"
                        >
                            Logout
                        </button>
                    </form>


                {{-- ADMIN SUDAH LOGIN --}}

                @elseif($ctIsAdmin)

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="ct-nav-action ct-nav-admin"
                    >
                        Dashboard Admin
                    </a>


                {{-- PENGUNJUNG BELUM LOGIN --}}

                @else

                    <a
                        href="{{ route('customer.login') }}"
                        class="ct-nav-action ct-nav-login {{ request()->routeIs('customer.login') ? 'is-current' : '' }}"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('customer.register') }}"
                        class="ct-nav-action ct-nav-register"
                    >
                        Daftar
                    </a>

                    <a
                        href="{{ route('admin.login') }}"
                        class="ct-nav-action ct-nav-admin"
                    >
                        Admin
                    </a>

                @endif

            </div>

        </div>

    </nav>

</header>


{{-- MOBILE NAVIGATION SCRIPT --}}

<script>
    (() => {

        const header = document.querySelector('[data-ct-navbar]');

        if (!header) return;

        const toggle = header.querySelector('[data-ct-toggle]');
        const panel = header.querySelector('[data-ct-panel]');

        if (!toggle || !panel) return;


        const setMenu = (open) => {

            panel.classList.toggle('is-open', open);

            toggle.setAttribute(
                'aria-expanded',
                String(open)
            );

            toggle.setAttribute(
                'aria-label',
                open
                    ? 'Tutup menu navigasi'
                    : 'Buka menu navigasi'
            );

        };


        toggle.addEventListener('click', () => {

            const isOpen =
                toggle.getAttribute('aria-expanded') === 'true';

            setMenu(!isOpen);

        });


        // Tutup menu setelah memilih navigasi.

        panel.querySelectorAll('a').forEach(link => {

            link.addEventListener('click', () => {
                setMenu(false);
            });

        });


        // Tutup menu jika pengguna menekan Escape.

        document.addEventListener('keydown', event => {

            if (event.key === 'Escape') {
                setMenu(false);
            }

        });


        // Tutup menu jika klik di luar navbar.

        document.addEventListener('click', event => {

            if (!header.contains(event.target)) {
                setMenu(false);
            }

        });

    })();
</script>