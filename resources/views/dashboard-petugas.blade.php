<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>

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

        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 10px;
        }
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
                        {{ strtoupper(substr(session('nama'), 0, 1)) }}
                    </div>

                </div>

                <div>
                    <h2 class="text-sm font-semibold text-white leading-tight uppercase tracking-tighter">
                        {{ session('nama') }}
                    </h2>

                    <span class="text-[10px] text-gray-500 font-medium tracking-widest uppercase">
                        Admin Panel
                    </span>
                </div>

            </div>

            <nav class="space-y-2">

                <a href="#"
                   class="flex items-center gap-4 py-3 px-4 rounded-xl sidebar-item-active text-emerald-400 text-sm font-medium">

                    <i class="ph-fill ph-grid-four text-xl"></i>
                    Dashboard

                </a>

                <a href="{{ url('/log-activity') }}"
                   class="flex items-center gap-4 py-3 px-4 rounded-xl text-gray-500 hover:text-white transition-all text-sm font-medium">

                    <i class="ph ph-list-bullets text-xl"></i>
                    Log Activity

                </a>

                <a href="{{ url('/map') }}"
                   class="flex items-center gap-4 py-3 px-4 rounded-xl text-gray-500 hover:text-white transition-all text-sm font-medium">

                    <i class="ph ph-map-pin text-xl"></i>
                    Map

                </a>

            </nav>

        </div>

        <div class="mt-auto p-8">

            <button onclick="window.location.href='/'"
                    class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-full border border-gray-800 text-gray-500 hover:text-white hover:border-gray-600 transition-all text-xs font-bold uppercase tracking-wider">

                <i class="ph-bold ph-power text-lg"></i>
                Logout

            </button>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8 flex flex-col min-w-0">

        <!-- HEADER -->
        <header class="flex justify-between items-center mb-8 shrink-0">

            <div>
                <h1 class="text-2xl font-bold text-white tracking-tight">
                    Main Dashboard
                </h1>

                <p class="text-xs text-gray-500 font-light italic">
                    Sistem Monitoring Suhu Real-time
                </p>
            </div>

            <div class="bg-card px-6 py-3 rounded-2xl flex items-center gap-4 border-[#1f1f1f]">

                <div class="text-right border-r border-gray-800 pr-4">

                    <p class="text-[9px] text-gray-500 uppercase font-bold tracking-[0.2em] mb-1">
                        Temperature
                    </p>

                    <p class="text-2xl font-bold text-emerald-400 leading-none">
                        {{ $sensor->first()->value ?? 0 }}°C
                    </p>

                </div>

                <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>

            </div>

        </header>

        <!-- CONTENT -->
        <div class="grid grid-cols-12 gap-6 flex-1 min-h-0">

            <!-- CHART -->
            <div class="col-span-12 lg:col-span-8 flex flex-col min-h-0">

                <div class="bg-card rounded-3xl p-6 flex-1 flex flex-col min-h-0 shadow-lg">

                    <div class="flex justify-between items-center mb-6">

                        <h3 class="text-sm font-semibold text-white tracking-wide">
                            Analisis Fluktuasi
                        </h3>

                        <span class="text-[10px] text-gray-500 flex items-center gap-2 bg-black px-3 py-1 rounded-full border border-gray-800">

                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Sensor Active

                        </span>

                    </div>

                    <div class="flex-1 min-h-0">
                        <canvas id="poppinsChart"></canvas>
                    </div>

                </div>

            </div>

            <!-- STATUS -->
            <div class="col-span-12 lg:col-span-4 flex flex-col gap-6">

                <div class="bg-card rounded-3xl p-6 flex-1 shadow-lg">

                    <h3 class="text-[10px] font-bold text-white mb-6 uppercase tracking-[0.2em] opacity-50 border-b border-gray-800 pb-3">
                        Status
                    </h3>

                    <div class="space-y-5">

                        <div class="flex justify-between items-center">

                            <div class="flex items-center gap-3">

                                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>

                                <span class="text-xs font-medium">
                                    Aman
                                </span>

                            </div>

                            <span class="text-[10px] text-gray-500 font-mono bg-emerald-500/5 px-2 py-1 rounded-md">
                                20°C - 30°C
                            </span>

                        </div>

                        <div class="flex justify-between items-center">

                            <div class="flex items-center gap-3">

                                <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>

                                <span class="text-xs font-medium">
                                    Waspada
                                </span>

                            </div>

                            <span class="text-[10px] text-gray-500 font-mono bg-amber-500/5 px-2 py-1 rounded-md">
                                31°C - 45°C
                            </span>

                        </div>

                        <div class="flex justify-between items-center">

                            <div class="flex items-center gap-3">

                                <div class="w-2.5 h-2.5 rounded-full bg-rose-500"></div>

                                <span class="text-xs font-medium">
                                    Bahaya
                                </span>

                            </div>

                            <span class="text-[10px] text-gray-500 font-mono bg-rose-500/5 px-2 py-1 rounded-md">
                                > 45°C
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <!-- TABLE -->
            <div class="col-span-12 flex-1 min-h-0 pb-4">

                <div class="bg-card rounded-3xl p-6 h-full flex flex-col shadow-lg">

                    <h3 class="text-sm font-semibold text-white mb-4 shrink-0 flex items-center gap-2">

                        <i class="ph ph-clock-counter-clockwise text-emerald-400"></i>

                        Riwayat Terbaru

                        <span class="text-gray-600 font-normal text-[10px] ml-1">
                            (Data Real-time)
                        </span>

                    </h3>

                    <div class="overflow-y-auto flex-1 custom-scroll">

                        <table class="w-full text-left">

                            <thead class="sticky top-0 bg-[#0f0f0f] z-10">

                            <tr class="text-[9px] text-gray-500 uppercase font-bold tracking-widest border-b border-gray-800">

                                <th class="pb-3">Waktu</th>
                                <th class="pb-3">Suhu</th>
                                <th class="pb-3 text-center">Status</th>
                                <th class="pb-3 text-right">Power</th>

                            </tr>

                            </thead>

                            <tbody class="text-xs divide-y divide-[#1f1f1f']">

                            @foreach($sensor as $item)

                                <tr class="hover:bg-white/[0.02] transition">

                                    <td class="py-4 font-mono text-gray-400">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s') }}
                                    </td>

                                    <td class="py-4 font-bold
                                        @if($item->value > 45)
                                            text-rose-500
                                        @elseif($item->value > 30)
                                            text-amber-500
                                        @else
                                            text-white
                                        @endif
                                    ">
                                        {{ $item->value }}°C
                                    </td>

                                    <td class="py-4 text-center">

                                        @if($item->value > 45)

                                            <span class="px-3 py-1 rounded-full bg-rose-500/10 text-rose-500 text-[8px] font-black uppercase tracking-wider">
                                                Bahaya
                                            </span>

                                        @elseif($item->value > 30)

                                            <span class="px-3 py-1 rounded-full bg-amber-500/10 text-amber-500 text-[8px] font-black uppercase tracking-wider">
                                                Waspada
                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-[8px] font-black uppercase tracking-wider">
                                                Aman
                                            </span>

                                        @endif

                                    </td>

                                    <td class="py-4 text-right font-bold text-emerald-400 uppercase">
                                        Aktif
                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

<script>

    const ctx = document.getElementById('poppinsChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 300);

    gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
    gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: [

                @foreach($sensor as $item)

                    "{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}",

                @endforeach

            ],

            datasets: [{

                data: [

                    @foreach($sensor as $item)

                        {{ $item->value }},

                    @endforeach

                ],

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

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {

                y: {
                    grid: {
                        color: '#1f1f1f'
                    },

                    ticks: {
                        color: '#666',
                        font: {
                            family: 'Poppins',
                            size: 10
                        }
                    }
                },

                x: {
                    grid: {
                        display: false
                    },

                    ticks: {
                        color: '#666',
                        font: {
                            family: 'Poppins',
                            size: 10
                        }
                    }
                }
            }
        }
    });

</script>

</body>
</html>     