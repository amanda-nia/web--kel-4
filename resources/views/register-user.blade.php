<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* BODY */
        body {
            height: 100vh;
            display: flex;
            font-family: 'Poppins', sans-serif;
            background: #2f3e2f;
        }

        /* LEFT */
        .left {
            width: 50%;
            background: url('/forest.jpg') no-repeat center center/cover;
            position: relative;
        }

        .left::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
        }

        /* RIGHT */
        .right {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* CARD */
        .card {
            width: 70%;
            padding: 45px;
            border-radius: 25px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 0 30px rgba(0,0,0,0.3);
            text-align: center;
            color: white;
            animation: fadeIn 0.8s ease;
        }

        /* ANIMATION */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px);}
            to { opacity: 1; transform: translateY(0);}
        }

        /* HEADER */
        .header {
            margin-bottom: 25px;
        }

        .title {
            display: inline-block;
            padding: 8px 25px;
            border-radius: 30px;
            background: rgba(0,0,0,0.4);
            border: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 10px;
            font-weight: 600;
        }

        /* LABEL */
        label {
            display: block;
            text-align: left;
            font-size: 13px;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #ddd;
        }

        /* INPUT GROUP */
        .input-group {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.15);
            border-radius: 25px;
            padding: 0 14px;
            margin-bottom: 12px;
            backdrop-filter: blur(10px);
            gap: 10px;
            transition: 0.3s;
        }

        .input-group input {
            flex: 1;
            padding: 12px;
            border: none;
            outline: none;
            background: transparent;
            color: white;
        }

        input::placeholder {
            color: #ccc;
        }

        /* FOCUS */
        .input-group:focus-within {
            box-shadow: 0 0 10px rgba(100,255,150,0.6);
            transform: scale(1.02);
        }

        .input-group:focus-within .icon {
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        /* ICON */
        .icon {
            width: 20px;
            height: 20px;
            object-fit: contain;
            opacity: 0.9;
            transition: 0.3s;
        }

        /* BUTTON */
        .btn-glass {
            margin-top: 15px;
            padding: 12px 30px;
            border-radius: 30px;
            border: none;
            background: linear-gradient(135deg, #10996bb6, #10b981);
            color: white;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
            width: 100%;
        }

        .btn-glass:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(76,175,80,0.5);
        }

        /* LINK */
        .link {
            margin-top: 20px;
            font-size: 13px;
        }

        .link a {
            color: #00ff48;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .link a:hover {
            text-shadow: 0 0 8px rgba(0, 255, 72, 0.6);
            text-decoration: underline;
        }

        /* EXTRA */
        .extra {
            margin-top: 20px;
            font-size: 11px;
            color: #bbb;
            letter-spacing: 1px;
        }

        /* HIDE DEFAULT IE PASSWORD ICON */
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }

        .show-pass {
            cursor: pointer;
            font-size: 16px;
            opacity: 0.6;
            transition: 0.3s;
        }

        .show-pass:hover { opacity: 1; }
    </style>
</head>

<body>

<!-- LEFT -->
<div class="left"></div>

<!-- RIGHT -->
<div class="right">
    <div class="card">

        <div class="header">
            <div class="title">Register</div>
        </div>

        <form method="POST" action="/register-user">
            @csrf

            <label>Nama Lengkap</label>
            <div class="input-group">
                <img src="/icon/user.png" class="icon"> <!-- Pastikan path ikon sesuai -->
                <input type="text" name="name" placeholder="Masukkan nama" required autofocus>
            </div>

            <label>Email</label>
            <div class="input-group">
                <img src="/icon/email.png" class="icon">
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>

            <label>Password</label>
            <div class="input-group">
                <img src="/icon/lock.png" class="icon">
                <input type="password" name="password" id="password" placeholder="Buat password" required>
                <span class="show-pass" onclick="togglePass()">👁</span>
            </div>

            <button type="submit" class="btn-glass">Daftar Sekarang</button>
        </form>

        <div class="link">
            Sudah memiliki akun? <a href="/login-user">Masuk di sini</a>
        </div>

        <div class="extra">
            FOREST MONITORING SYSTEM
        </div>

    </div>
</div>

<script>
    function togglePass() {
        const p = document.getElementById("password");
        p.type = p.type === "password" ? "text" : "password";
    }
</script>

</body>
</html>