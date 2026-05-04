<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.finance_tracker') }}</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            color: #222;
        }

        header {
            background: #1f4e79;
            color: white;
            padding: 16px 24px;
        }

        header h1 {
            margin: 0 0 10px 0;
        }

        nav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        nav a,
        nav button {
            color: white;
            text-decoration: none;
            background: rgba(255,255,255,0.12);
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        nav a:hover,
        nav button:hover {
            background: rgba(255,255,255,0.22);
        }

        .container {
            width: 92%;
            max-width: 1250px;
            margin: 20px auto;
        }
        .checkbox-label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    margin-top: 10px;
}

.checkbox-label input {
    width: 16px;
    height: 16px;
    margin: 0;
}

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background: #1f4e79;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            margin: 4px;
        }

        .btn:hover {
            background: #163955;
        }

        .form-actions,
        .email-buttons {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }

        .form-actions .btn,
        .email-buttons .btn {
            flex: 1;
            margin: 0;
        }

        .email-btn {
            display: inline-block;
            margin: 12px 0 20px 0;
        }

        .remember-block {
            margin: 10px 0;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .remember-label input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            margin: 0;
        }

        .lang-switcher {
            margin-left: auto;
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .lang-switcher span {
            color: rgba(255,255,255,0.8);
            font-size: 13px;
        }

        .lang-btn {
            background: rgba(255,255,255,0.15);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }

        .lang-btn:hover,
        .lang-btn.active {
            background: rgba(255,255,255,0.35);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .hero {
            padding: 40px;
            background: linear-gradient(135deg, #1f4e79, #3a7db3);
            color: white;
            border-radius: 14px;
            margin-bottom: 20px;
        }

        .grid-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }

        .row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .box,
        .chartBox {
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        img,
        canvas {
            max-width: 100%;
        }

        @media (max-width: 768px) {
            header {
                padding: 14px;
            }

            header h1 {
                font-size: 22px;
                text-align: center;
            }

            nav {
                flex-direction: column;
                align-items: stretch;
            }

            nav a,
            nav button {
                width: 100%;
                text-align: center;
                box-sizing: border-box;
            }

            .lang-switcher {
                margin-left: 0;
                justify-content: center;
                flex-wrap: wrap;
            }

            .container {
                width: 95%;
                margin: 12px auto;
            }

            .hero {
                padding: 24px;
                text-align: center;
            }

            .row {
                flex-direction: column;
            }

            .box,
            .chartBox,
            .card {
                width: 100% !important;
                min-width: 0 !important;
                box-sizing: border-box;
            }

            .grid-links {
                grid-template-columns: 1fr;
            }

            .form-actions,
            .email-buttons {
                flex-direction: column;
            }

            .form-actions .btn,
            .email-buttons .btn {
                width: 100%;
            }

            table {
                display: block;
                width: 100%;
                overflow-x: auto;
                white-space: nowrap;
            }

            input,
            select,
            textarea,
            button {
                font-size: 16px;
            }

            canvas {
                width: 100% !important;
                height: 240px !important;
            }
        }

        @media (max-width: 480px) {
            .hero {
                padding: 18px;
            }

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 20px;
            }

            .btn {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
<header>
    <h1>{{ __('app.finance_tracker') }}</h1>

    <nav>
        <a href="{{ route('landing') }}">{{ __('app.home') }}</a>
        <a href="{{ route('register') }}">{{ __('app.register') }}</a>
        <a href="{{ route('login') }}">{{ __('app.login') }}</a>

        @role('owner|accountant|analyst|viewer')
            <a href="{{ route('dashboard') }}">{{ __('app.dashboard') }}</a>
            <a href="{{ route('transactions.history') }}">{{ __('app.transactions') }}</a>
        @endrole

        @role('owner|accountant')
            <a href="{{ route('transactions.add') }}">{{ __('app.add_transaction') }}</a>
        @endrole

        @role('owner|analyst')
            <a href="{{ route('analytics') }}">{{ __('app.analytics') }}</a>
        @endrole

        @role('owner|accountant|analyst')
            <a href="{{ route('reports') }}">{{ __('app.reports') }}</a>
        @endrole

        @role('owner')
            <a href="{{ route('settings.security') }}">{{ __('app.settings') }}</a>
        @endrole

        <a href="{{ route('support.faq') }}">{{ __('app.support') }}</a>

        @auth
            <a href="{{ route('files.index') }}">📁 {{ __('app.files') }}</a>
            <a href="{{ route('email.create') }}">✉️ {{ __('app.send_email') }}</a>
            <a href="{{ route('email.sent') }}">📬 {{ __('app.sent_emails') }}</a>
        @endauth

        <div class="lang-switcher">
            <span>{{ __('app.select_language') }}:</span>

            <a href="{{ route('lang.switch', 'en') }}"
               class="lang-btn {{ app()->getLocale() === 'en' ? 'active' : '' }}">
                🇬🇧 EN
            </a>

            <a href="{{ route('lang.switch', 'ru') }}"
               class="lang-btn {{ app()->getLocale() === 'ru' ? 'active' : '' }}">
                🇷🇺 RU
            </a>

            <a href="{{ route('lang.switch', 'kk') }}"
               class="lang-btn {{ app()->getLocale() === 'kk' ? 'active' : '' }}">
                🇰🇿 KK
            </a>
        </div>

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">{{ __('app.logout') }}</button>
            </form>
        @endauth
    </nav>
</header>

<div class="container">
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

@yield('scripts')
</body>
</html>