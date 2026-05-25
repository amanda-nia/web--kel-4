<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #000000;
            overflow: hidden; 
        }

        .bg-card { 
            background-color: #0f0f0f;
            border: 1px solid #1f1f1f;
        }

        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0) 100%);
            border-left: 3px solid #10b981;
        }

        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
    </style>
</head>
<body class="text-gray-300 h-screen overflow-hidden">

    <div class="flex h-full">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-black border-r border-[#1f1f1f] flex flex-col shrink-0">
            <div class="p-8">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-700 p-[1px]">
                        <div class="w-full h-full rounded-2xl bg-black flex items-center justify-center font-bold text-white italic">
                            {{ strtoupper(substr(session('name'), 0, 1)) }}
                        </div>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-white leading-tight uppercase tracking-tighter">{{ strtoupper(session('name')) }}</h2>
                        <span class="text-[10px] text-gray-500 font-medium tracking-widest uppercase">Member Panel</span>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="#" class="flex items-center gap-4 py-3 px-4 rounded-xl sidebar-item-active text-emerald-400 text-sm font-medium">
                        <i class="ph-fill ph-grid-four text-xl"></i> Dashboard
                    </a>
                </nav>
            </div>

            <div class="mt-auto p-8">
                <button onclick="window.location.href='/'"
                    class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-full border border-gray-800 text-gray-500 hover:text-white hover:border-gray-600 transition-all text-xs font-bold uppercase tracking-wider">
                    <i class="ph-bold ph-power text-lg"></i> Logout
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-8 flex flex-col min-w-0">
            <header class="flex justify-between items-center mb-8 shrink-0">
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Smart Forest Monitoring</h1>
                    <p class="text-xs text-gray-500 font-light italic">Pantau kondisi hutan secara real-time</p>
                </div>
                <div class="bg-card px-6 py-3 rounded-2xl flex items-center gap-4 border-[#1f1f1f]">
                    <div class="text-right border-r border-gray-800 pr-4">
                        <p class="text-[9px] text-gray-500 uppercase font-bold tracking-[0.2em] mb-1">Status Sistem</p>
                        <p class="text-lg font-bold text-emerald-400 leading-none">Aktif</p>
                    </div>
                    <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                </div>
            </header>

            <!-- STATS CARDS -->
            <div class="grid grid-cols-3 gap-6 mb-6 shrink-0">
                <div class="bg-card p-5 rounded-3xl">
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Suhu Tertinggi</p>
                    <div class="flex items-end gap-2">
                        <p class="text-3xl font-bold text-rose-500">52°C</p>
                        <i class="ph ph-trend-up text-rose-500 mb-1"></i>
                    </div>
                </div>
                <div class="bg-card p-5 rounded-3xl">
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Suhu Terendah</p>
                    <div class="flex items-end gap-2">
                        <p class="text-3xl font-bold text-emerald-400">25°C</p>
                        <i class="ph ph-trend-down text-emerald-400 mb-1"></i>
                    </div>
                </div>
                <div class="bg-card p-5 rounded-3xl">
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Rata-rata</p>
                    <div class="flex items-end gap-2">
                        <p class="text-3xl font-bold text-amber-400">38°C</p>
                        <i class="ph ph-wave-sine text-amber-400 mb-1"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6 flex-1 min-h-0">
                <!-- CHART -->
                <div class="col-span-12 lg:col-span-8 flex flex-col min-h-0">
                    <div class="bg-card rounded-3xl p-6 flex-1 flex flex-col min-h-0 shadow-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-sm font-semibold text-white tracking-wide">Grafik Fluktuasi Suhu</h3>
                            <span class="text-[10px] text-gray-500 flex items-center gap-2 bg-black px-3 py-1 rounded-full border border-gray-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live Data
                            </span>
                        </div>
                        <div class="flex-1 min-h-0">
                            <canvas id="userChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- HISTORY -->
                <div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
                    <div class="bg-card rounded-3xl p-6 flex-1 shadow-lg flex flex-col min-h-0">
                        <h3 class="text-[10px] font-bold text-white mb-6 uppercase tracking-[0.2em] opacity-50 border-b border-gray-800 pb-3">Riwayat Kondisi</h3>
                        <div class="space-y-4 overflow-y-auto custom-scroll pr-2">
                            <div class="flex justify-between items-center bg-black/40 p-3 rounded-2xl border border-white/5">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                    <span class="text-xs font-medium">Aman</span>
                                </div>
                                <span class="text-xs font-mono text-gray-400">26°C</span>
                            </div>
                            <div class="flex justify-between items-center bg-black/40 p-3 rounded-2xl border border-white/5">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                    <span class="text-xs font-medium">Waspada</span>
                                </div>
                                <span class="text-xs font-mono text-gray-400">36°C</span>
                            </div>
                            <div class="flex justify-between items-center bg-black/40 p-3 rounded-2xl border border-white/5">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                                    <span class="text-xs font-medium">Bahaya</span>
                                </div>
                                <span class="text-xs font-mono text-gray-400">52°C</span>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER BOX -->
                    <div class="bg-card rounded-3xl p-6 shadow-lg shrink-0 text-center">
                        <p class="text-[9px] text-gray-600 uppercase font-black tracking-widest">Suhu Optimal Hutan</p>
                        <p class="text-xs text-emerald-500/80 mt-1 font-medium">20°C — 30°C</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const ctx = document.getElementById('userChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['10:00', '10:10', '10:20', '10:30', '10:40', '10:50'],
                datasets: [{
                    data: [25, 30, 35, 40, 45, 52],
                    borderColor: '#10b981',
                    borderWidth: 3,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#000',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { 
                        grid: { color: '#1f1f1f' }, 
                        ticks: { color: '#666', font: { family: 'Poppins', size: 10 } } 
                    },
                    x: { 
                        grid: { display: false }, 
                        ticks: { color: '#666', font: { family: 'Poppins', size: 10 } } 
                    }
                }
            }
        });
    </script>
</body>
</html>