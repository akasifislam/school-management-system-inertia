<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>রক্ষণাবেক্ষণ — গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0D47A1, #1565C0 50%, #006a4e);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 50px 40px;
            max-width: 520px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .3)
        }

        .icon {
            font-size: 72px;
            margin-bottom: 20px;
            animation: spin 3s linear infinite
        }

        @keyframes spin {

            0%,
            100% {
                transform: rotate(0deg)
            }

            50% {
                transform: rotate(10deg)
            }
        }

        h1 {
            font-size: 26px;
            font-weight: 700;
            color: #0D47A1;
            margin-bottom: 12px
        }

        .sub {
            font-size: 15px;
            color: #546E7A;
            margin-bottom: 24px;
            line-height: 1.7
        }

        .msg-box {
            background: #E3F2FD;
            border: 1px solid #90CAF9;
            border-radius: 8px;
            padding: 16px 20px;
            color: #0D47A1;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 28px
        }

        .school {
            font-size: 13px;
            color: #888;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #eee
        }

        .school strong {
            color: #1565C0
        }

        .admin-link {
            margin-top: 16px;
            display: inline-block;
            color: #1565C0;
            font-size: 13px;
            text-decoration: none;
            opacity: .7
        }

        .admin-link:hover {
            opacity: 1;
            text-decoration: underline
        }

        .dots::after {
            content: '.';
            animation: dots 1.5s infinite;
            font-size: 28px;
            color: #1565C0
        }

        @keyframes dots {
            0% {
                content: '.'
            }

            33% {
                content: '..'
            }

            66% {
                content: '...'
            }

            100% {
                content: '.'
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon">🔧</div>
        <h1>রক্ষণাবেক্ষণ চলছে</h1>
        <p class="sub">আমরা সাইটটি আরও উন্নত করার কাজ করছি<span class="dots"></span></p>
        <div class="msg-box">{{ $message }}</div>
        <div class="school">
            <strong>গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</strong><br>
            সদর দক্ষিণ, কুমিল্লা
        </div>
        <a href="/admin/login" class="admin-link"><i>→</i> অ্যাডমিন লগইন</a>
    </div>
</body>

</html>
