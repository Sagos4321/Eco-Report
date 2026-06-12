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

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 bg-white border-r border-neutral-200 flex flex-col justify-between hidden md:flex z-20">
        <div>
            <!-- Logo Admin -->
            <div class="h-20 flex items-center gap-3 px-6 border-b border-neutral-100">
                <div class="flex items-center justify-center size-8 rounded-full bg-primary/20 text-primary">
                    <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                </div>
                <h1 class="font-extrabold text-lg tracking-tight">Eco-Admin</h1>
            </div>
            
            <!-- Menu Navigasi Interaktif -->
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
        
        <!-- Tombol Keluar -->
        <div class="p-4 border-t border-neutral-100">
            <button onclick="logoutAdmin(event)" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-colors">
                <span class="material-symbols-outlined">logout</span> Keluar Dasbor
            </button>
        </div>
    </aside>

    <!-- AREA KONTEN UTAMA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <!-- Topbar -->
        <header class="h-20 bg-white border-b border-neutral-200 flex items-center justify-between px-6 md:px-10 shrink-0 z-10">
            <div>
                <h2 id="topbar-title" class="text-xl font-bold text-[#151613]">Dasbor Pusat</h2>
                <p id="topbar-subtitle" class="text-sm text-neutral-500">Pantau dan kelola aksi lingkungan hari ini.</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="hidden md:flex items-center gap-2 bg-neutral-100 hover:bg-neutral-200 text-[#151613] px-4 py-2 rounded-lg font-bold text-sm transition-colors">
                    <span class="material-symbols-outlined text-sm">download</span> Ekspor Data
                </button>
                <div class="h-10 w-10 rounded-full border-2 border-primary bg-neutral-200 overflow-hidden">
                    <img src="https://api.dicebear.com/7.x/bottts/svg?seed=Admin" alt="Admin">
                </div>
            </div>
        </header>

        <!-- KONTEN YANG BISA DI-SCROLL -->
        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            
            <!-- ================= VIEW 1: RINGKASAN ================= -->
            <div id="view-ringkasan" class="space-y-8 block">
                <!-- Statistik Kartu -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Total Laporan</h3>
                            <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-lg">description</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">3</p>
                        <p class="text-xs text-green-500 font-bold mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">trending_up</span> Laporan bulan ini</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Perlu Verifikasi</h3>
                            <span class="material-symbols-outlined text-amber-500 bg-amber-50 p-2 rounded-lg">pending_actions</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">1</p>
                        <p class="text-xs text-amber-500 font-bold mt-2">Menunggu tindakan admin</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Sedang Proses</h3>
                            <span class="material-symbols-outlined text-blue-500 bg-blue-50 p-2 rounded-lg">autorenew</span>
                        </div>
                        <p class="text-3xl font-extrabold text-[#151613]">2</p>
                        <p class="text-xs text-neutral-400 mt-2">Diteruskan & Diselidiki</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-neutral-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-neutral-500 font-medium text-sm">Pengguna Aktif</h3>
                            <span class="material-symbols-outlined text-purple-500 bg-purple-50 p-2 rounded-lg">group</span>
                        </div>
                        <p id="stat-total-users" class="text-3xl font-extrabold text-[#151613]">0</p>
                        <p class="text-xs text-neutral-400 mt-2">Total relawan terdaftar</p>
                    </div>
                </div>

                <!-- Tabel Antrean Verifikasi -->
                <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                    <div class="p-6 border-b border-neutral-100 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-[#151613]">Antrean Verifikasi Laporan Prioritas</h3>
                        <button onclick="switchMenu('laporan')" class="text-sm font-bold text-primary hover:underline">Lihat Semua Laporan</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-neutral-50 text-neutral-500 text-xs uppercase tracking-wider">
                                    <th class="p-4 font-bold">ID</th>
                                    <th class="p-4 font-bold">Pelapor</th>
                                    <th class="p-4 font-bold">Kasus / Lokasi</th>
                                    <th class="p-4 font-bold">Status</th>
                                    <th class="p-4 font-bold text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100">
                                <tr class="hover:bg-neutral-50 transition-colors" id="row-1">
                                    <td class="p-4 font-medium text-sm text-neutral-500">#RPT-001</td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-full bg-neutral-200"></div>
                                            <div><p class="text-sm font-bold">Anonim</p><p class="text-xs text-neutral-400">12 menit lalu</p></div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <p class="text-sm font-bold text-[#151613]">Pembabatan Hutan</p>
                                        <span class="text-xs text-neutral-500">Boven Digoel, Papua</span>
                                    </td>
                                    <td class="p-4">
                                        <span id="badge-1" class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-bold border border-amber-200">Menunggu</span>
                                    </td>
                                    <td class="p-4 flex items-center justify-center gap-2">
                                        <button onclick="approveReport(1)" class="p-2 bg-green-100 text-green-600 hover:bg-green-500 hover:text-white rounded-lg transition-colors tooltip" title="Setujui">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </button>
                                        <button onclick="rejectReport(1)" class="p-2 bg-red-100 text-red-600 hover:bg-red-500 hover:text-white rounded-lg transition-colors tooltip" title="Tolak">
                                            <span class="material-symbols-outlined text-sm">close</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================= VIEW 2: KELOLA LAPORAN ================= -->
            <div id="view-laporan" class="space-y-6 hidden">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <h3 class="text-2xl font-bold text-[#151613]">Semua Laporan Warga</h3>
                    <div class="flex gap-2">
                        <select class="bg-white border border-neutral-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary outline-none">
                            <option>Semua Status</option>
                            <option>Menunggu Verifikasi</option>
                            <option>Sedang Diselidiki</option>
                            <option>Selesai</option>
                        </select>
                        <div class="relative w-full md:w-64">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400 text-sm">search</span>
                            <input type="text" placeholder="Cari kasus..." class="w-full bg-white border border-neutral-200 rounded-xl pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-primary outline-none">
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-neutral-50 text-neutral-500 text-xs uppercase tracking-wider">
                                <th class="p-4 font-bold">Judul Kasus</th>
                                <th class="p-4 font-bold">Kategori</th>
                                <th class="p-4 font-bold">Pelapor</th>
                                <th class="p-4 font-bold">Status Terkini</th>
                                <th class="p-4 font-bold text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            <!-- Laporan 1 -->
                            <tr class="hover:bg-neutral-50">
                                <td class="p-4"><p class="text-sm font-bold text-[#151613]">Pembabatan Hutan Papua</p><p class="text-xs text-neutral-500">Boven Digoel</p></td>
                                <td class="p-4"><span class="px-2 py-1 bg-red-50 text-red-600 rounded text-xs font-bold">Penebangan Liar</span></td>
                                <td class="p-4 text-sm font-medium">Anonim</td>
                                <td class="p-4"><span class="px-3 py-1 bg-amber-50 text-amber-600 text-xs font-bold border border-amber-200 rounded-full">Menunggu</span></td>
                                <td class="p-4 text-center"><button class="text-primary hover:underline text-sm font-bold">Tinjau</button></td>
                            </tr>
                            <!-- Laporan 2 -->
                            <tr class="hover:bg-neutral-50">
                                <td class="p-4"><p class="text-sm font-bold text-[#151613]">Darurat Sampah Pantai</p><p class="text-xs text-neutral-500">Teluk Labuan, Banten</p></td>
                                <td class="p-4"><span class="px-2 py-1 bg-amber-50 text-amber-600 rounded text-xs font-bold">Polusi / Limbah</span></td>
                                <td class="p-4 text-sm font-medium">WargaPesisir</td>
                                <td class="p-4"><span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold border border-blue-200 rounded-full">Sedang Diselidiki</span></td>
                                <td class="p-4 text-center"><button class="text-primary hover:underline text-sm font-bold">Tinjau</button></td>
                            </tr>
                            <!-- Laporan 3 -->
                            <tr class="hover:bg-neutral-50">
                                <td class="p-4"><p class="text-sm font-bold text-[#151613]">Polusi Asap Hitam Pekat</p><p class="text-xs text-neutral-500">Kawasan Industri, Riau</p></td>
                                <td class="p-4"><span class="px-2 py-1 bg-amber-50 text-amber-600 rounded text-xs font-bold">Polusi / Limbah</span></td>
                                <td class="p-4 text-sm font-medium">PejuangNapas</td>
                                <td class="p-4"><span class="px-3 py-1 bg-purple-50 text-purple-600 text-xs font-bold border border-purple-200 rounded-full">Diteruskan ke KLHK</span></td>
                                <td class="p-4 text-center"><button class="text-primary hover:underline text-sm font-bold">Tinjau</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= VIEW 3: MANAJEMEN PENGGUNA ================= -->
            <div id="view-pengguna" class="space-y-6 hidden">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <h3 class="text-2xl font-bold text-[#151613]">Daftar Pengguna Terdaftar</h3>
                    <div class="relative w-full md:w-64">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400 text-sm">search</span>
                        <input type="text" placeholder="Cari nama atau email..." class="w-full bg-white border border-neutral-200 rounded-xl pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-primary outline-none">
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-neutral-50 text-neutral-500 text-xs uppercase tracking-wider">
                                    <th class="p-4 font-bold">No</th>
                                    <th class="p-4 font-bold">Profil / Nama</th>
                                    <th class="p-4 font-bold">Email</th>
                                    <th class="p-4 font-bold">Peran (Role)</th>
                                    <th class="p-4 font-bold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody" class="divide-y divide-neutral-100">
                                <!-- Data Pengguna Otomatis -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================= VIEW 4: KATEGORI ================= -->
            <div id="view-kategori" class="space-y-6 hidden">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <h3 class="text-2xl font-bold text-[#151613]">Manajemen Kategori Kasus</h3>
                    <button class="bg-[#151613] text-white px-5 py-2 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-black transition-colors">
                        <span class="material-symbols-outlined text-sm">add</span> Tambah Kategori
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Kategori 1 -->
                    <div class="bg-white p-6 rounded-2xl border border-neutral-200 flex flex-col items-center text-center hover:shadow-lg transition-shadow">
                        <span class="material-symbols-outlined text-4xl text-red-500 mb-3 bg-red-50 p-4 rounded-full">forest</span>
                        <h4 class="font-bold text-lg text-[#151613]">Penebangan Liar</h4>
                        <p class="text-sm text-neutral-500 mb-4 mt-1">Laporan terkait deforestasi dan pembalakan liar.</p>
                        <button class="text-primary font-bold text-sm hover:underline">Edit Kategori</button>
                    </div>
                    <!-- Kategori 2 -->
                    <div class="bg-white p-6 rounded-2xl border border-neutral-200 flex flex-col items-center text-center hover:shadow-lg transition-shadow">
                        <span class="material-symbols-outlined text-4xl text-amber-500 mb-3 bg-amber-50 p-4 rounded-full">factory</span>
                        <h4 class="font-bold text-lg text-[#151613]">Polusi / Limbah</h4>
                        <p class="text-sm text-neutral-500 mb-4 mt-1">Laporan pencemaran air, udara, dan sampah laut.</p>
                        <button class="text-primary font-bold text-sm hover:underline">Edit Kategori</button>
                    </div>
                    <!-- Kategori 3 -->
                    <div class="bg-white p-6 rounded-2xl border border-neutral-200 flex flex-col items-center text-center hover:shadow-lg transition-shadow">
                        <span class="material-symbols-outlined text-4xl text-blue-500 mb-3 bg-blue-50 p-4 rounded-full">pets</span>
                        <h4 class="font-bold text-lg text-[#151613]">Perdagangan Satwa</h4>
                        <p class="text-sm text-neutral-500 mb-4 mt-1">Eksploitasi dan perburuan satwa langka.</p>
                        <button class="text-primary font-bold text-sm hover:underline">Edit Kategori</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- SCRIPT LOGIKA DASBOR -->
    <script>
        // 1. Cek Keamanan
        const currentUser = JSON.parse(localStorage.getItem("eco_current_user"));
        if (!currentUser || currentUser.role !== "admin") {
            window.location.href = "{{ url('/login') }}";
        }

        // 2. Navigasi SPA (Tukar Tampilan)
        function switchMenu(targetView) {
            // Sembunyikan semua konten dan matikan warna tombol
            const menus = ['ringkasan', 'laporan', 'pengguna', 'kategori'];
            menus.forEach(menu => {
                document.getElementById(`menu-${menu}`).className = "w-full flex items-center gap-3 px-4 py-3 text-neutral-500 hover:bg-neutral-50 hover:text-[#151613] rounded-xl font-medium transition-all";
                document.getElementById(`view-${menu}`).classList.add("hidden");
            });

            // Aktifkan tombol yang diklik (Warna hijau)
            document.getElementById(`menu-${targetView}`).className = "w-full flex items-center gap-3 px-4 py-3 bg-primary text-white rounded-xl font-bold shadow-md shadow-primary/20 transition-all";
            // Tampilkan view yang dituju
            document.getElementById(`view-${targetView}`).classList.remove("hidden");

            // Ubah Judul Topbar
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

        // 3. Muat Data Pengguna ke Tabel & Statistik
        function loadUsersData() {
            const users = JSON.parse(localStorage.getItem("eco_users") || "[]");
            const tbody = document.getElementById("userTableBody");
            
            // Update Angka di Ringkasan
            document.getElementById("stat-total-users").innerText = users.length;

            tbody.innerHTML = "";
            users.forEach((user, index) => {
                let roleBadge = user.role === "admin" 
                    ? `<span class="px-3 py-1 bg-primary/20 text-primary-dark font-bold text-xs rounded-full">Administrator</span>`
                    : `<span class="px-3 py-1 bg-blue-50 text-blue-600 font-bold border border-blue-200 text-xs rounded-full">Warga (Relawan)</span>`;

                tbody.innerHTML += `
                    <tr class="hover:bg-neutral-50 transition-colors">
                        <td class="p-4 font-medium text-sm text-neutral-500">${index + 1}</td>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded-full bg-neutral-200 flex items-center justify-center font-bold text-[#151613]">
                                    ${user.name.charAt(0).toUpperCase()}
                                </div>
                                <p class="text-sm font-bold text-[#151613]">${user.name}</p>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-neutral-600">${user.email}</td>
                        <td class="p-4">${roleBadge}</td>
                        <td class="p-4 flex items-center justify-center">
                            <button class="p-2 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white rounded-lg transition-colors tooltip" title="Blokir">
                                <span class="material-symbols-outlined text-sm">block</span>
                            </button>
                        </td>
                    </tr>
                `;
            });
        }

        // Panggil saat pertama kali load
        document.addEventListener("DOMContentLoaded", loadUsersData);

        // 4. Simulasi Setujui/Tolak
        function approveReport(id) {
            const badge = document.getElementById(`badge-${id}`);
            badge.className = "px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-bold border border-green-200";
            badge.innerText = "Disetujui";
        }
        function rejectReport(id) {
            const badge = document.getElementById(`badge-${id}`);
            badge.className = "px-3 py-1 rounded-full bg-red-50 text-red-600 text-xs font-bold border border-red-200";
            badge.innerText = "Ditolak";
        }

        // 5. Logout
        function logoutAdmin(event) {
            event.preventDefault();
            if(confirm("Yakin ingin keluar dari Dasbor Admin?")) {
                localStorage.removeItem("eco_current_user");
                window.location.href = "{{ url('/') }}";
            }
        }
    </script>
</body>
</html>