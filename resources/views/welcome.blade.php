<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GoalTicket - ค้นหาและจองตั๋วฟุตบอลพรีเมียร์ลีกและลาลีกา">
    <title>GoalTicket | Your Matchday Starts Here</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #080b0a;
            --panel: #111714;
            --panel-light: #18211c;
            --green: #b7ff3c;
            --green-dark: #8bc92c;
            --text: #f5f7f5;
            --muted: #8b9990;
            --border: rgba(255,255,255,.09);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Kanit', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        .container {
            width: min(1180px, 92%);
            margin: auto;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(8,11,10,.94);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
        }

        .nav-inner {
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -1px;
            white-space: nowrap;
        }

        .logo span {
            color: var(--green);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            color: #bdc6bf;
            font-size: 14px;
        }

        .nav-links a:hover {
            color: var(--green);
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 11px 19px;
            border-radius: 8px;
            border: 1px solid transparent;
            font-weight: 600;
            font-size: 14px;
            transition: .2s;
        }

        .btn-green {
            background: var(--green);
            color: #10160b;
        }

        .btn-green:hover {
            background: #d0ff83;
            transform: translateY(-2px);
        }

        .btn-outline {
            border-color: var(--border);
            background: transparent;
            color: var(--text);
        }

        .btn-outline:hover {
            border-color: var(--green);
            color: var(--green);
        }

        .hero {
            position: relative;
            overflow: hidden;
            min-height: 510px;
            display: flex;
            align-items: center;
            background:
                linear-gradient(90deg, rgba(8,11,10,.98) 0%, rgba(8,11,10,.85) 48%, rgba(8,11,10,.25) 100%),
                linear-gradient(0deg, var(--bg), transparent 45%),
                url('https://images.unsplash.com/photo-1522778119026-d647f0596c20?auto=format&fit=crop&w=2000&q=85') center 55% / cover no-repeat;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: rgba(183,255,60,.10);
            filter: blur(100px);
            right: 5%;
            top: 15%;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
            padding: 75px 0 85px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--green);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .live-dot {
            width: 8px;
            height: 8px;
            background: var(--green);
            border-radius: 50%;
            box-shadow: 0 0 12px var(--green);
        }

        .hero h1 {
            font-size: clamp(43px, 7vw, 76px);
            line-height: 1.12;
            font-weight: 800;
            margin: 22px 0;
            letter-spacing: -2px;
        }

        .hero h1 span {
            color: var(--green);
        }

        .hero p {
            color: #b7c1b9;
            max-width: 490px;
            font-size: 16px;
            font-weight: 300;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 13px;
            margin-top: 30px;
        }

        .hero-note {
            margin-top: 25px;
            color: #a6b1a9;
            font-size: 12px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }

        .stat {
            background: var(--panel);
            border: 1px solid var(--border);
            padding: 22px;
            border-radius: 12px;
        }

        .stat strong {
            display: block;
            font-size: 27px;
            color: var(--green);
            line-height: 1.4;
        }

        .stat span {
            font-size: 13px;
            color: var(--muted);
        }

        .section {
            padding: 75px 0 20px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 20px;
            margin-bottom: 27px;
        }

        .section-kicker {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--green);
            text-transform: uppercase;
        }

        .section-heading h2 {
            font-size: clamp(27px, 4vw, 38px);
            line-height: 1.3;
            margin-top: 6px;
        }

        .section-heading p {
            font-size: 13px;
            color: var(--muted);
            margin-top: 5px;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 22px;
        }

        .filter-btn {
            border: 1px solid var(--border);
            background: var(--panel);
            color: #bdc6bf;
            border-radius: 8px;
            padding: 9px 17px;
            font-size: 13px;
            transition: .2s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--green);
            color: #10160b;
            border-color: var(--green);
            font-weight: 700;
        }

        .search {
            width: 100%;
            max-width: 320px;
            padding: 11px 14px;
            background: var(--panel);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 8px;
            outline: none;
        }

        .search:focus {
            border-color: var(--green);
        }

        .matches-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .match-card {
            background: linear-gradient(180deg, rgba(24,33,28,.85), rgba(17,23,20,.98));
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px 18px 20px;
            position: relative;
            overflow: hidden;
        }

        .match-card.featured {
            border-color: rgba(183,255,60,.45);
            box-shadow: 0 0 0 1px rgba(183,255,60,.1);
        }

        .match-card.featured::before {
            content: "Featured";
            position: absolute;
            right: 18px;
            top: 14px;
            font-size: 10px;
            letter-spacing: 1.5px;
            padding: 5px 8px;
            border-radius: 999px;
            background: rgba(183,255,60,.16);
            color: var(--green);
            border: 1px solid rgba(183,255,60,.25);
        }

        .match-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .league {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .league-badge {
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(255,255,255,.04);
            border: 1px solid var(--border);
        }

        .status {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.4px;
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(29,255,139,.1);
            color: #89f7bb;
            border: 1px solid rgba(29,255,139,.22);
        }

        .match-main {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 18px;
            margin-bottom: 16px;
        }

        .team {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 9px;
        }

        .crest {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #fff;
            border: 2px solid rgba(255,255,255,.12);
            box-shadow: inset 0 0 18px rgba(255,255,255,.08);
        }

        .team-name {
            font-weight: 700;
            font-size: 18px;
        }

        .versus {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .versus strong {
            color: var(--text);
            font-size: 22px;
            letter-spacing: -1px;
        }

        .match-meta {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: #c6d1c9;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .match-meta .time {
            font-weight: 600;
        }

        .match-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .stadium {
            color: var(--muted);
            font-size: 12px;
        }

        .price-box {
            text-align: right;
        }

        .price-label {
            display: block;
            font-size: 11px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1.4px;
        }

        .price {
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -1px;
            color: var(--green);
            line-height: 1.1;
        }

        .price small {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
        }

        .book-btn {
            padding: 11px 18px;
            border-radius: 10px;
            border: 1px solid rgba(183,255,60,.28);
            background: rgba(183,255,60,.08);
            color: var(--green);
            font-weight: 700;
            transition: .2s;
        }

        .book-btn:hover {
            background: var(--green);
            color: #10160b;
        }

        @media (max-width: 900px) {
            .nav-links {
                display: none;
            }

            .stats,
            .matches-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .hero {
                min-height: 460px;
            }

            .hero-content {
                padding: 58px 0 68px;
            }

            .nav-inner {
                min-height: 68px;
            }

            .match-main {
                grid-template-columns: 1fr;
            }

            .versus {
                order: 2;
            }

            .match-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="container nav-inner">
            <a href="#" class="logo">Goal<span>Ticket</span></a>

            <nav class="nav-links" aria-label="Main navigation">
                <a href="#">Home</a>
                <a href="#">Matches</a>
                <a href="#">Leagues</a>
                <a href="#">Stadiums</a>
                <a href="#">Support</a>
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </nav>

            <div class="nav-actions">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                @else
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline">Log out</button>
                    </form>
                @endguest
                <button class="btn btn-green" type="button">Buy Tickets</button>
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container hero-content">
                <div class="eyebrow"><span class="live-dot"></span> Matchday Live</div>
                <h1>Book the <span>biggest</span> moments.</h1>
                <p>ค้นหาตั๋วฟุตบอลระดับโลกได้ง่าย ๆ จบในทีเดียว พร้อมราคาที่โปร่งใส และประสบการณ์การจองที่รวดเร็ว</p>

                <div class="hero-buttons">
                    <a href="#matches" class="btn btn-green">Browse Matches</a>
                    <a href="#" class="btn btn-outline">How it works</a>
                </div>

                <div class="hero-note">Trusted by 120k+ fans • Secure checkout • Instant confirmation</div>
            </div>
        </section>

        <section class="container stats" aria-label="Statistics">
            <div class="stat">
                <strong>120k+</strong>
                <span>Tickets sold</span>
            </div>
            <div class="stat">
                <strong>24/7</strong>
                <span>Support desk</span>
            </div>
            <div class="stat">
                <strong>4.9/5</strong>
                <span>Rating from fans</span>
            </div>
        </section>

        <section id="matches" class="section">
            <div class="container">
                <div class="section-heading">
                    <div>
                        <div class="section-kicker">Featured fixtures</div>
                        <h2>Top matches this week</h2>
                    </div>
                    <p>Choose your next stadium experience</p>
                </div>

                <div class="filters" aria-label="Match filters">
                    <button class="filter-btn active" type="button">All</button>
                    <button class="filter-btn" type="button">Premier League</button>
                    <button class="filter-btn" type="button">La Liga</button>
                    <button class="filter-btn" type="button">Champions League</button>
                    <input class="search" type="search" placeholder="Search a team or stadium" aria-label="Search">
                </div>

                <div class="matches-grid">
                    @foreach ($matches as $match)
                        <article class="match-card @if ($match->featured) featured @endif">
                            <div class="match-top">
                                <div class="league">
                                    <span class="league-badge">{{ $match->short }}</span>
                                    {{ $match->league }}
                                </div>
                                <span class="status">{{ $match->status }}</span>
                            </div>

                            <div class="match-main">
                                <div class="team">
                                    <div class="crest" style="background: {{ $match->home_color }};">{{ $match->home_short }}</div>
                                    <div class="team-name">{{ $match->home }}</div>
                                </div>

                                <div class="versus">
                                    <span>{{ strtoupper($match->match_at->format('d M Y')) }}</span>
                                    <strong>VS</strong>
                                    <span>{{ $match->match_at->format('H:i') }}</span>
                                </div>

                                <div class="team">
                                    <div class="crest" style="background: {{ $match->away_color }};">{{ $match->away_short }}</div>
                                    <div class="team-name">{{ $match->away }}</div>
                                </div>
                            </div>

                            <div class="match-meta">
                                <span class="time">{{ strtoupper($match->match_at->format('d M Y')) }} • {{ $match->match_at->format('H:i') }}</span>
                                <span>{{ $match->stadium }}</span>
                            </div>

                            <div class="match-bottom">
                                <div class="stadium">{{ $match->stadium }}</div>
                                <div class="price-box">
                                    <span class="price-label">from</span>
                                    <div class="price">฿{{ number_format((float) $match->price) }} <small>THB</small></div>
                                </div>
                            </div>

                            <div style="margin-top: 18px; display: flex; justify-content: flex-end;">
                                <button class="book-btn" type="button">Book Now</button>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($matches->isEmpty())
                    <p class="empty-matches">ยังไม่มีแมตช์ที่เปิดจำหน่ายในขณะนี้</p>
                @endif
            </div>
        </section>
    </main>
</body>
</html>
