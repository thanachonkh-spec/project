@extends('goal-tickets.layout')

@section('title', 'รายละเอียดแมตช์')

@section('content')
    <div class="page-heading">
        <div>
            <div class="kicker">{{ $goalTicket->league }} · {{ $goalTicket->short }}</div>
            <h1>{{ $goalTicket->home }} <span class="accent">VS</span> {{ $goalTicket->away }}</h1>
            <p class="muted">รายละเอียดแมตช์ฟุตบอล</p>
        </div>
        <div class="actions">
            <a href="{{ route('goal-tickets.index') }}" class="button button-outline">กลับไปรายการ</a>
            <a href="{{ route('goal-tickets.edit', $goalTicket) }}" class="button button-green">แก้ไขข้อมูล</a>
        </div>
    </div>

    <section class="panel">
        <div class="detail-grid">
            <div class="detail"><span>ลีก</span><strong>{{ $goalTicket->league }} ({{ $goalTicket->short }})</strong></div>
            <div class="detail"><span>สถานะ</span><strong><span class="badge @if ($goalTicket->status !== 'AVAILABLE') badge-muted @endif">{{ $goalTicket->status }}</span></strong></div>
            <div class="detail"><span>ทีมเจ้าบ้าน</span><strong><span class="accent">{{ $goalTicket->home_short }}</span> · {{ $goalTicket->home }}</strong></div>
            <div class="detail"><span>ทีมเยือน</span><strong><span class="accent">{{ $goalTicket->away_short }}</span> · {{ $goalTicket->away }}</strong></div>
            <div class="detail"><span>วันแข่งขัน</span><strong>{{ $goalTicket->match_at->format('d M Y, H:i') }}</strong></div>
            <div class="detail"><span>สนาม</span><strong>{{ $goalTicket->stadium }}</strong></div>
            <div class="detail"><span>ราคาเริ่มต้น</span><strong class="accent">฿{{ number_format((float) $goalTicket->price, 2) }} THB</strong></div>
            <div class="detail"><span>แมตช์แนะนำ</span><strong>{{ $goalTicket->featured ? 'ใช่' : 'ไม่ใช่' }}</strong></div>
        </div>
        <div class="form-actions" style="margin: 0 22px 16px;">
            <span class="muted">สร้างเมื่อ {{ $goalTicket->created_at->format('d M Y H:i') }}</span>
            <form method="POST" action="{{ route('goal-tickets.destroy', $goalTicket) }}" onsubmit="return confirm('ยืนยันลบแมตช์นี้หรือไม่?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="button button-danger">ลบแมตช์นี้</button>
            </form>
        </div>
    </section>
@endsection
