<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Activity - Monitoring Suhu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #000000; overflow: hidden; }
        .bg-card { background-color: #0f0f0f; border: 1px solid #1f1f1f; }
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0) 100%);
            border-left: 3px solid #10b981;
        }
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
                    <a href="#" class="flex items-center gap-4 py-3 px-4 rounded-xl sidebar-item-active text-emerald-400 text-sm font-medium">
                        <i class="ph-fill ph-list-bullets text-xl"></i> Log Activity
                    </a>
                    <a href="{{ url('/map') }}" 
   class="flex items-center gap-4 py-3 px-4 rounded-xl text-gray-500 hover:text-white transition-all text-sm font-medium">
    
    <i class="ph ph-map-pin text-xl"></i> Map
</a>
                </nav>
            </div>

            <div class="mt-auto p-8">
                <a href="{{ url('/') }}" 
   class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-full border border-gray-800 text-gray-500 hover:text-white hover:border-gray-600 transition-all text-xs font-bold uppercase tracking-wider text-center">
        <i class="ph-bold ph-power text-lg"></i> Logout
</a>
            </div>
        </aside>

        <main class="flex-1 p-8 flex flex-col min-w-0">
            <header class="flex justify-between items-end mb-8 shrink-0">
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Log Activity</h1>
                    <p class="text-xs text-gray-500 font-light italic">Riwayat rekaman suhu seluruh sensor</p>
                </div>
                <div class="flex gap-3">
                    <button class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all shadow-[0_4px_12px_rgba(5,150,105,0.2)]">
                        <i class="ph-bold ph-file-pdf text-lg"></i> EXPORT PDF
                    </button>
                </div>
            </header>

            <div class="grid grid-cols-3 gap-6 mb-8 shrink-0">
                <div class="bg-card p-5 rounded-2xl">
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-1">Total Records</p>
                    <p class="text-xl font-bold text-white">1,284 <span class="text-[10px] text-emerald-500 font-normal ml-2">+12 Today</span></p>
                </div>
                <div class="bg-card p-5 rounded-2xl">
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-1">Highest Temp</p>
                    <p class="text-xl font-bold text-rose-500">52.0°C</p>
                </div>
                <div class="bg-card p-5 rounded-2xl">
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-1">Average Temp</p>
                    <p class="text-xl font-bold text-emerald-400">28.4°C</p>
                </div>
            </div>

            <div class="bg-card rounded-3xl p-6 flex-1 flex flex-col min-h-0 shadow-lg">
                <div class="overflow-y-auto flex-1 custom-scroll">
                    <table class="w-full text-left">
                        <thead class="sticky top-0 bg-[#0f0f0f] z-10">
                            <tr class="text-[9px] text-gray-500 uppercase font-bold tracking-widest border-b border-gray-800">
                                <th class="pb-4 pl-2">Tanggal & Hari</th>
                                <th class="pb-4">Waktu</th>
                                <th class="pb-4">Suhu</th>
                                <th class="pb-4 text-center">Status Api</th>
                                <th class="pb-4 text-right pr-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-[#1f1f1f]">
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="py-4 pl-2 text-gray-400 font-medium">15/02/2026 Minggu</td>
                                <td class="py-4 font-mono">13:30:04</td>
                                <td class="py-4 text-rose-500 font-bold">52°C</td>
                                <td class="py-4 text-center">
                                    <span class="px-3 py-1 rounded-full bg-rose-500/10 text-rose-500 text-[8px] font-black uppercase tracking-wider">🔥 Bahaya</span>
                                </td>
                                <td class="py-4 text-right pr-2">
                                    <button class="text-gray-500 hover:text-white transition"><i class="ph ph-dots-three-outline-vertical text-lg"></i></button>
                                </td>
                            </tr>
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="py-4 pl-2 text-gray-400 font-medium">15/02/2026 Minggu</td>
                                <td class="py-4 font-mono">12:25:12</td>
                                <td class="py-4 text-amber-500 font-bold">36°C</td>
                                <td class="py-4 text-center">
                                    <span class="px-3 py-1 rounded-full bg-amber-500/10 text-amber-500 text-[8px] font-black uppercase tracking-wider">⚠️ Waspada</span>
                                </td>
                                <td class="py-4 text-right pr-2">
                                    <button class="text-gray-500 hover:text-white transition"><i class="ph ph-dots-three-outline-vertical text-lg"></i></button>
                                </td>
                            </tr>
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="py-4 pl-2 text-gray-400 font-medium">15/02/2026 Minggu</td>
                                <td class="py-4 font-mono">10:05:00</td>
                                <td class="py-4 text-white font-medium">26°C</td>
                                <td class="py-4 text-center">
                                    <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-[8px] font-black uppercase tracking-wider">✅ Aman</span>
                                </td>
                                <td class="py-4 text-right pr-2">
                                    <button class="text-gray-500 hover:text-white transition"><i class="ph ph-dots-three-outline-vertical text-lg"></i></button>
                                </td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>