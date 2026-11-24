@php
    $featuredFilm = $films->first();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <meta
        name="description"
        content="CinemaTicket memudahkan kamu menemukan film, memilih jadwal, menentukan kursi, dan memesan tiket bioskop."
    >

    <title>CinemaTicket - Your Movie Experience</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @include('layouts.partials.public-navbar-styles')

    <style>
        /* =========================================
           TOKEN
        ========================================= */

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
            --accent-soft: #eef2ff;
            --success: #059669;

            --shadow-xs: 0 1px 2px rgba(28, 25, 23, .04);
            --shadow-sm: 0 2px 8px rgba(28, 25, 23, .06);
            --shadow-md: 0 14px 36px rgba(28, 25, 23, .10);
            --shadow-lg: 0 28px 70px rgba(28, 25, 23, .16);

            --container: 1200px;
            --radius-lg: 22px;
            --radius: 16px;

            /* TIPOGRAFI */
            --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;

            --fs-xs: 12px;
            --fs-sm: 13px;
            --fs-base: 15px;
            --fs-md: 17px;
            --fs-lg: clamp(20px, 2vw, 24px);
            --fs-xl: clamp(28px, 3.2vw, 40px);
            --fs-2xl: clamp(40px, 5.4vw, 66px);

            --lh-tight: 1.1;
            --lh-snug: 1.3;
            --lh-normal: 1.6;
            --lh-relaxed: 1.8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 96px;
        }

        body {
            font-family: var(--font-sans);
            font-size: var(--fs-base);
            font-weight: 400;
            line-height: var(--lh-normal);
            color: var(--text);
            background: var(--bg);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        h1, h2, h3, h4 {
            font-family: var(--font-sans);
            font-feature-settings: 'ss01', 'cv11';
        }

        a { color: inherit; text-decoration: none; }
        button { font-family: inherit; }
        img { display: block; max-width: 100%; }

        .container {
            width: min(var(--container), calc(100% - 64px));
            margin: 0 auto;
        }

        /* =========================================
           UTILITAS
        ========================================= */

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            background: var(--primary-soft);
            color: var(--primary-ink);
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .eyebrow::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--primary);
        }

        .section-title {
            font-size: var(--fs-xl);
            line-height: var(--lh-snug);
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .section-title .accent {
            background: linear-gradient(120deg, #f59e0b, #f97316);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .section-description {
            color: var(--muted);
            font-size: var(--fs-base);
            line-height: var(--lh-relaxed);
            margin-top: 14px;
        }

        /* BUTTON */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 50px;
            padding: 0 26px;
            background: var(--text);
            color: #ffffff;
            border: 1px solid var(--text);
            border-radius: 14px;
            font-size: var(--fs-sm);
            font-weight: 700;
            letter-spacing: 0.01em;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: transform .2s ease, background .2s ease, box-shadow .2s ease, color .2s ease;
        }

        .btn:hover {
            background: #292524;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-primary {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            border-color: transparent;
            box-shadow: 0 10px 24px rgba(245, 158, 11, .30);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #d97706, #ea580c);
            box-shadow: 0 16px 34px rgba(245, 158, 11, .38);
        }

        .btn-outline {
            background: var(--surface);
            color: var(--text);
            border-color: var(--border-strong);
        }

        .btn-outline:hover {
            background: var(--surface);
            color: var(--primary-ink);
            border-color: var(--primary);
        }

        .btn-arrow {
            transition: transform .2s ease;
        }

        .btn:hover .btn-arrow {
            transform: translateX(4px);
        }

        /* =========================================
           HERO
        ========================================= */

        .hero {
            position: relative;
            overflow: hidden;
            isolation: isolate;
            background: var(--bg);
            padding: 48px 0 96px;
            scroll-margin-top: 80px;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            filter: blur(70px);
            pointer-events: none;
        }

        .hero::before {
            width: 420px;
            height: 420px;
            top: -120px;
            right: -100px;
            background: radial-gradient(circle, #fde68a 0%, transparent 70%);
            opacity: .85;
        }

        .hero::after {
            width: 380px;
            height: 380px;
            bottom: -160px;
            left: -110px;
            background: radial-gradient(circle, #c7d2fe 0%, transparent 70%);
            opacity: .75;
        }

        .hero-inner {
            width: min(var(--container), calc(100% - 64px));
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            align-items: center;
            gap: 64px;
        }

        .hero-content {
            max-width: 620px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px 8px 8px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 999px;
            box-shadow: var(--shadow-xs);
            font-size: var(--fs-sm);
            font-weight: 600;
            color: var(--text-soft);
            margin-bottom: 24px;
        }

        .hero-badge-icon {
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            font-size: 12px;
        }

        .hero h1 {
            font-size: var(--fs-2xl);
            line-height: var(--lh-tight);
            font-weight: 800;
            letter-spacing: -0.035em;
        }

        .hero h1 .accent {
            background: linear-gradient(120deg, #f59e0b 10%, #f97316 90%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-description {
            color: var(--text-soft);
            font-size: var(--fs-md);
            line-height: var(--lh-relaxed);
            font-weight: 400;
            max-width: 520px;
            margin-top: 22px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 32px;
        }

        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            margin-top: 40px;
            padding-top: 26px;
            border-top: 1px solid var(--border);
        }

        .hero-stat strong {
            display: block;
            font-size: var(--fs-lg);
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .hero-stat span {
            font-size: var(--fs-xs);
            color: var(--muted);
            font-weight: 600;
        }

        /* FEATURED CARD */

        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 0;
        }

        .featured-card {
            position: relative;
            display: flex;
            align-items: center;
            gap: 22px;
            width: 100%;
            max-width: 460px;
            padding: 18px;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            transition: transform .35s ease, box-shadow .35s ease;
        }

        .featured-card:hover {
            transform: translateY(-6px) rotate(-.4deg);
            box-shadow: 0 36px 80px rgba(28, 25, 23, .22);
        }

        .featured-poster {
            width: 150px;
            min-width: 150px;
            aspect-ratio: 3 / 4;
            background: var(--bg-soft);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
        }

        .featured-poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .featured-poster-placeholder {
            color: var(--muted);
            text-align: center;
            font-size: 30px;
        }

        .featured-poster-placeholder p {
            font-size: 9px;
            margin-top: 8px;
            letter-spacing: 1px;
        }

        .featured-info {
            min-width: 0;
            flex: 1;
        }

        .featured-tag {
            display: inline-flex;
            padding: 6px 10px;
            background: var(--text);
            color: #fff;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.08em;
            margin-bottom: 14px;
        }

        .featured-info h2 {
            font-size: var(--fs-lg);
            line-height: var(--lh-snug);
            font-weight: 700;
            letter-spacing: -0.015em;
            margin-bottom: 8px;
            overflow-wrap: anywhere;
        }

        .featured-genre {
            color: var(--accent);
            font-size: var(--fs-xs);
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .featured-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .featured-meta span {
            background: var(--bg-soft);
            color: var(--text-soft);
            border-radius: 8px;
            padding: 6px 10px;
            font-size: var(--fs-xs);
            font-weight: 600;
        }

        .featured-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--primary-ink);
            font-size: var(--fs-sm);
            font-weight: 700;
            margin-top: 18px;
        }

        /* QUICK STRIP */

        .quick-strip {
            position: relative;
            z-index: 2;
            width: min(var(--container), calc(100% - 64px));
            margin: -48px auto 0;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .quick-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 22px 26px;
            border-right: 1px solid var(--border);
            transition: background .2s ease;
        }

        .quick-item:hover {
            background: #fffbeb;
        }

        .quick-item:last-child {
            border-right: none;
        }

        .quick-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-soft);
            color: var(--primary-ink);
            border-radius: 14px;
            font-size: 19px;
        }

        .quick-item strong {
            display: block;
            font-size: var(--fs-base);
            font-weight: 700;
            letter-spacing: 0.02em;
            margin-bottom: 3px;
        }

        .quick-item p {
            color: var(--muted);
            font-size: var(--fs-sm);
            line-height: var(--lh-normal);
        }

        /* =========================================
           FILM
        ========================================= */

        .films {
            padding: 72px 0 100px;
            scroll-margin-top: 80px;
        }

        .films-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 44px;
        }

        .film-count {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            padding: 10px 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 999px;
            box-shadow: var(--shadow-xs);
            font-size: var(--fs-xs);
            font-weight: 600;
            color: var(--text-soft);
        }

        .film-count strong {
            color: var(--primary-ink);
        }

        .film-list {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 26px;
        }

        .film-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-xs);
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        }

        .film-card:hover {
            transform: translateY(-8px);
            border-color: #fcd34d;
            box-shadow: var(--shadow-lg);
        }

        .poster {
            position: relative;
            width: 100%;
            aspect-ratio: 3 / 4;
            overflow: hidden;
            background: linear-gradient(160deg, #e7e5e4, #d6d3d1);
        }

        .poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .film-card:hover .poster img {
            transform: scale(1.06);
        }

        .poster::after {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 45%;
            background: linear-gradient(to top, rgba(28, 25, 23, .45), transparent);
            pointer-events: none;
        }

        .poster-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            padding: 5px 9px;
            background: rgba(255, 255, 255, .95);
            color: var(--primary-ink);
            border-radius: 8px;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.06em;
            box-shadow: var(--shadow-xs);
        }

        .poster-age {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 2;
            padding: 5px 9px;
            background: var(--text);
            color: #fff;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
        }

        .poster-fallback {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            text-align: center;
            padding: 15px;
        }

        .poster-fallback .symbol {
            font-size: 38px;
            margin-bottom: 10px;
        }

        .poster-fallback p {
            font-size: 9px;
            letter-spacing: 1px;
        }

        .film-info {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px;
        }

        .film-genre {
            color: var(--accent);
            font-size: var(--fs-xs);
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .film-info h3 {
            font-size: var(--fs-md);
            font-weight: 700;
            line-height: var(--lh-snug);
            letter-spacing: -0.015em;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 43px;
        }

        .film-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 12px;
        }

        .meta-item {
            background: var(--bg-soft);
            color: var(--text-soft);
            padding: 5px 9px;
            border-radius: 7px;
            font-size: var(--fs-xs);
            font-weight: 600;
        }

        .film-description {
            color: var(--muted);
            font-size: var(--fs-sm);
            line-height: var(--lh-relaxed);
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .film-card-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid var(--border);
        }

        .film-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--success);
            font-size: var(--fs-sm);
            font-weight: 600;
        }

        .film-status::before {
            content: "";
            width: 7px;
            height: 7px;
            background: var(--success);
            border-radius: 50%;
            box-shadow: 0 0 0 3px #d1fae5;
        }

        .film-detail-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: var(--primary-ink);
            font-size: var(--fs-sm);
            font-weight: 700;
            white-space: nowrap;
            transition: gap .2s ease;
        }

        .film-card:hover .film-detail-link {
            gap: 8px;
        }

        .empty-films {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 24px;
            background: var(--surface);
            border: 1px dashed var(--border-strong);
            border-radius: var(--radius-lg);
        }

        .empty-icon {
            font-size: 44px;
            margin-bottom: 16px;
        }

        .empty-films h3 {
            font-size: var(--fs-lg);
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-films p {
            color: var(--muted);
            font-size: var(--fs-base);
            line-height: var(--lh-relaxed);
        }

        /* =========================================
           STEPS
        ========================================= */

        .steps-section {
            position: relative;
            padding: 110px 0;
            background: var(--surface);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .steps-heading {
            text-align: center;
            max-width: 660px;
            margin: 0 auto 60px;
        }

        .steps-heading .section-description {
            max-width: 560px;
            margin-left: auto;
            margin-right: auto;
        }

        .steps-grid {
            position: relative;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .steps-grid::before {
            content: "";
            position: absolute;
            top: 52px;
            left: 16%;
            right: 16%;
            height: 2px;
            background: repeating-linear-gradient(
                90deg,
                var(--border-strong) 0 8px,
                transparent 8px 16px
            );
            z-index: 0;
        }

        .step-card {
            position: relative;
            z-index: 1;
            padding: 32px 30px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        }

        .step-card:hover {
            transform: translateY(-6px);
            border-color: #fcd34d;
            box-shadow: var(--shadow-md);
        }

        .step-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .step-icon {
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: var(--primary-ink);
            border-radius: 16px;
            font-size: 22px;
            box-shadow: 0 6px 16px rgba(245, 158, 11, .18);
        }

        .step-number {
            font-size: var(--fs-xs);
            font-weight: 700;
            color: var(--muted);
            letter-spacing: 0.08em;
        }

        .step-card h3 {
            font-size: var(--fs-md);
            font-weight: 700;
            letter-spacing: -0.015em;
            margin-bottom: 10px;
        }

        .step-card p {
            color: var(--muted);
            font-size: var(--fs-sm);
            line-height: var(--lh-relaxed);
        }

        /* =========================================
           ADVANTAGES
        ========================================= */

        .advantages {
            padding: 110px 0;
        }

        .advantages-heading {
            margin-bottom: 44px;
        }

        .advantages-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .advantage-card {
            padding: 30px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xs);
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .advantage-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .advantage-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-soft);
            color: var(--accent);
            border-radius: 14px;
            font-size: 21px;
            margin-bottom: 20px;
        }

        .advantage-card h3 {
            font-size: var(--fs-md);
            font-weight: 700;
            letter-spacing: -0.015em;
            margin-bottom: 10px;
        }

        .advantage-card p {
            color: var(--muted);
            font-size: var(--fs-sm);
            line-height: var(--lh-relaxed);
        }

        /* =========================================
           ABOUT
        ========================================= */

        .about {
            position: relative;
            overflow: hidden;
            padding: 110px 0;
            background: #1c1917;
            color: #fafaf9;
            text-align: center;
            scroll-margin-top: 80px;
        }

        .about::before {
            content: "";
            position: absolute;
            width: 600px;
            height: 600px;
            top: -260px;
            left: 50%;
            transform: translateX(-50%);
            background: radial-gradient(circle, rgba(245, 158, 11, .35), transparent 70%);
            filter: blur(40px);
            pointer-events: none;
        }

        .about-inner {
            position: relative;
            max-width: 740px;
            margin: 0 auto;
        }

        .about .eyebrow {
            background: rgba(245, 158, 11, .15);
            color: #fcd34d;
        }

        .about h2 {
            font-size: var(--fs-xl);
            font-weight: 800;
            line-height: var(--lh-snug);
            letter-spacing: -0.03em;
            margin-bottom: 20px;
        }

        .about h2 .accent {
            color: #fbbf24;
        }

        .about p {
            color: #d6d3d1;
            font-size: var(--fs-md);
            line-height: var(--lh-relaxed);
        }

        .about .btn {
            margin-top: 34px;
            background: #fafaf9;
            color: #1c1917;
            border-color: #fafaf9;
        }

        .about .btn:hover {
            background: #ffffff;
        }

        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 56px 0 28px;
        }

        .footer-main {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            padding-bottom: 36px;
        }

        .footer-brand {
            font-size: var(--fs-lg);
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
        }

        .footer-brand .accent {
            color: var(--primary);
        }

        .footer-description {
            max-width: 360px;
            color: var(--muted);
            font-size: var(--fs-sm);
            line-height: var(--lh-relaxed);
        }

        .footer-links {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--text-soft);
            font-size: var(--fs-sm);
            font-weight: 600;
            transition: color .2s;
        }

        .footer-links a:hover {
            color: var(--primary-ink);
        }

        .footer-bottom {
            padding-top: 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: var(--muted);
            font-size: var(--fs-xs);
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1100px) {
            .film-list {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 860px) {
            .hero {
                padding: 32px 0 80px;
            }

            .hero-inner {
                grid-template-columns: 1fr;
                gap: 44px;
            }

            .hero-visual {
                justify-content: flex-start;
            }

            .quick-strip {
                grid-template-columns: 1fr;
                margin-top: -32px;
            }

            .quick-item {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            .quick-item:last-child {
                border-bottom: none;
            }

            .film-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .steps-grid,
            .advantages-grid {
                grid-template-columns: 1fr;
            }

            .steps-grid::before {
                display: none;
            }
        }

        @media (max-width: 560px) {
            .container,
            .hero-inner,
            .quick-strip {
                width: calc(100% - 32px);
            }

            .hero h1 {
                font-size: 40px;
                letter-spacing: -0.03em;
            }

            .hero-description {
                font-size: var(--fs-base);
            }

            .hero-stats {
                gap: 20px;
            }

            .btn {
                min-height: 46px;
                padding: 0 20px;
            }

            .featured-card {
                padding: 12px;
                gap: 14px;
            }

            .featured-poster {
                width: 110px;
                min-width: 110px;
            }

            .films {
                padding: 80px 0;
            }

            .films-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .film-list {
                gap: 14px;
            }

            .film-info {
                padding: 14px;
            }

            .film-info h3 {
                font-size: var(--fs-base);
            }

            .film-description {
                display: none;
            }

            .steps-section,
            .advantages,
            .about {
                padding: 80px 0;
            }

            .footer-main,
            .footer-bottom {
                flex-direction: column;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>

</head>


<body>

@include('layouts.partials.public-navbar')


{{-- HERO --}}

<section class="hero" id="home">

    <div class="hero-inner">

        <div class="hero-content">

            <div class="hero-badge">
                <span class="hero-badge-icon">✦</span>
                Your Movie Experience Starts Here
            </div>

            <h1>
                Cerita Hebat,
                <span class="accent">Pengalaman</span>
                Tak Terlupakan.
            </h1>

            <p class="hero-description">
                Temukan film favoritmu, pilih jadwal tayang, tentukan kursi terbaik,
                dan nikmati pengalaman menonton bioskop dengan lebih mudah bersama CinemaTicket.
            </p>

            <div class="hero-actions">

                <a href="#film" class="btn btn-primary">
                    Jelajahi Film
                    <span class="btn-arrow">→</span>
                </a>

                @if($featuredFilm)
                    <a href="{{ route('films.show', $featuredFilm) }}" class="btn btn-outline">
                        Film Terbaru
                    </a>
                @endif

            </div>

            <div class="hero-stats">

                <div class="hero-stat">
                    <strong>{{ $totalFilms }}</strong>
                    <span>Film tayang</span>
                </div>

                <div class="hero-stat">
                    <strong>3 Langkah</strong>
                    <span>Pesan tiket</span>
                </div>

                <div class="hero-stat">
                    <strong>QR Code</strong>
                    <span>E-ticket digital</span>
                </div>

            </div>

        </div>

        <div class="hero-visual">

            @if($featuredFilm)

                <a
                    href="{{ route('films.show', $featuredFilm) }}"
                    class="featured-card"
                    aria-label="Lihat detail film {{ $featuredFilm->judul }}"
                >

                    <div class="featured-poster">

                        @if($featuredFilm->poster)
                            <img
                                src="{{ asset('storage/' . ltrim($featuredFilm->poster, '/')) }}"
                                alt="Poster {{ $featuredFilm->judul }}"
                                fetchpriority="high"
                            >
                        @else
                            <div class="featured-poster-placeholder">
                                🎬
                                <p>POSTER BELUM TERSEDIA</p>
                            </div>
                        @endif

                    </div>

                    <div class="featured-info">

                        <div class="featured-tag">✦ FILM TERBARU</div>

                        <h2>{{ $featuredFilm->judul }}</h2>

                        <div class="featured-genre">{{ $featuredFilm->genre }}</div>

                        <div class="featured-meta">
                            <span>{{ $featuredFilm->durasi_menit }} Menit</span>
                            <span>{{ $featuredFilm->rating_usia }}</span>
                        </div>

                        <div class="featured-link">
                            Lihat Detail Film <span>→</span>
                        </div>

                    </div>

                </a>

            @else

                <div class="featured-card">
                    <div class="featured-info">
                        <div class="featured-tag">CINEMATICKET</div>
                        <h2>Temukan Film Favoritmu</h2>
                        <p class="section-description">
                            Film pilihanmu akan tampil di sini ketika tersedia.
                        </p>
                    </div>
                </div>

            @endif

        </div>

    </div>

</section>


{{-- QUICK INFO --}}

<div class="quick-strip">

    <div class="quick-item">
        <div class="quick-icon">🎬</div>
        <div>
            <strong>Pilihan Film</strong>
            <p>Temukan film yang sedang tayang.</p>
        </div>
    </div>

    <div class="quick-item">
        <div class="quick-icon">◷</div>
        <div>
            <strong>Jadwal Fleksibel</strong>
            <p>Pilih jadwal sesuai waktumu.</p>
        </div>
    </div>

    <div class="quick-item">
        <div class="quick-icon">▣</div>
        <div>
            <strong>E-Ticket Praktis</strong>
            <p>Akses tiket melalui akunmu.</p>
        </div>
    </div>

</div>


{{-- FILM --}}

<section class="films" id="film">

    <div class="container">

        <div class="films-heading">

            <div>
                <div class="eyebrow">NOW SHOWING</div>
                <h2 class="section-title">
                    Film Sedang <span class="accent">Tayang.</span>
                </h2>
                <p class="section-description">
                    Pilih film favoritmu dan temukan pengalaman menonton yang menyenangkan.
                </p>
            </div>

            <div class="film-count">
                <strong>{{ $totalFilms }}</strong> film tersedia
            </div>

        </div>

        <div class="film-list">

            @forelse($films as $film)

                <a
                    href="{{ route('films.show', $film) }}"
                    class="film-card"
                    aria-label="Lihat detail film {{ $film->judul }}"
                >

                    <div class="poster">

                        <span class="poster-badge">NOW SHOWING</span>
                        <span class="poster-age">{{ $film->rating_usia }}</span>

                        @if($film->poster)

                            <img
                                src="{{ asset('storage/' . ltrim($film->poster, '/')) }}"
                                alt="Poster {{ $film->judul }}"
                                loading="lazy"
                                decoding="async"
                                onerror="this.hidden=true; this.nextElementSibling.hidden=false;"
                            >

                            <div class="poster-fallback" hidden>
                                <div class="symbol">🎬</div>
                                <p>POSTER TIDAK TERSEDIA</p>
                            </div>

                        @else

                            <div class="poster-fallback">
                                <div class="symbol">🎬</div>
                                <p>POSTER BELUM TERSEDIA</p>
                            </div>

                        @endif

                    </div>

                    <div class="film-info">

                        <div class="film-genre">{{ $film->genre }}</div>

                        <h3>{{ $film->judul }}</h3>

                        <div class="film-meta">
                            <span class="meta-item">{{ $film->durasi_menit }} Menit</span>
                            <span class="meta-item">{{ $film->rating_usia }}</span>
                        </div>

                        <p class="film-description">
                            @if($film->sinopsis)
                                {{ \Illuminate\Support\Str::limit($film->sinopsis, 85) }}
                            @else
                                Informasi sinopsis belum tersedia.
                            @endif
                        </p>

                        <div class="film-card-bottom">
                            <span class="film-status">Sedang Tayang</span>
                            <span class="film-detail-link">Detail →</span>
                        </div>

                    </div>

                </a>

            @empty

                <div class="empty-films">
                    <div class="empty-icon">🎬</div>
                    <h3>Belum Ada Film yang Tayang</h3>
                    <p>
                        Saat ini belum tersedia film dengan status tayang.
                        Silakan kunjungi kembali nanti.
                    </p>
                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- STEPS --}}

<section class="steps-section">

    <div class="container">

        <div class="steps-heading">
            <div class="eyebrow">SIMPLE BOOKING PROCESS</div>
            <h2 class="section-title">
                Pesan Tiket dalam <span class="accent">3 Langkah.</span>
            </h2>
            <p class="section-description">
                Proses pemesanan yang sederhana, dari memilih film
                hingga mendapatkan tiket digital.
            </p>
        </div>

        <div class="steps-grid">

            <div class="step-card">
                <div class="step-top">
                    <div class="step-icon">🎬</div>
                    <span class="step-number">LANGKAH 01</span>
                </div>
                <h3>Pilih Film dan Jadwal</h3>
                <p>
                    Temukan film yang ingin kamu tonton, kemudian pilih jadwal
                    penayangan yang paling sesuai.
                </p>
            </div>

            <div class="step-card">
                <div class="step-top">
                    <div class="step-icon">▦</div>
                    <span class="step-number">LANGKAH 02</span>
                </div>
                <h3>Tentukan Kursi</h3>
                <p>
                    Pilih tempat duduk favoritmu, lengkapi data pemesan,
                    dan lanjutkan ke proses pembayaran.
                </p>
            </div>

            <div class="step-card">
                <div class="step-top">
                    <div class="step-icon">▣</div>
                    <span class="step-number">LANGKAH 03</span>
                </div>
                <h3>Dapatkan E-Ticket</h3>
                <p>
                    Setelah pembayaran berhasil, tiket digital dengan QR Code
                    dapat diakses kembali melalui akunmu.
                </p>
            </div>

        </div>

    </div>

</section>


{{-- ADVANTAGES --}}

<section class="advantages">

    <div class="container">

        <div class="advantages-heading">
            <div class="eyebrow">WHY CINEMATICKET</div>
            <h2 class="section-title">
                Pengalaman Menonton <span class="accent">Lebih Praktis.</span>
            </h2>
            <p class="section-description">
                Semua kebutuhan pemesanan tiket bioskop tersedia dalam satu tempat.
            </p>
        </div>

        <div class="advantages-grid">

            <div class="advantage-card">
                <div class="advantage-icon">✦</div>
                <h3>Pemesanan Mudah</h3>
                <p>
                    Temukan film, tentukan jadwal, pilih kursi, dan lakukan pemesanan
                    melalui proses yang sederhana.
                </p>
            </div>

            <div class="advantage-card">
                <div class="advantage-icon">▣</div>
                <h3>Tiket Digital</h3>
                <p>
                    Tiket digital dilengkapi QR Code sehingga memudahkan proses
                    pemeriksaan tiket di bioskop.
                </p>
            </div>

            <div class="advantage-card">
                <div class="advantage-icon">◷</div>
                <h3>Riwayat Pemesanan</h3>
                <p>
                    Lihat kembali transaksi dan akses tiket yang sudah dibeli
                    melalui akun customer.
                </p>
            </div>

        </div>

    </div>

</section>


{{-- ABOUT --}}

<section class="about" id="about">

    <div class="container">

        <div class="about-inner">

            <div class="eyebrow">ABOUT US</div>

            <h2>
                Welcome to <span class="accent">CinemaTicket.</span>
            </h2>

            <p>
                CinemaTicket merupakan sistem informasi pemesanan tiket bioskop yang
                dirancang untuk memberikan kemudahan dalam menemukan film, melihat
                jadwal penayangan, memilih tempat duduk, dan memesan tiket secara
                praktis. Dengan tiket digital dan akun customer, pengalaman menonton
                menjadi lebih terorganisasi dan nyaman.
            </p>

            <a href="#film" class="btn">
                Temukan Film Favoritmu
                <span class="btn-arrow">→</span>
            </a>

        </div>

    </div>

</section>


{{-- FOOTER --}}

<footer class="footer">

    <div class="container">

        <div class="footer-main">

            <div>
                <div class="footer-brand">
                    CINEMA<span class="accent">TICKET</span>
                </div>
                <p class="footer-description">
                    Your movie experience starts here. Temukan film favoritmu dan
                    nikmati pengalaman menonton yang lebih praktis bersama CinemaTicket.
                </p>
            </div>

            <nav class="footer-links">

                <a href="{{ route('home') }}#home">Home</a>
                <a href="{{ route('home') }}#film">Film</a>
                <a href="{{ route('home') }}#about">Tentang</a>

                @auth
                    @if(auth()->user()->role === 'customer')
                        <a href="{{ route('customer.dashboard') }}">Akun Saya</a>
                    @elseif(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                    @endif
                @else
                    <a href="{{ route('customer.login') }}">Login</a>
                    <a href="{{ route('customer.register') }}">Daftar</a>
                @endauth

            </nav>

        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} CinemaTicket. All Rights Reserved.</span>
            <span>Made for Movie Lovers.</span>
        </div>

    </div>

</footer>

</body>
</html>