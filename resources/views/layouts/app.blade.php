<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Eco-Report - Lapor & Jaga Bumi Kita</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#88976d",
              "primary-dark": "#5e694b",
              "earth-light": "#E7F5DC",
              "background-light": "#E7F5DC",
              "background-dark": "#191b17",
              surface: "#ffffff",
            },
            fontFamily: {
              display: ["Plus Jakarta Sans", "sans-serif"],
              handwriting: ["Indie Flower", "cursive"],
            },
          },
        },
      };
    </script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="relative flex h-auto min-h-screen w-full flex-col bg-earth-light dark:bg-background-dark text-[#151613] dark:text-white font-display overflow-x-hidden selection:bg-primary/30">
    
    <div class="fixed top-3 md:top-6 left-0 right-0 z-50 flex justify-center px-2 md:px-4 w-full pointer-events-none">
      <nav class="bg-white/90 backdrop-blur-md shadow-md pointer-events-auto flex w-full max-w-[960px] items-center justify-between rounded-full px-4 py-2 md:px-6 md:py-3 transition-all hover:shadow-lg hover:bg-white relative border border-white/50">
        
        <div class="flex items-center gap-3">
          <div class="flex items-center justify-center size-10 rounded-full bg-primary/20 text-primary">
            <span class="material-symbols-outlined text-2xl">eco</span>
          </div>
          <h1 class="text-lg font-bold tracking-tight text-[#151613] dark:text-white">Eco-Report</h1>
        </div>

        <div class="hidden md:flex items-center gap-8">
          <a class="text-sm font-medium text-[#151613]/80 hover:text-primary transition-colors" href="{{ url('/') }}">Beranda</a>
          <a class="text-sm font-medium text-[#151613]/80 hover:text-primary transition-colors" href="{{ url('/jelajah') }}">Jelajah</a>
          <a class="text-sm font-medium text-[#151613]/80 hover:text-primary transition-colors" href="{{ url('/lapor') }}">Lapor</a>
        </div>

        <div class="flex items-center gap-4">
          <a href="{{ url('/login') }}" id="loginBtn" class="hidden md:flex text-sm font-bold text-[#151613] hover:text-primary transition-colors">Masuk</a>
          <button id="mobileMenuBtn" class="md:hidden flex items-center justify-center p-2 text-[#151613]">
            <span class="material-symbols-outlined">menu</span>
          </button>
        </div>

        <div id="mobileMenu" class="absolute top-full left-0 right-0 mt-4 bg-white rounded-3xl p-6 shadow-xl border border-neutral-100 hidden flex-col gap-4 md:hidden origin-top transition-all duration-300 transform scale-95 opacity-0">
          <a class="text-lg font-medium text-[#151613] py-2 border-b border-neutral-100" href="{{ url('/') }}">Beranda</a>
          <a class="text-lg font-medium text-[#151613] py-2 border-b border-neutral-100" href="{{ url('/jelajah') }}">Jelajah</a>
          <a class="text-lg font-medium text-[#151613] py-2 border-b border-neutral-100" href="{{ url('/lapor') }}">Lapor</a>
          <a href="{{ url('/login') }}" id="mobileLoginBtn" class="block w-full bg-neutral-100 text-[#151613] font-bold py-3 rounded-xl mt-2 text-center">Masuk / Daftar</a>
        </div>

      </nav>
    </div>

    <div class="layout-container flex h-full grow flex-col pt-16 md:pt-24 px-2 md:px-4 pb-4">
        @yield('content')
    </div>

    <footer class="bg-[#191b17] text-white rounded-[1.5rem] md:rounded-[3rem] mt-4 overflow-hidden relative mx-2 md:mx-4 mb-4">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary/0 via-primary to-primary/0 opacity-50"></div>
        <div class="flex flex-col px-6 py-8 md:py-16 lg:px-24 max-w-[1440px] mx-auto">
          
          <div class="flex flex-col lg:flex-row justify-between gap-8 md:gap-16 pb-8 md:pb-16 border-b border-white/10">
            
            <div class="flex flex-col gap-6 lg:w-1/3">
              <div class="flex items-center gap-3">
                <div class="flex items-center justify-center size-10 rounded-full bg-primary text-white shadow-[0_0_20px_rgba(136,151,109,0.4)]">
                  <span class="material-symbols-outlined text-xl">eco</span>
                </div>
                <h3 class="text-2xl font-bold tracking-tight">Eco-Report</h3>
              </div>
              <p class="text-neutral-400 leading-relaxed max-w-sm text-base">
                Eco-Report adalah platform digital bagi warga untuk melaporkan dampak lingkungan secara langsung. Bersama, kita bangun kesadaran dan dorong kebijakan lingkungan yang lebih adil.
              </p>
              <div class="flex gap-4 mt-2">
                <a class="group flex items-center justify-center size-12 rounded-full bg-white/5 border border-white/10 hover:bg-white hover:text-black transition-all" href="#">
                  <span class="material-symbols-outlined text-lg">public</span>
                </a>
                <a class="group flex items-center justify-center size-12 rounded-full bg-white/5 border border-white/10 hover:bg-white hover:text-black transition-all" href="#">
                  <span class="material-symbols-outlined text-lg">alternate_email</span>
                </a>
                <a class="group flex items-center justify-center size-12 rounded-full bg-white/5 border border-white/10 hover:bg-white hover:text-black transition-all" href="#">
                  <span class="material-symbols-outlined text-lg">rss_feed</span>
                </a>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-x-12 gap-y-8 lg:w-1/3">
              <div class="flex flex-col gap-4">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-2">Jelajahi</h4>
                <a class="text-neutral-400 hover:text-primary hover:translate-x-1 transition-all" href="{{ url('/') }}">Misi Kami</a>
                <a class="text-neutral-400 hover:text-primary hover:translate-x-1 transition-all" href="{{ url('/jelajah') }}">Galeri Dampak</a>
              </div>
              <div class="flex flex-col gap-4">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-2">Dukungan</h4>
                <a class="text-neutral-400 hover:text-primary hover:translate-x-1 transition-all" href="{{ url('/lapor') }}">Ajukan Laporan</a>
                <a class="text-neutral-400 hover:text-primary hover:translate-x-1 transition-all" href="#">Bantuan Hukum</a>
              </div>
            </div>

            <div class="flex flex-col gap-6 lg:w-1/4">
              <h4 class="text-sm font-bold text-white uppercase tracking-wider">Tetap Terhubung</h4>
              <div class="flex flex-col gap-3">
                <p class="text-sm text-neutral-400">Terima peringatan mendesak dan laporan dampak bulanan secara langsung.</p>
                <form class="flex gap-2">
                  <input class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder:text-neutral-500 focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Alamat email" type="email" />
                  <button class="bg-primary text-white rounded-xl px-4 py-3 hover:bg-primary-dark transition-colors" type="submit">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </button>
                </form>
              </div>
            </div>

          </div>

          <div class="flex flex-col md:flex-row justify-between items-center pt-10 text-xs font-medium text-neutral-500 gap-6">
            <div class="flex flex-wrap gap-8">
              <a class="hover:text-white transition-colors" href="#">Kebijakan Privasi</a>
              <a class="hover:text-white transition-colors" href="#">Ketentuan Layanan</a>
            </div>
            <div class="flex gap-2 items-center px-4 py-2 rounded-full bg-white/5 border border-white/5">
              <div class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
              </div>
              <span class="text-green-500">Sistem Beroperasi</span>
              <span class="mx-2 text-neutral-700">|</span>
              <span>© 2026 Eco-Report</span>
            </div>
          </div>

        </div>
    </footer>

    <div id="authModal" class="fixed inset-0 z-[100] flex items-center justify-center px-4 opacity-0 pointer-events-none transition-opacity duration-300"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const user = JSON.parse(localStorage.getItem("eco_current_user"));
            const loginBtn = document.getElementById("loginBtn");
            const mobileLoginBtn = document.getElementById("mobileLoginBtn");

            if (user) {
                if (loginBtn) {
                    loginBtn.innerHTML = `<span class="material-symbols-outlined mr-1">account_circle</span> ${user.name}`;
                    loginBtn.href = "#";
                    loginBtn.onclick = (e) => {
                        e.preventDefault();
                        if(confirm(`Halo ${user.name}, yakin ingin keluar dari akun?`)) {
                            localStorage.removeItem("eco_current_user");
                            window.location.reload();
                        }
                    };
                }
                if (mobileLoginBtn) {
                    mobileLoginBtn.innerHTML = `<span class="material-symbols-outlined align-middle mr-1">logout</span> Keluar (${user.name})`;
                    mobileLoginBtn.href = "#";
                    mobileLoginBtn.onclick = (e) => {
                        e.preventDefault();
                        localStorage.removeItem("eco_current_user");
                        window.location.reload();
                    };
                }
            }
        });
    </script>
</body>
</html>
</body>
</html>