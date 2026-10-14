@extends('goal-tickets.layout')

@section('title', $heading)

@section('content')
    <div class="page-heading">
        <div>
            <div class="kicker">Match details</div>
            <h1>{{ $heading }}</h1>
            <p class="muted">ข้อมูลนี้จะแสดงบนหน้าแรกเมื่อสถานะเป็น AVAILABLE</p>
        </div>
    </div>

    <section class="panel form-panel">
        <form method="POST" action="{{ $goalTicket->exists ? route('goal-tickets.update', $goalTicket) : route('goal-tickets.store') }}">
            @csrf
            @if ($goalTicket->exists)
                @method('PUT')
            @endif

            <div class="form-grid">
                <div class="field">
                    <label for="league">ลีก</label>
                    <input class="input" id="league" name="league" value="{{ old('league', $goalTicket->league) }}" maxlength="100" required>
                    @error('league') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="short">ตัวย่อลีก</label>
                    <input class="input" id="short" name="short" value="{{ old('short', $goalTicket->short) }}" maxlength="10" required>
                    @error('short') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="home">ทีมเจ้าบ้าน</label>
                    <input class="input" id="home" name="home" value="{{ old('home', $goalTicket->home) }}" maxlength="100" required>
                    @error('home') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="away">ทีมเยือน</label>
                    <input class="input" id="away" name="away" value="{{ old('away', $goalTicket->away) }}" maxlength="100" required>
                    @error('away') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="home_short">ตัวย่อทีมเจ้าบ้าน</label>
                    <input class="input" id="home_short" name="home_short" value="{{ old('home_short', $goalTicket->home_short) }}" maxlength="10" required>
                    @error('home_short') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="away_short">ตัวย่อทีมเยือน</label>
                    <input class="input" id="away_short" name="away_short" value="{{ old('away_short', $goalTicket->away_short) }}" maxlength="10" required>
                    @error('away_short') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="home_color">สีทีมเจ้าบ้าน</label>
                    <input class="input" id="home_color" name="home_color" type="color" value="{{ old('home_color', $goalTicket->home_color ?: '#ef4444') }}" required>
                    @error('home_color') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="away_color">สีทีมเยือน</label>
                    <input class="input" id="away_color" name="away_color" type="color" value="{{ old('away_color', $goalTicket->away_color ?: '#2563eb') }}" required>
                    @error('away_color') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="match_at">วันและเวลาแข่งขัน</label>
                    <input class="input" id="match_at" name="match_at" type="datetime-local" value="{{ old('match_at', $goalTicket->match_at?->format('Y-m-d\TH:i')) }}" required>
                    @error('match_at') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="stadium">สนามแข่งขัน</label>
                    <input class="input" id="stadium" name="stadium" value="{{ old('stadium', $goalTicket->stadium) }}" maxlength="150" required>
                    @error('stadium') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="price">ราคาเริ่มต้น (บาท)</label>
                    <input class="input" id="price" name="price" type="number" min="0" max="99999999.99" step="0.01" value="{{ old('price', $goalTicket->price) }}" required>
                    @error('price') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="status">สถานะ</label>
                    <select class="input" id="status" name="status" required>
                        @foreach (['AVAILABLE' => 'เปิดจำหน่าย', 'SOLD OUT' => 'บัตรหมด', 'CANCELLED' => 'ยกเลิก'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $goalTicket->status ?: 'AVAILABLE') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="field field-full">
                    <label class="check-field">
                        <input name="featured" type="hidden" value="0">
                        <input name="featured" type="checkbox" value="1" @checked(old('featured', $goalTicket->featured))>
                        ทำเครื่องหมายเป็นแมตช์แนะนำ
                    </label>
                    @error('featured') <div class="field-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ $goalTicket->exists ? route('goal-tickets.show', $goalTicket) : route('goal-tickets.index') }}" class="button button-outline">ยกเลิก</a>
                <div>
                    @if ($goalTicket->exists)
                        <a href="{{ route('goal-tickets.show', $goalTicket) }}" class="button button-outline">ดูรายละเอียด</a>
                    @endif
                    <button type="submit" class="button button-green">{{ $submitLabel }}</button>
                </div>
            </div>
        </form>
    </section>
@endsection
