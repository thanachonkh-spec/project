<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลืมรหัสผ่าน | จองตั๋วฟุตบอล</title>
    <style>
        :root {
            --bg: #080b0a;
            --panel: #111714;
            --green: #b7ff3c;
            --text: #f5f7f5;
            --muted: #8b9990;
            --border: rgba(255,255,255,.09);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: radial-gradient(circle at top, rgba(183,255,60,0.14), transparent 30%), var(--bg);
            color: var(--text);
            font-family: 'Kanit', sans-serif;
        }
        .auth-box {
            width: min(420px, 90%);
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 32px 26px;
            box-shadow: 0 20px 60px rgba(0,0,0,.32);
        }
        .brand { text-align: center; font-size: 32px; font-weight: 800; margin-bottom: 10px; }
        .brand span { color: var(--green); }
        h1 { text-align: center; margin: 0 0 8px; }
        .subtitle { text-align: center; color: var(--muted); margin-bottom: 22px; }
        form { display: grid; gap: 16px; }
        label { display: grid; gap: 8px; font-size: 14px; color: #dfe7df; }
        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: rgba(255,255,255,.02);
            color: var(--text);
            font: inherit;
        }
        input:focus { border-color: var(--green); outline: none; }
        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 12px 18px;
            border-radius: 10px;
            border: 1px solid transparent;
            background: var(--green);
            color: #10160b;
            font-weight: 700;
            cursor: pointer;
        }
        .btn:hover { background: #d0ff83; }
        .links {
            margin-top: 18px;
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }
        .links a { color: var(--green); text-decoration: none; }
        .notice {
            margin-bottom: 16px;
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }
        .error-box {
            background: rgba(255, 99, 99, 0.12);
            border: 1px solid rgba(255, 99, 99, 0.35);
            color: #ffc9c9;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <div class="auth-box">
        <div class="brand">Goal<span>Ticket</span></div>
        <h1>Forgot Password</h1>
        <div class="subtitle">Reset your password securely</div>

        <div class="notice">
            Please enter your email address. We will send you a link to reset your password.
        </div>

        @if (session('status'))
            <div class="notice" style="color: #9ef0b4;">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label>
                Email
                <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@example.com">
            </label>

            <button type="submit" class="btn">Send Reset Link</button>
        </form>

        <div class="links">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
</body>
</html>
