<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Petugas</title>
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

.role {
    display: inline-block;
    padding: 8px 25px;
    border-radius: 30px;
    background: rgba(255,255,255,0.2);
    opacity: 0.8;
    font-size: 14px;
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
    padding: 0 10px;
    margin-bottom: 12px;
    backdrop-filter: blur(10px);
}

.input-group span {
    margin-right: 8px;
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
}

.btn-glass:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(76,175,80,0.5);
}

.btn-glass:active {
    transform: scale(0.95);
}

/* STATUS MINI */
.status-mini {
    margin-top: 15px;
    font-size: 13px;
    color: #00ff48;
}

/* EXTRA */
.extra {
    margin-top: 10px;
    font-size: 12px;
    color: #ccc;
}

/* SHOW PASSWORD */
.show-pass {
    cursor: pointer;
    font-size: 16px;
    opacity: 0.6; /* Agar tidak terlalu terang jika tidak ditekan */
    transition: 0.3s;
    padding-right: 10px;
}

.show-pass:hover {
    opacity: 1;
    text-shadow: 0 0 8px rgba(100, 255, 150, 0.8); /* Efek glow neon green */
}

.icon {
    width: 18px;
    height: 18px;
    object-fit: contain;
    opacity: 0.9;
}

.input-group {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-left: 15px;
}

.input-group:focus-within .icon {
    transform: scale(1.1);
    filter: brightness(1.2);
}

.icon {
    width: 20px;
    height: 20px;
    object-fit: contain;
    opacity: 0.9;
}

.input-group {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 14px;
}

.input-group:focus-within .icon {
    transform: scale(1.1);
    filter: brightness(1.2);
}

input::-ms-reveal,
input::-ms-clear {
    display: none;
}

</style>
</head>

<body>

<!-- LEFT -->
<div class="left"></div>

<!-- RIGHT -->
<div class="right">
    <div class="card">

        <div class="header">
            <div class="title">Login</div><br>
            <div class="role">Petugas</div>
        </div>

            <form method="POST" action="/login-petugas">
    @csrf

    <label>Email</label>
    <div class="input-group">
        <img src="/icon/email.png" class="icon">
        <input type="email" name="email" placeholder="Masukkan email" required autofocus>
    </div>

    <label>Password</label>
    <div class="input-group">
        <img src="/icon/lock.png" class="icon">
        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
        <span class="show-pass" onclick="togglePass()">👁</span>
    </div>

    <button type="submit" class="btn-glass">Login</button>
        </form>



        <!-- STATUS -->
        <div class="status-mini">
            🌡 Suhu saat ini: 26°C • Aman
        </div>

        <div class="extra">
            Forest Monitoring System
        </div>

    </div>
</div>

<script>

function togglePass() {
    const p = document.getElementById("password");
    p.type = p.type === "password" ? "text" : "password";
}

</script>

<script>
    // Bagian ini menangkap sinyal dari server (Laravel)
    // Jika ada error pada email, jalankan fungsi pop-up
    @if ($errors->has('email'))
        window.onload = function() {
            // Kita cari input email berdasarkan atribut name="email"
            const emailInput = document.querySelector('input[name="email"]');
            
            // 1. Set pesan yang kamu mau (Bahasa Inggris)
            emailInput.setCustomValidity("Your account is not registered.");
            
            // 2. Perintahkan browser memunculkan pop-up "pinjaman" tadi
            emailInput.reportValidity();

            // 3. Hapus pesan error segera setelah user mengetik lagi
            emailInput.oninput = function() {
                emailInput.setCustomValidity("");
            };
        };
    @endif
</script>

</body>
</html>