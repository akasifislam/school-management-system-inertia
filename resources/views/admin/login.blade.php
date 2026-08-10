<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="admin-login-page">
        <div class="login-card">
            <div class="login-logo">
                <i class="fas fa-school"></i>
                <h2>গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</h2>
                <p>অ্যাডমিন প্যানেলে লগইন করুন</p>
            </div>
            @if (session('error'))
                <div class="alert alert-error" role="alert"><i
                        class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>
            @endif
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> ইমেইল</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus placeholder="admin@govlab.edu.bd">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> পাসওয়ার্ড</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        required placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:8px">
                    <label style="display:flex;align-items:center;gap:8px;font-weight:400;cursor:pointer">
                        <input type="checkbox" name="remember"> মনে রাখুন
                    </label>
                </div>
                <button type="submit" class="btn btn-primary"
                    style="width:100%;justify-content:center;padding:11px;font-size:15px">
                    <i class="fas fa-sign-in-alt"></i> লগইন করুন
                </button>
            </form>
            <div style="text-align:center;margin-top:18px">
                <a href="{{ route('home') }}" style="color:#1565C0;font-size:13px"><i class="fas fa-arrow-left"></i>
                    ওয়েবসাইটে ফিরে যান</a>
            </div>
        </div>
    </div>
</body>

</html>
