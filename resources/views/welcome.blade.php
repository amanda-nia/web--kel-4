<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Forest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.8)), url('/forest.jpg') no-repeat center center/cover;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Efek Grid Digital (IoT Vibes) */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: radial-gradient(#10b981 0.5px, transparent 0.5px);
            background-size: 30px 30px;
            opacity: 0.15;
            z-index: 1;
        }

        /* Animasi Radar Scanning */
        .radar-line {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 2px;
            background: linear-gradient(90deg, transparent, #10b981, transparent);
            box-shadow: 0 0 15px #10b981;
            z-index: 2;
            animation: scan 4s linear infinite;
        }

        @keyframes scan {
            0% { top: 0%; opacity: 0; }
            50% { opacity: 0.8; }
            100% { top: 100%; opacity: 0; }
        }

        .overlay {
            position: relative;
            z-index: 10;
            width: 80%;
            max-width: 800px;
            padding: 60px 40px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .iot-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 24px;
        }

        h1 {
            color: white;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.4;
            letter-spacing: -0.5px;
        }

        .btn-container {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn-iot {
            position: relative;
            padding: 14px 40px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 18px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            overflow: hidden;
        }

        .btn-iot:hover {
            background: #10b981;
            border-color: #10b981;
            box-shadow: 0 0 25px rgba(16, 185, 129, 0.4);
            transform: translateY(-5px);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            box-shadow: 0 0 10px #10b981;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>
</head>
<body>

    <div class="radar-line"></div>

    <div class="overlay">
        <div class="iot-badge">
            <span class="status-dot"></span>
            System Live Monitoring
        </div>
        
        <h1>Alat pendeteksi kebakaran dan<br><span class="text-emerald-500">penyiraman otomatis hutan</span></h1>
        
        <p class="text-gray-400 text-xs mt-6 tracking-widest uppercase font-medium">Ingin Login sebagai?</p>

        <div class="btn-container">
            <a href="/register-user" class="btn-iot flex items-center gap-2">
                <i class="ph ph-user text-lg"></i> User
            </a>
            <a href="/login-petugas" class="btn-iot flex items-center gap-2">
                <i class="ph ph-shield-check text-lg"></i> Petugas
            </a>
        </div>
    </div>

    <div class="fixed bottom-8 left-8 z-20 text-[10px] text-gray-500 font-mono">
        LAT: -7.9839 | LONG: 112.6214 <br>
        STATUS: CONNECTED TO ESP32_NODE_01
    </div>

</body>
</html>