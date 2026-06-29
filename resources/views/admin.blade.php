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

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-neutral-200 flex flex-col justify-between hidden md:flex z-20">
        <div class="overflow-y-auto">
            <div class="h-20 flex items-center gap-3 px-6 border-b border-neutral-100 shrink-0">
                <div class="flex items-center justify-center size-8 rounded-full bg-primary/20 text-primary">
                    <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                </div>
                <h1 class="font-extrabold text-lg tracking-tight">Eco-Admin</h1>
            </div>
            
            <nav class="p-4 space-y-2">
                <!-- Menu Khusus Admin -->
                <button onclick="switchMenu('ringkasan')" id="menu-ringkasan" class="w-full flex items-center gap-3 px-4 py-3 bg-[#88976d] text-white rounded-xl font-bold shadow-md transition-all">
                    <span class="material-symbols-outlined">dashboard</span> Ringkasan
                </button>
                <button onclick="switchMenu('laporan')" id="menu-laporan" class="w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all">
                    <span class="material-symbols-outlined">report</span> Kelola Laporan
                </button>
                <button onclick="switchMenu('pengguna')" id="menu-pengguna" class="w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all">
                    <span class="material-symbols-outlined">group</span> Pengguna
                </button>
                
                <!-- TAB PROFIL ADMIN -->
                <button onclick="switchMenu('profil')" id="menu-profil" class="w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all">
                    <span class="material-symbols-outlined">person</span> Profil Saya
                </button>

                <!-- Menu Halaman Publik -->
                <div class="pt-4 mt-4 space-y-2 border-t border-neutral-100">
                    <p class="px-4 text-xs font-bold text-neutral-400 uppercase tracking-wider mb-2">Halaman Publik</p>
                    <a href="{{ url('/') }}" class="w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all">
                        <span class="material-symbols-outlined">language</span> Beranda Publik
                    </a>
                </div>
            </nav>
        </div>
        
        <div class="p-4 border-t border-neutral-100 shrink-0">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" onclick="return confirm('Yakin ingin keluar?')" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-colors">
                    <span class="material-symbols-outlined">logout</span> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <!-- HEADER -->
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

        <!-- AREA KONTEN -->
        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            
            <!-- VIEW: RINGKASAN -->
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

            <!-- VIEW: KELOLA LAPORAN -->
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

            <!-- VIEW: PENGGUNA -->
            <div id="view-pengguna" class="space-y-6 hidden">
                <h3 class="text-2xl font-bold">Daftar Pengguna / Relawan</h3>
                
                <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-left text-neutral-500 border-b border-neutral-200">
                                <th class="p-4 text-xs font-bold uppercase">Nama</th>
                                <th class="p-4 text-xs font-bold uppercase">Email</th>
                                <th class="p-4 text-xs font-bold uppercase">Laporan</th>
                                <th class="p-4 text-xs font-bold uppercase">Tanggal</th>
                                <th class="p-4 text-xs font-bold uppercase">Peran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-neutral-100 bg-neutral-50/50">
                                <td class="p-4">Anonim</td>
                                <td class="p-4">-</td>
                                <td class="p-4">{{ $anonymousCount }} Laporan</td>
                                <td class="p-4">-</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 bg-neutral-200 text-neutral-700 text-xs rounded-full">Sistem</span>
                                </td>
                            </tr>
                            @foreach($users as $user)
                            <tr class="border-b border-neutral-100">
                                <td class="p-4">{{ $user->name }}</td>
                                <td class="p-4">{{ $user->email }}</td>
                                <td class="p-4">{{ $user->reports_count }} Laporan</td>
                                <td class="p-4">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">{{ $user->role }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- VIEW: PROFIL ADMIN -->
            <div id="view-profil" class="space-y-6 hidden">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Kartu Info Admin -->
                    <div class="w-full md:w-1/3 flex flex-col gap-6">
                        <div class="bg-white rounded-3xl p-8 shadow-sm border border-neutral-100 flex flex-col items-center text-center">
                            <div class="size-24 rounded-full bg-primary text-white flex items-center justify-center text-4xl font-extrabold shadow-md mb-4">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <h2 class="text-2xl font-bold text-[#151613] mb-1">{{ Auth::user()->name }}</h2>
                            <p class="text-sm text-neutral-500 mb-6">{{ Auth::user()->email }}</p>
                            <span class="px-4 py-1.5 bg-purple-50 text-purple-600 font-bold text-xs rounded-full border border-purple-200">
                                Administrator
                            </span>
                        </div>
                    </div>

                    <!-- Riwayat Laporan Milik Admin (seperti user biasa) -->
                    <div class="w-full md:w-2/3 flex flex-col gap-6">
                        <div class="bg-white rounded-3xl p-8 shadow-sm border border-neutral-100 min-h-[300px]">
                            <h3 class="text-xl font-bold text-[#151613] mb-6">Riwayat Laporan Saya</h3>
                            <div class="space-y-4">
                                @php
                                    // Ambil hanya laporan yang dibuat oleh admin ini
                                    $myReports = $reports->where('user_id', Auth::id());
                                @endphp
                                
                                @forelse($myReports as $report)
                                    <div class="flex items-center gap-4 p-4 border border-neutral-100 rounded-xl bg-neutral-50">
                                        <div class="flex-1">
                                            <h4 class="font-bold text-sm">{{ $report->title }}</h4>
                                            <p class="text-xs text-neutral-500">{{ $report->created_at->format('d M Y') }}</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold">{{ $report->status }}</span>
                                    </div>
                                @empty
                                    <p class="text-sm text-neutral-500 text-center py-6">Anda belum pernah membuat laporan pribadi dari akun ini.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- SCRIPT NAVIGASI -->
    <script>
        function switchMenu(targetView) {
            const menus = ['ringkasan', 'laporan', 'pengguna', 'profil'];
            
            menus.forEach(menu => {
                document.getElementById(`menu-${menu}`).className = "w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all";
                document.getElementById(`view-${menu}`).classList.add("hidden");
            });

            // Aktifkan tab yang dipilih
            document.getElementById(`menu-${targetView}`).className = "w-full flex items-center gap-3 px-4 py-3 bg-[#88976d] text-white rounded-xl font-bold shadow-md transition-all";
            document.getElementById(`view-${targetView}`).classList.remove("hidden");

            // Ubah Header Otomatis
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
            } else if (targetView === 'profil') {
                title.innerText = "Profil Saya";
                subtitle.innerText = "Informasi akun dan riwayat laporan pribadi Anda.";
            }
        }
    </script>
</body>
</html>