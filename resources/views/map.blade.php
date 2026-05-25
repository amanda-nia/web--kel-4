<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Map - Naya IoT Monitoring</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #000000; overflow: hidden; }
        
        .bg-card { background-color: #0f0f0f; border: 1px solid #1f1f1f; }
        
        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0) 100%);
            border-left: 3px solid #10b981;
        }

        #map { 
            background: #0b0b0b; 
            border-radius: 24px;
            filter: grayscale(0.2) contrast(1.1);
        }

        /* Upgrade Marker IoT: Efek Berdenyut */
        .iot-pulse-marker {
            width: 12px;
            height: 12px;
            background: #10b981;
            border: 2px solid white;
            border-radius: 50%;
            position: relative;
        }

        .iot-pulse-marker::after {
            content: '';
            width: 30px;
            height: 30px;
            background: rgba(16, 185, 129, 0.4);
            border-radius: 50%;
            position: absolute;
            top: -11px;
            left: -11px;
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.3); opacity: 0.8; }
            80%, 100% { transform: scale(1.5); opacity: 0; }
        }

        /* Custom Popup Styling */
        .leaflet-popup-content-wrapper {
            background: rgba(15, 15, 15, 0.9);
            backdrop-filter: blur(10px);
            color: white;
            border: 1px solid #1f1f1f;
            border-radius: 12px;
            padding: 5px;
        }

        .leaflet-popup-tip { background: rgba(15, 15, 15, 0.9); }
    </style>
</head>
<body class="text-gray-300 h-screen">
    <div class="flex h-full">
        <aside class="w-64 bg-black border-r border-[#1f1f1f] flex flex-col shrink-0">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-700 p-[1px]">
                        <div class="w-full h-full rounded-2xl bg-black flex items-center justify-center font-bold text-white italic">{{ strtoupper(substr(session('nama'), 0, 1)) }}</div>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-white leading-tight uppercase tracking-tighter">{{ session('nama') }}</h2>
                        <span class="text-[10px] text-gray-500 font-medium tracking-widest uppercase">Admin Panel</span>
                    </div>
                </div>
                <nav class="space-y-2">
                    <a href="{{ url('/dashboard-petugas') }}" class="flex items-center gap-4 py-3 px-4 rounded-xl text-gray-500 hover:text-white transition-all text-sm font-medium">
                        <i class="ph ph-grid-four text-xl"></i> Dashboard
                    </a>
                    <a href="{{ url('/log-activity') }}" class="flex items-center gap-4 py-3 px-4 rounded-xl text-gray-500 hover:text-white transition-all text-sm font-medium">
                        <i class="ph ph-list-bullets text-xl"></i> Log Activity
                    </a>
                    <a href="#" class="flex items-center gap-4 py-3 px-4 rounded-xl sidebar-item-active text-emerald-400 text-sm font-medium">
                        <i class="ph-fill ph-map-pin text-xl"></i> Map
                    </a>
                </nav>
            </div>
            <div class="mt-auto p-8">
                <a href="{{ url('/') }}" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-full border border-gray-800 text-gray-500 hover:text-white transition-all text-xs font-bold uppercase tracking-wider">
                    <i class="ph-bold ph-power text-lg"></i> Logout
                </a>
            </div>
        </aside>

        <main class="flex-1 p-8 flex flex-col relative">
            <header class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Geographic Data Distribution</h1>
                    <p class="text-xs text-gray-500 font-light italic">Monitoring lokasi sensor ESP32 secara real-time</p>
                </div>
                <div class="bg-card px-4 py-2 rounded-xl border border-emerald-500/20 flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981] animate-pulse"></div>
                    <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Nodes Active: 12</span>
                </div>
            </header>

            <div class="bg-card rounded-[32px] p-2 flex-1 shadow-2xl overflow-hidden relative">
                <div id="map" class="w-full h-full"></div>
                
                <div class="absolute bottom-6 right-6 z-[1000] flex flex-col gap-2">
                    <div class="bg-black/80 backdrop-blur-md p-4 rounded-2xl border border-white/10 text-[10px]">
                        <p class="text-gray-500 mb-1">COORDINATES</p>
                        <p class="text-white font-mono tracking-wider">-7.9839, 112.6214</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Set tampilan awal peta
        var map = L.map('map', {
            zoomControl: false // Kita hilangkan dulu biar bersih
        }).setView([-7.9839, 112.6214], 14);

        // Tambahkan zoom control di kanan agar tidak menutupi sidebar
        L.control.zoom({ position: 'topright' }).addTo(map);

        // Tile layer Dark Mode (CartoDB Dark Matter)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Custom Icon untuk IoT Marker
        var iotIcon = L.divIcon({
            className: 'custom-div-icon',
            html: "<div class='iot-pulse-marker'></div>",
            iconSize: [12, 12],
            iconAnchor: [6, 6]
        });

        // Tambahkan Marker dengan Popup Aesthetic
        var marker = L.marker([-7.9839, 112.6214], { icon: iotIcon }).addTo(map);
        
        marker.bindPopup(`
            <div style="min-width: 150px">
                <p style="font-size: 10px; color: #10b981; font-weight: bold; margin-bottom: 4px;">ONLINE • NODE_01</p>
                <p style="font-size: 14px; font-weight: bold; margin-bottom: 2px;">Sensor Ruang Utama</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; border-top: 1px solid #333; pt: 8px;">
                    <span style="font-size: 10px; color: #888;">Current Temp:</span>
                    <span style="font-size: 12px; color: #10b981; font-weight: bold;">26.0°C</span>
                </div>
            </div>
        `).openPopup();

    </script>
</body>
</html>