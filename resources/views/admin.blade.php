<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dasbor Admin - Eco-Report</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: "#88976d",
              "primary-dark": "#5e694b",
              background: "#F4F8F1",
            },
            fontFamily: { display: ["Plus Jakarta Sans", "sans-serif"] },
          },
        },
      };
    </script>
</head>
<body class="bg-background text-[#151613] font-display flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r border-neutral-200 flex flex-col justify-between hidden md:flex z-20">
        <div>
            <div class="h-20 flex items-center gap-3 px-6 border-b border-neutral-100">
                <div class="flex items-center justify-center size-8 rounded-full bg-primary/20 text-primary">
                    <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                </div>
                <h1 class="font-extrabold text-lg tracking-tight">Eco-Admin</h1>
            </div>
            
            <nav class="p-4 space-y-2">
                <button onclick="switchMenu('ringkasan')" id="menu-ringkasan" class="w-full flex items-center gap-3 px-4 py-3 bg-primary text-white rounded-xl font-bold shadow-md shadow-primary/20 transition-all">
                    <span class="material-symbols-outlined">dashboard</span> Ringkasan
                </button>
                <button onclick="switchMenu('laporan')" id="menu-laporan" class="w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all">
                    <span class="material-symbols-outlined">report</span> Kelola Laporan
                </button>
                <button onclick="switchMenu('pengguna')" id="menu-pengguna" class="w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all">
                    <span class="material-symbols-outlined">group</span> Pengguna
                </button>
            </nav>
        </div>
        
        <div class="p-4 border-t border-neutral-100">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" onclick="return confirm('Yakin ingin keluar dari Dasbor Admin?')" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-colors">
                    <span class="material-symbols-outlined">logout</span> Keluar Dasbor
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <header class="h-20 bg-white border-b border-neutral-200 flex items-center justify-between px-6 md:px-10 shrink-0 z-10">
            <div>
                <h2 id="topbar-title" class="text-xl font-bold text-[#151613]">Dasbor Pusat</h2>
                <p id="topbar-subtitle" class="text-sm text-neutral-500">Pantau dan kelola aksi lingkungan hari ini.</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="hidden md:flex items-center gap-2 bg-neutral-100 hover:bg-neutral-200 text-[#151613] px-4 py-2 rounded-lg font-bold text-sm transition-colors">
                    <span class="material-symbols-outlined text-sm">download</span> Ekspor Data
                </button>
                <span class="font-bold hidden md:block">{{ Auth::user()->name }}</span>
                <div class="h-10 w-10 rounded-full border-2 border-primary bg-neutral-200 overflow-hidden flex items-center justify-center text-primary font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            
            <div id="view-ringkasan" class="space-y-8 block">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Total Laporan</h3>
                            <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-lg">description</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">{{ $reports->count() }}</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Perlu Verifikasi</h3>
                            <span class="material-symbols-outlined text-amber-500 bg-amber-50 p-2 rounded-lg">pending_actions</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">{{ $reports->where('status', 'pending')->count() }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Disetujui Publik</h3>
                            <span class="material-symbols-outlined text-green-500 bg-green-50 p-2 rounded-lg">check_circle</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">{{ $reports->where('status', 'approved')->count() }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Pengguna Aktif</h3>
                            <span class="material-symbols-outlined text-purple-500 bg-purple-50 p-2 rounded-lg">group</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div id="view-laporan" class="space-y-6 hidden">
                <h3 class="text-2xl font-bold">Daftar Laporan Masuk</h3>
                
                <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-neutral-50 text-neutral-500 text-sm border-b border-neutral-100">
                                <th class="p-4 font-medium">Tanggal</th>
                                <th class="p-4 font-medium">Pelapor</th>
                                <th class="p-4 font-medium">Judul & Lokasi</th>
                                <th class="p-4 font-medium text-center">Status</th>
                                <th class="p-4 font-medium text-center">Aksi Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr class="border-b border-neutral-100 hover:bg-neutral-50 transition-colors">
                                <td class="p-4 text-sm">{{ $report->created_at->format('d M Y') }}</td>
                                <td class="p-4 text-sm font-bold">{{ $report->user->name ?? 'Anonim' }}</td>
                                <td class="p-4">
                                    <p class="text-sm font-bold">{{ $report->title }}</p>
                                    <p class="text-xs text-neutral-500">{{ $report->location }}</p>
                                </td>
                                <td class="p-4 text-center">
                                    @if($report->status == 'pending')
                                        <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-bold border border-amber-200">Menunggu</span>
                                    @elseif($report->status == 'approved')
                                        <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-bold border border-green-200">Disetujui</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-red-50 text-red-600 text-xs font-bold border border-red-200">Ditolak</span>
                                    @endif
                                </td>
                                <td class="p-4 flex items-center justify-center gap-2">
                                    @if($report->status == 'pending')
                                        <form action="{{ route('admin.report.approve', $report->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white rounded-lg text-xs font-bold transition-colors flex items-center gap-1 shadow-sm">
                                                <span class="material-symbols-outlined text-[14px]">check</span> Setuju
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.report.reject', $report->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-bold transition-colors flex items-center gap-1 shadow-sm">
                                                <span class="material-symbols-outlined text-[14px]">close</span> Tolak
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs font-medium text-neutral-400 italic">Telah Diverifikasi</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="view-pengguna" class="space-y-6 hidden">
                <h3 class="text-2xl font-bold">Daftar Pengguna / Relawan</h3>
                
                <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-neutral-50 text-neutral-500 text-sm border-b border-neutral-100">
                                <th class="p-4 font-medium">Nama</th>
                                <th class="p-4 font-medium">Email</th>
                                <th class="p-4 font-medium text-center">Jumlah Laporan</th>
                                <th class="p-4 font-medium text-center">Tanggal Bergabung</th>
                                <th class="p-4 font-medium text-center">Peran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="border-b border-neutral-100 hover:bg-neutral-50 transition-colors">
                                <td class="p-4 text-sm font-bold flex items-center gap-3">
                                    <div class="size-8 rounded-full bg-primary/10 text-primary font-bold flex items-center justify-center text-xs">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $user->name }}</span>
                                </td>
                                <td class="p-4 text-sm text-neutral-600">{{ $user->email }}</td>
                                <td class="p-4 text-sm text-center font-bold text-neutral-800">{{ $user->reports_count }} Laporan</td>
                                <td class="p-4 text-sm text-center text-neutral-500">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="p-4 text-center">
                                    @if($user->role == 'admin')
                                        <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-600 text-xs font-bold border border-purple-200">Administrator</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-bold border border-green-200">Relawan</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Navigasi SPA (Tukar Tampilan)
        function switchMenu(targetView) {
            const menus = ['ringkasan', 'laporan', 'pengguna'];
            menus.forEach(menu => {
                document.getElementById(`menu-${menu}`).className = "w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all";
                document.getElementById(`view-${menu}`).classList.add("hidden");
            });

            document.getElementById(`menu-${targetView}`).className = "w-full flex items-center gap-3 px-4 py-3 bg-primary text-white rounded-xl font-bold shadow-md shadow-primary/20 transition-all";
            document.getElementById(`view-${targetView}`).classList.remove("hidden");

            const title = document.getElementById("topbar-title");
            const subtitle = document.getElementById("topbar-subtitle");
            
            if (targetView === 'ringkasan') {
                title.innerText = "Dasbor Pusat";
                subtitle.innerText = "Pantau dan kelola aksi lingkungan hari ini.";
            } else if (targetView === 'laporan') {
                title.innerText = "Kelola Laporan";
                subtitle.innerText = "Daftar seluruh laporan yang dikirimkan warga.";
            } else if (targetView === 'pengguna') {
                title.innerText = "Manajemen Pengguna";
                subtitle.innerText = "Kelola data relawan dan administrator.";
            }
        }
    </script>
</body>
</html>