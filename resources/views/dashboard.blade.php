@extends('template.backend.master')

@section('content')
<main class="app-main football-dashboard">
    <style>
        .football-dashboard {
            --dash-ink: #122018;
            --dash-muted: #738077;
            --dash-green: #b7ff3c;
            --dash-line: #e8eee9;
            color: var(--dash-ink);
        }
        .football-dashboard .app-content {
            background: #f5f8f5;
            min-height: calc(100vh - 64px);
        }
        .football-dashboard .container-fluid {
            max-width: 1500px;
            padding: 26px clamp(16px, 3vw, 38px) 42px;
        }
        .dashboard-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }
        .dashboard-eyebrow {
            margin: 0 0 5px;
            color: #68806e;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
        }
        .dashboard-heading h1 {
            margin: 0;
            color: #142319;
            font-size: clamp(25px, 3vw, 34px);
            font-weight: 700;
            letter-spacing: -.04em;
        }
        .dashboard-subtitle {
            margin: 4px 0 0;
            color: var(--dash-muted);
            font-size: 14px;
        }
        .dashboard-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .dashboard-actions .btn {
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 13px;
            font-weight: 600;
        }
        .dashboard-actions .btn-dark {
            border-color: #183123;
            background: #183123;
        }
        .dashboard-actions .btn-dark:hover {
            border-color: #254b32;
            background: #254b32;
        }
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }
        .dashboard-stat {
            position: relative;
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 105px;
            padding: 19px;
            overflow: hidden;
            border: 1px solid var(--dash-line);
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(27, 49, 33, .035);
        }
        .dashboard-stat-icon {
            display: grid;
            flex: 0 0 44px;
            width: 44px;
            height: 44px;
            place-items: center;
            border-radius: 13px;
            background: #eff8e8;
            color: #4d762e;
            font-size: 19px;
        }
        .dashboard-stat:nth-child(2) .dashboard-stat-icon { background: #e9f7ef; color: #25824d; }
        .dashboard-stat:nth-child(3) .dashboard-stat-icon { background: #fff5df; color: #b77a14; }
        .dashboard-stat:nth-child(4) .dashboard-stat-icon { background: #eef1ff; color: #5768be; }
        .dashboard-stat strong {
            display: block;
            color: #142319;
            font-size: 25px;
            font-weight: 700;
            line-height: 1.1;
        }
        .dashboard-stat span:last-child {
            display: block;
            margin-top: 5px;
            color: var(--dash-muted);
            font-size: 12px;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.25fr) minmax(320px, .75fr);
            gap: 18px;
            align-items: stretch;
            margin-bottom: 20px;
        }
        .dashboard-panel {
            overflow: hidden;
            border: 1px solid var(--dash-line);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(27, 49, 33, .035);
        }
        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            padding: 18px 21px;
            border-bottom: 1px solid #eef2ef;
        }
        .panel-heading h2 {
            margin: 0;
            color: #18271d;
            font-size: 16px;
            font-weight: 700;
        }
        .panel-heading p {
            margin: 3px 0 0;
            color: var(--dash-muted);
            font-size: 12px;
        }
        .panel-link {
            color: #436d34;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }
        .panel-link:hover { color: #244b2e; }
        .featured-match {
            position: relative;
            display: flex;
            min-height: 278px;
            flex-direction: column;
            justify-content: space-between;
            padding: 23px;
            overflow: hidden;
            color: #f6fff5;
            background:
                radial-gradient(ellipse at 90% 8%, rgba(183, 255, 60, .24), transparent 33%),
                linear-gradient(125deg, #13271b 0%, #1d3926 56%, #294b2d 100%);
        }
        .featured-match::after {
            position: absolute;
            right: -78px;
            bottom: -142px;
            width: 300px;
            height: 300px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 50%;
            box-shadow: 0 0 0 24px rgba(255,255,255,.025), 0 0 0 62px rgba(255,255,255,.02);
            content: "";
            pointer-events: none;
        }
        .featured-top, .featured-teams, .featured-bottom { position: relative; z-index: 1; }
        .featured-top, .featured-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }
        .featured-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #d3edca;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .featured-label i { color: var(--dash-green); }
        .featured-league {
            padding: 5px 9px;
            border: 1px solid rgba(255,255,255,.17);
            border-radius: 99px;
            color: #e3eee2;
            font-size: 11px;
        }
        .featured-teams {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 12px;
            padding: 18px 0;
        }
        .featured-team { min-width: 0; text-align: center; }
        .team-mark {
            display: grid;
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
            place-items: center;
            border: 1px solid rgba(255,255,255,.22);
            border-radius: 18px;
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: .02em;
            box-shadow: inset 0 1px rgba(255,255,255,.2), 0 8px 18px rgba(0,0,0,.16);
        }
        .featured-team strong {
            display: block;
            overflow: hidden;
            color: #fff;
            font-size: clamp(14px, 1.5vw, 18px);
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .versus {
            color: rgba(232, 245, 230, .63);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .18em;
        }
        .featured-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 7px 16px;
            color: #d2e1d2;
            font-size: 12px;
        }
        .featured-meta span { display: inline-flex; align-items: center; gap: 6px; }
        .featured-meta i { color: var(--dash-green); }
        .featured-price { text-align: right; }
        .featured-price small {
            display: block;
            color: #c4d5c2;
            font-size: 10px;
        }
        .featured-price strong {
            color: var(--dash-green);
            font-size: 20px;
            font-weight: 700;
        }
        .featured-empty {
            display: grid;
            min-height: 278px;
            padding: 25px;
            place-content: center;
            text-align: center;
            color: #eaf4e8;
            background: linear-gradient(135deg, #183123, #294b2d);
        }
        .featured-empty i { margin-bottom: 9px; color: var(--dash-green); font-size: 30px; }
        .featured-empty p { margin: 4px 0 14px; color: #ccdbca; font-size: 13px; }
        .featured-empty .btn { justify-self: center; border-radius: 9px; font-size: 12px; font-weight: 700; }
        .upcoming-list { padding: 3px 20px; }
        .upcoming-item {
            display: grid;
            grid-template-columns: 62px minmax(0, 1fr) auto;
            align-items: center;
            gap: 12px;
            padding: 15px 0;
            border-bottom: 1px solid #eef2ef;
        }
        .upcoming-item:last-child { border-bottom: 0; }
        .match-date {
            display: grid;
            width: 58px;
            min-height: 54px;
            align-content: center;
            border-radius: 11px;
            background: #f2f7ef;
            text-align: center;
        }
        .match-date strong { color: #2f5835; font-size: 18px; line-height: 1; }
        .match-date span { margin-top: 4px; color: #718072; font-size: 10px; font-weight: 700; text-transform: uppercase; }
        .upcoming-info { min-width: 0; }
        .upcoming-league {
            overflow: hidden;
            margin-bottom: 3px;
            color: #7b887c;
            font-size: 10px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .upcoming-teams {
            overflow: hidden;
            color: #1d2c21;
            font-size: 13px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .upcoming-venue {
            overflow: hidden;
            margin-top: 2px;
            color: #89948b;
            font-size: 10px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .upcoming-side { text-align: right; }
        .upcoming-time { color: #536454; font-size: 11px; font-weight: 600; }
        .match-status {
            display: inline-block;
            margin-top: 5px;
            padding: 3px 7px;
            border-radius: 99px;
            background: #edf8e7;
            color: #4d7f31;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .04em;
            white-space: nowrap;
        }
        .match-status.status-muted { background: #f1f2f1; color: #7c837d; }
        .empty-upcoming {
            padding: 36px 15px;
            color: var(--dash-muted);
            font-size: 13px;
            text-align: center;
        }
        .empty-upcoming i { display: block; margin-bottom: 8px; color: #9bac9d; font-size: 24px; }
        @media (max-width: 991.98px) {
            .dashboard-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .dashboard-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 575.98px) {
            .football-dashboard .container-fluid { padding-top: 20px; }
            .dashboard-heading { align-items: flex-start; flex-direction: column; }
            .dashboard-actions { width: 100%; }
            .dashboard-actions .btn { flex: 1; }
            .dashboard-stat { min-height: 91px; gap: 10px; padding: 13px; }
            .dashboard-stat-icon { flex-basis: 38px; width: 38px; height: 38px; font-size: 17px; }
            .dashboard-stat strong { font-size: 22px; }
            .dashboard-stat span:last-child { font-size: 11px; }
            .featured-match { min-height: 260px; padding: 18px; }
            .featured-meta { gap: 7px 10px; font-size: 11px; }
            .upcoming-list { padding-right: 14px; padding-left: 14px; }
            .upcoming-item { grid-template-columns: 52px minmax(0, 1fr) auto; gap: 9px; }
            .match-date { width: 50px; min-height: 50px; }
            .upcoming-teams { font-size: 12px; }
        }
    </style>

    <div class="app-content">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <div>
                    <p class="dashboard-eyebrow">Matchday overview</p>
                    <h1>แดชบอร์ด</h1>
                    <p class="dashboard-subtitle">ภาพรวมแมตช์และการจำหน่ายบัตรของคุณ</p>
                </div>
                <div class="dashboard-actions">
                    <a href="{{ route('goal-tickets.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-ticket-perforated me-1"></i> จัดการแมตช์
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>  ออกจากระบบ </button>
                </form>
                </div>
            </div>

            <section class="dashboard-stats" aria-label="สรุปข้อมูลการแข่งขัน">
                <div class="dashboard-stat">
                    <span class="dashboard-stat-icon"><i class="bi bi-calendar2-event"></i></span>
                    <div><strong>{{ number_format($stats['total']) }}</strong><span>แมตช์ทั้งหมด</span></div>
                </div>
                <div class="dashboard-stat">
                    <span class="dashboard-stat-icon"><i class="bi bi-ticket-perforated"></i></span>
                    <div><strong>{{ number_format($stats['available']) }}</strong><span>เปิดจำหน่าย</span></div>
                </div>
                <div class="dashboard-stat">
                    <span class="dashboard-stat-icon"><i class="bi bi-star"></i></span>
                    <div><strong>{{ number_format($stats['featured']) }}</strong><span>แมตช์แนะนำ</span></div>
                </div>
                <div class="dashboard-stat">
                    <span class="dashboard-stat-icon"><i class="bi bi-trophy"></i></span>
                    <div><strong>{{ number_format($stats['leagues']) }}</strong><span>ลีกที่มีในระบบ</span></div>
                </div>
            </section>

            <section class="dashboard-grid" aria-label="การแข่งขัน">
                <article class="dashboard-panel">
                    <div class="panel-heading">
                        <div>
                            <h2>แมตช์ไฮไลต์</h2>
                            <p>คู่แข่งขันที่กำลังจะมาถึง</p>
                        </div>
                        <span class="panel-link"><i class="bi bi-lightning-charge-fill me-1"></i> MATCHDAY</span>
                    </div>
                    @if ($featuredMatch)
                        <div class="featured-match">
                            <div class="featured-top">
                                <span class="featured-label"><i class="bi bi-star-fill"></i> {{ $featuredMatch->featured ? 'แมตช์แนะนำ' : 'คู่ถัดไป' }}</span>
                                <span class="featured-league">{{ $featuredMatch->league }} · {{ $featuredMatch->short }}</span>
                            </div>
                            <div class="featured-teams">
                                <div class="featured-team">
                                    <span class="team-mark" style="background: {{ $featuredMatch->home_color }}">{{ $featuredMatch->home_short }}</span>
                                    <strong>{{ $featuredMatch->home }}</strong>
                                </div>
                                <span class="versus">VS</span>
                                <div class="featured-team">
                                    <span class="team-mark" style="background: {{ $featuredMatch->away_color }}">{{ $featuredMatch->away_short }}</span>
                                    <strong>{{ $featuredMatch->away }}</strong>
                                </div>
                            </div>
                            <div class="featured-bottom">
                                <div class="featured-meta">
                                    <span><i class="bi bi-calendar3"></i> {{ $featuredMatch->match_at->format('d/m/Y') }}</span>
                                    <span><i class="bi bi-clock"></i> {{ $featuredMatch->match_at->format('H:i') }}</span>
                                    <span><i class="bi bi-geo-alt"></i> {{ $featuredMatch->stadium }}</span>
                                </div>
                                <div class="featured-price">
                                    <small>เริ่มต้น</small>
                                    <strong>฿{{ number_format((float) $featuredMatch->price) }}</strong>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="featured-empty">
                            <i class="bi bi-calendar2-plus"></i>
                            <strong>ยังไม่มีแมตช์ที่กำลังจะมาถึง</strong>
                            <p>เพิ่มการแข่งขันใหม่เพื่อเริ่มจัดการการจำหน่ายบัตร</p>
                            <a href="{{ route('goal-tickets.create') }}" class="btn btn-light">เพิ่มแมตช์แรก</a>
                        </div>
                    @endif
                </article>

                <article class="dashboard-panel">
                    <div class="panel-heading">
                        <div>
                            <h2>โปรแกรมถัดไป</h2>
                            <p>{{ number_format($upcomingMatches->count()) }} รายการที่กำลังจะมาถึง</p>
                        </div>
                        <a href="{{ route('goal-tickets.index') }}" class="panel-link">ดูทั้งหมด <i class="bi bi-arrow-right"></i></a>
                    </div>
                    @if ($upcomingMatches->isNotEmpty())
                        <div class="upcoming-list">
                            @foreach ($upcomingMatches as $match)
                                <div class="upcoming-item">
                                    <div class="match-date">
                                        <strong>{{ $match->match_at->format('d') }}</strong>
                                        <span>{{ $match->match_at->format('M') }}</span>
                                    </div>
                                    <div class="upcoming-info">
                                        <div class="upcoming-league">{{ $match->league }} · {{ $match->short }}</div>
                                        <div class="upcoming-teams">{{ $match->home }} <span class="text-body-secondary">vs</span> {{ $match->away }}</div>
                                        <div class="upcoming-venue"><i class="bi bi-geo-alt me-1"></i>{{ $match->stadium }}</div>
                                    </div>
                                    <div class="upcoming-side">
                                        <div class="upcoming-time">{{ $match->match_at->format('H:i') }}</div>
                                        <span class="match-status @if ($match->status !== 'AVAILABLE') status-muted @endif">{{ $match->status }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-upcoming">
                            <i class="bi bi-calendar-x"></i>
                            ไม่มีโปรแกรมการแข่งขันที่กำลังจะมาถึง
                        </div>
                    @endif
                </article>
            </section>
        </div>
    </div>
</main>
@endsection
