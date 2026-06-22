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
                <button onclick="switchMenu('kategori')" id="menu-kategori" class="w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all">
                    <span class="material-symbols-outlined">category</span> Kategori
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
                        <p class="text-3xl font-extrabold text-[#151613]">3</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Perlu Verifikasi</h3>
                            <span class="material-symbols-outlined text-amber-500 bg-amber-50 p-2 rounded-lg">pending_actions</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">1</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Sedang Proses</h3>
                            <span class="material-symbols-outlined text-blue-500 bg-blue-50 p-2 rounded-lg">autorenew</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">2</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Pengguna Aktif</h3>
                            <span class="material-symbols-outlined text-purple-500 bg-purple-50 p-2 rounded-lg">group</span>
                        </div>
                        <p id="stat-total-users" class="text-3xl font-extrabold text-[#151613]">0</p>
                    </div>
                </div>
            </div>

            <div id="view-laporan" class="space-y-6 hidden"><h3 class="text-2xl font-bold">Menu Laporan Warga</h3></div>
            <div id="view-pengguna" class="space-y-6 hidden"><h3 class="text-2xl font-bold">Daftar Pengguna</h3></div>
            <div id="view-kategori" class="space-y-6 hidden"><h3 class="text-2xl font-bold">Manajemen Kategori</h3></div>

        </div>
    </main>

    <script>
        // Navigasi SPA (Tukar Tampilan)
        function switchMenu(targetView) {
            const menus = ['ringkasan', 'laporan', 'pengguna', 'kategori'];
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
            } else if (targetView === 'kategori') {
                title.innerText = "Kategori Laporan";
                subtitle.innerText = "Atur jenis-jenis pelanggaran yang bisa dilaporkan.";
            }
        }
    </script>
</body>
</html>