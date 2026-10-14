@extends('goal-tickets.layout')

@section('title', 'จัดการแมตช์')

@section('content')
    <div class="page-heading">
        <div>
            <div class="kicker">Match management</div>
            <h1>จัดการแมตช์ฟุตบอล</h1>
            <p class="muted">เพิ่ม ดู และจัดการข้อมูลการแข่งขันบนหน้าแรก</p>
        </div>
        <a href="{{ route('goal-tickets.create') }}" class="button button-green">+ เพิ่มแมตช์ใหม่</a>
    </div>

    <section class="stats" aria-label="สรุปข้อมูลแมตช์">
        <div class="stat"><strong>{{ number_format($total) }}</strong><span>แมตช์ทั้งหมด</span></div>
        <div class="stat"><strong>{{ number_format($available) }}</strong><span>เปิดจำหน่าย</span></div>
        <div class="stat"><strong>{{ number_format($featured) }}</strong><span>แมตช์แนะนำ</span></div>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <h2>รายการแมตช์</h2>
            <form class="search-form" method="GET" action="{{ route('goal-tickets.index') }}">
                <label class="visually-hidden" for="match-search">ค้นหาแมตช์</label>
                <input class="input" id="match-search" name="search" type="search" value="{{ $search }}" placeholder="ค้นหาลีก ทีม หรือสนาม">
                <button class="button button-outline" type="submit">ค้นหา</button>
                @if ($search !== '')
                    <a href="{{ route('goal-tickets.index') }}" class="button button-outline">ล้าง</a>
                @endif
            </form>
        </div>
        @if ($goalTickets->isEmpty())
            <div class="empty">
                <p>{{ $search !== '' ? 'ไม่พบแมตช์ที่ตรงกับคำค้นหา' : 'ยังไม่มีข้อมูลแมตช์ เริ่มเพิ่มรายการแรกของคุณได้เลย' }}</p>
                @if ($search === '')
                    <a href="{{ route('goal-tickets.create') }}" class="button button-green">เพิ่มแมตช์</a>
                @endif
            </div>
        @else
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>การแข่งขัน</th>
                            <th>วันและเวลา</th>
                            <th>สนาม</th>
                            <th>ราคาเริ่มต้น</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($goalTickets as $goalTicket)
                            <tr>
                                <td>
                                    <div class="match-name">{{ $goalTicket->home }} <span class="muted">vs</span> {{ $goalTicket->away }}</div>
                                    <div class="match-league">{{ $goalTicket->league }} · {{ $goalTicket->short }} @if ($goalTicket->featured) · <span class="accent">แนะนำ</span> @endif</div>
                                </td>
                                <td>{{ $goalTicket->match_at->format('d M Y') }}<br><span class="muted">{{ $goalTicket->match_at->format('H:i') }}</span></td>
                                <td>{{ $goalTicket->stadium }}</td>
                                <td>฿{{ number_format((float) $goalTicket->price, 2) }}</td>
                                <td><span class="badge @if ($goalTicket->status !== 'AVAILABLE') badge-muted @endif">{{ $goalTicket->status }}</span></td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('goal-tickets.show', $goalTicket) }}" class="button button-outline">ดู</a>
                                        <a href="{{ route('goal-tickets.edit', $goalTicket) }}" class="button button-outline">แก้ไข</a>
                                        <form method="POST" action="{{ route('goal-tickets.destroy', $goalTicket) }}" onsubmit="return confirm('ยืนยันลบแมตช์นี้หรือไม่?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button button-danger">ลบ</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrap">{{ $goalTickets->links() }}</div>
        @endif
    </section>
@endsection
