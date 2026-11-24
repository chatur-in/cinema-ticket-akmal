<style>
    /* =========================================================
       NAVBAR PUBLIK — varian gelap (default) dan terang
       Varian terang aktif bila header memakai class
       .ct-site-header--light
    ========================================================= */

    :root {
        --ct-nav-ink: #0f172a;
        --ct-nav-ink-soft: #334155;
        --ct-nav-muted: #64748b;
        --ct-nav-primary: #f59e0b;
        --ct-nav-primary-hover: #d97706;
        --ct-nav-primary-soft: #fef3c7;
        --ct-nav-primary-ink: #92400e;
        --ct-nav-border: #e2e8f0;
        --ct-nav-border-strong: #cbd5e1;
        --ct-nav-font: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
    }

    .ct-site-header,
    .ct-site-header * {
        box-sizing: border-box;
    }

    /* ---------- BASE (gelap, untuk halaman lain) ---------- */

    .ct-site-header {
        position: sticky;
        top: 0;
        z-index: 1200;
        width: 100%;
        background: rgba(11, 16, 32, .96);
        border-bottom: 1px solid rgba(148, 163, 184, .16);
        box-shadow: 0 8px 25px rgba(0, 0, 0, .12);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        font-family: var(--ct-nav-font);
    }

    .ct-nav-shell {
        width: min(1200px, calc(100% - 64px));
        min-height: 76px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .ct-brand {
        display: inline-flex;
        align-items: center;
        flex-shrink: 0;
        color: #ffffff;
        text-decoration: none;
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    .ct-brand span {
        color: #f5b942;
    }

    .ct-nav-panel {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-left: auto;
    }

    .ct-nav-links {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .ct-nav-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 0 14px;
        border-radius: 10px;
        color: #cbd5e1;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: background .2s ease, color .2s ease;
    }

    .ct-nav-link:hover {
        background: rgba(255, 255, 255, .06);
        color: #f5b942;
    }

    .ct-nav-link.is-active {
        color: #f5b942;
        background: rgba(245, 185, 66, .10);
    }

    .ct-nav-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-left: 4px;
    }

    .ct-nav-actions form {
        display: inline-flex;
        margin: 0;
    }

    .ct-nav-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 0 16px;
        border: 1px solid transparent;
        border-radius: 10px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
        transition: all .2s ease;
    }

    .ct-nav-account {
        background: rgba(245, 185, 66, .12);
        border-color: rgba(245, 185, 66, .3);
        color: #f5b942;
    }

    .ct-nav-account:hover {
        background: rgba(245, 185, 66, .2);
    }

    .ct-nav-login {
        background: transparent;
        border-color: #34435e;
        color: #e2e8f0;
    }

    .ct-nav-login:hover {
        border-color: #f5b942;
        color: #f5b942;
    }

    .ct-nav-register {
        background: #f5b942;
        color: #10172b;
    }

    .ct-nav-register:hover {
        background: #ffd477;
        transform: translateY(-1px);
    }

    .ct-nav-admin {
        background: transparent;
        border-color: #34435e;
        color: #cbd5e1;
    }

    .ct-nav-admin:hover {
        border-color: #f5b942;
        color: #f5b942;
    }

    .ct-nav-logout {
        background: transparent;
        border-color: #34435e;
        color: #cbd5e1;
    }

    .ct-nav-logout:hover {
        background: rgba(239, 68, 68, .1);
        border-color: #ef4444;
        color: #fca5a5;
    }

    .ct-nav-toggle {
        display: none;
        width: 42px;
        height: 42px;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 5px;
        background: transparent;
        border: 1px solid #34435e;
        border-radius: 10px;
        cursor: pointer;
    }

    .ct-nav-toggle span {
        display: block;
        width: 18px;
        height: 2px;
        background: #f5b942;
        border-radius: 4px;
        transition: all .2s ease;
    }

    .ct-nav-toggle[aria-expanded="true"] span:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    .ct-nav-toggle[aria-expanded="true"] span:nth-child(2) {
        opacity: 0;
    }

    .ct-nav-toggle[aria-expanded="true"] span:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }

    .ct-nav-action:focus-visible,
    .ct-nav-link:focus-visible,
    .ct-brand:focus-visible,
    .ct-nav-toggle:focus-visible {
        outline: 2px solid #f5b942;
        outline-offset: 4px;
    }

    /* ---------- VARIAN TERANG ---------- */

    .ct-site-header--light {
        background: rgba(255, 255, 255, .9);
        border-bottom: 1px solid var(--ct-nav-border);
        box-shadow: 0 4px 20px rgba(15, 23, 42, .04);
    }

    .ct-site-header--light .ct-brand {
        color: var(--ct-nav-ink);
    }

    .ct-site-header--light .ct-brand span {
        color: var(--ct-nav-primary);
    }

    .ct-site-header--light .ct-nav-link {
        color: var(--ct-nav-ink-soft);
    }

    .ct-site-header--light .ct-nav-link:hover,
    .ct-site-header--light .ct-nav-link.is-active {
        color: var(--ct-nav-primary-ink);
        background: var(--ct-nav-primary-soft);
    }

    .ct-site-header--light .ct-nav-account {
        background: var(--ct-nav-primary-soft);
        border-color: #fde68a;
        color: var(--ct-nav-primary-ink);
    }

    .ct-site-header--light .ct-nav-account:hover {
        background: #fde68a;
    }

    .ct-site-header--light .ct-nav-login {
        color: var(--ct-nav-ink);
        border-color: var(--ct-nav-border-strong);
        background: #ffffff;
    }

    .ct-site-header--light .ct-nav-login:hover {
        border-color: var(--ct-nav-primary);
        color: var(--ct-nav-primary-ink);
    }

    .ct-site-header--light .ct-nav-register {
        background: linear-gradient(135deg, #f59e0b, #f97316);
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(245, 158, 11, .28);
    }

    .ct-site-header--light .ct-nav-register:hover {
        background: linear-gradient(135deg, #d97706, #ea580c);
    }

    .ct-site-header--light .ct-nav-admin,
    .ct-site-header--light .ct-nav-logout {
        color: var(--ct-nav-ink-soft);
        border-color: var(--ct-nav-border-strong);
        background: #ffffff;
    }

    .ct-site-header--light .ct-nav-admin:hover {
        border-color: var(--ct-nav-primary);
        color: var(--ct-nav-primary-ink);
    }

    .ct-site-header--light .ct-nav-logout:hover {
        background: #fef2f2;
        border-color: #fca5a5;
        color: #b91c1c;
    }

    .ct-site-header--light .ct-nav-toggle {
        border-color: var(--ct-nav-border-strong);
    }

    .ct-site-header--light .ct-nav-toggle span {
        background: var(--ct-nav-ink);
    }

    /* ---------- TABLET & MOBILE ---------- */

    @media (max-width: 900px) {
        .ct-nav-shell {
            width: calc(100% - 40px);
            min-height: 70px;
            flex-wrap: wrap;
            gap: 0;
        }

        .ct-nav-toggle {
            display: flex;
            margin-left: auto;
        }

        .ct-nav-panel {
            display: none;
            width: 100%;
            flex: 0 0 100%;
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
            margin: 0;
            padding: 12px 0 18px;
            border-top: 1px solid rgba(148, 163, 184, .15);
        }

        .ct-nav-panel.is-open {
            display: flex;
        }

        .ct-site-header--light .ct-nav-panel {
            border-top-color: var(--ct-nav-border);
            background: #ffffff;
        }

        .ct-nav-links {
            flex-direction: column;
            align-items: stretch;
            gap: 4px;
        }

        .ct-nav-link {
            justify-content: flex-start;
            width: 100%;
        }

        .ct-nav-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 8px;
            margin: 6px 0 0;
            padding-top: 12px;
            border-top: 1px solid rgba(148, 163, 184, .15);
        }

        .ct-site-header--light .ct-nav-actions {
            border-top-color: var(--ct-nav-border);
        }

        .ct-nav-actions form {
            display: flex;
            width: 100%;
        }

        .ct-nav-action {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 430px) {
        .ct-nav-shell {
            width: calc(100% - 28px);
            min-height: 66px;
        }

        .ct-brand {
            font-size: 19px;
        }
    }

    @media print {
        .ct-site-header {
            display: none !important;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .ct-site-header *,
        .ct-site-header *::before,
        .ct-site-header *::after {
            transition-duration: .01ms !important;
        }
    }
</style>