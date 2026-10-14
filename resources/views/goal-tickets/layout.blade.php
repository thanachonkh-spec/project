<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'จัดการแมตช์ฟุตบอล') | ระบบจองตั๋วฟุตบอล</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #080b0a;
            --panel: #111714;
            --panel-light: #18211c;
            --green: #b7ff3c;
            --text: #f5f7f5;
            --muted: #8b9990;
            --border: rgba(255,255,255,.09);
        }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--bg); color: var(--text); font-family: 'Kanit', sans-serif; line-height: 1.6; }
        a { color: inherit; text-decoration: none; }
        button, input, select { font: inherit; }
        button, .button { cursor: pointer; }
        .container { width: min(1180px, 92%); margin: auto; }
        .visually-hidden { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
        .navbar { position: sticky; top: 0; z-index: 10; background: rgba(8,11,10,.94); backdrop-filter: blur(14px); border-bottom: 1px solid var(--border); }
        .nav-inner { min-height: 76px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .logo { font-size: 27px; font-weight: 800; letter-spacing: -1px; }
        .logo span, .accent { color: var(--green); }
        .nav-links, .nav-actions { display: flex; align-items: center; gap: 18px; }
        .nav-links { color: #bdc6bf; font-size: 14px; }
        .nav-links a:hover { color: var(--green); }
        .button { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 16px; border: 1px solid transparent; border-radius: 8px; font-weight: 600; font-size: 14px; transition: .2s; }
        .button-green { color: #10160b; background: var(--green); }
        .button-green:hover { background: #d0ff83; transform: translateY(-1px); }
        .button-outline { color: var(--text); background: transparent; border-color: var(--border); }
        .button-outline:hover { border-color: var(--green); color: var(--green); }
        .button-danger { color: #ff9c9c; background: rgba(255,70,70,.08); border-color: rgba(255,70,70,.22); }
        .page { padding: 48px 0 72px; }
        .page-heading { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 26px; }
        .kicker { color: var(--green); font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
        h1, h2, p { margin-top: 0; }
        h1 { margin-bottom: 4px; font-size: clamp(28px, 4vw, 40px); line-height: 1.25; }
        .muted { color: var(--muted); }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 22px; }
        .stat, .panel { background: var(--panel); border: 1px solid var(--border); border-radius: 14px; }
        .stat { padding: 18px 20px; }
        .stat strong { display: block; color: var(--green); font-size: 27px; }
        .stat span { color: var(--muted); font-size: 13px; }
        .panel { overflow: hidden; }
        .panel-heading { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; padding: 18px 20px; border-bottom: 1px solid var(--border); }
        .panel-heading h2 { margin: 0; font-size: 18px; }
        .search-form { display: flex; gap: 8px; }
        .input, select.input { width: 100%; min-height: 44px; padding: 9px 12px; color: var(--text); background: #0c110e; border: 1px solid var(--border); border-radius: 8px; outline: none; }
        .input:focus { border-color: var(--green); }
        .search-form .input { width: min(320px, 52vw); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid var(--border); vertical-align: middle; }
        th { color: var(--muted); font-size: 11px; letter-spacing: 1px; text-transform: uppercase; font-weight: 600; }
        td { font-size: 14px; }
        tbody tr:last-child td { border-bottom: 0; }
        .match-name { font-weight: 600; }
        .match-league { color: var(--muted); font-size: 12px; }
        .badge { display: inline-block; padding: 4px 9px; color: var(--green); background: rgba(183,255,60,.09); border: 1px solid rgba(183,255,60,.2); border-radius: 99px; font-size: 11px; font-weight: 700; letter-spacing: .5px; }
        .badge-muted { color: #bdc6bf; background: rgba(255,255,255,.05); border-color: var(--border); }
        .actions { display: flex; align-items: center; gap: 7px; white-space: nowrap; }
        .actions .button { padding: 6px 9px; font-size: 12px; }
        .empty { padding: 46px 20px; text-align: center; color: var(--muted); }
        .notice { padding: 12px 16px; margin-bottom: 18px; color: #c9ff8b; background: rgba(183,255,60,.08); border: 1px solid rgba(183,255,60,.2); border-radius: 9px; }
        .form-panel { padding: 24px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
        .field label { display: block; margin-bottom: 7px; color: #c6d1c9; font-size: 13px; font-weight: 500; }
        .field-full { grid-column: 1 / -1; }
        .field-error { color: #ff9c9c; font-size: 12px; margin-top: 5px; }
        input[type="color"].input { width: 100%; padding: 4px; }
        .check-field { display: flex; align-items: center; gap: 9px; min-height: 44px; color: #c6d1c9; }
        .check-field input { accent-color: var(--green); width: 17px; height: 17px; }
        .form-actions { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border); }
        .form-actions > div { display: flex; gap: 9px; }
        .detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0 24px; padding: 10px 22px; }
        .detail { padding: 15px 0; border-bottom: 1px solid var(--border); }
        .detail span { display: block; margin-bottom: 4px; color: var(--muted); font-size: 12px; }
        .detail strong { font-size: 15px; font-weight: 500; }
        .pagination-wrap { padding: 14px 18px; border-top: 1px solid var(--border); }
        .pagination-wrap nav > div:first-child { color: var(--muted); font-size: 13px; }
        .pagination-wrap nav > div:last-child a, .pagination-wrap nav > div:last-child span { display: inline-block; padding: 6px 10px; margin: 2px; border: 1px solid var(--border); border-radius: 6px; }
        .pagination-wrap nav > div:last-child .text-gray-500 { color: var(--muted); }
        .pagination-wrap nav > div:last-child .text-gray-700 { color: var(--text); }
        .pagination-wrap nav > div:last-child .bg-white { background: var(--panel-light); }
        .empty-matches { padding: 30px 0; text-align: center; color: var(--muted); }
        @media (max-width: 760px) {
            .nav-links { display: none; }
            .stats { grid-template-columns: 1fr; }
            .page-heading { align-items: flex-start; flex-direction: column; }
            .table-scroll { overflow-x: auto; }
            table { min-width: 740px; }
        }
        @media (max-width: 560px) {
            .nav-inner { min-height: 66px; }
            .nav-actions { gap: 7px; }
            .nav-actions .button { padding: 8px 10px; font-size: 12px; }
            .form-grid, .detail-grid { grid-template-columns: 1fr; }
            .field-full { grid-column: auto; }
            .form-panel { padding: 18px; }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="logo">Goal<span>Ticket</span></a>
            <nav class="nav-links" aria-label="เมนูหลัก">
                <a href="{{ route('home') }}">หน้าแรก</a>
                <a href="{{ route('goal-tickets.index') }}">จัดการแมตช์</a>
                <a href="{{ route('dashboard') }}">dashboard</a>
            </nav>
            <div class="nav-actions">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="button button-outline" type="submit">ออกจากระบบ</button>
                </form>
            </div>
        </div>
    </header>
    <main class="container page">
        @if (session('success'))
            <div class="notice" role="status">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
