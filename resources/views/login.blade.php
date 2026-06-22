<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Masuk / Daftar - Eco-Report</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: "#88976d", "primary-dark": "#5e694b", "earth-light": "#E7F5DC" },
            fontFamily: { display: ["Plus Jakarta Sans", "sans-serif"] },
          },
        },
      };
    </script>
</head>
<body class="relative flex h-screen w-full items-center justify-center bg-earth-light text-[#151613] font-display overflow-hidden selection:bg-primary/30">
    
    @if($errors->any())
    <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 animate-bounce">
        {{ $errors->first() }}
    </div>
    @endif

    <a href="{{ url('/') }}" class="absolute top-6 left-6 md:top-10 md:left-10 flex items-center gap-2 text-[#151613] font-bold hover:text-primary transition-colors z-50 group">
        <span class="material-symbols-outlined text-xl transition-transform group-hover:-translate-x-1">arrow_back</span>
        Kembali
    </a>

    <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-30 -z-10">
        <div class="absolute top-20 right-20 w-96 h-96 bg-primary/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-20 left-20 w-80 h-80 bg-orange-100/40 rounded-full blur-[80px]"></div>
    </div>

    <div class="bg-white w-full max-w-[460px] rounded-[2.5rem] p-8 md:p-12 shadow-2xl border border-neutral-100 relative z-10 mx-4 overflow-hidden">
        
        <div id="loginSection" class="transition-all duration-300 transform translate-x-0">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#151613] mb-2 tracking-tight">Selamat Datang</h2>
                <p class="text-neutral-500 font-medium">Masuk untuk melanjutkan aksi nyata.</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-bold text-[#151613] ml-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Anda" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required />
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-[#151613] ml-1">Password</label>
                    <div class="relative">
                        <input id="loginPassword" type="password" name="password" placeholder="••••••••" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required />
                        <button type="button" onclick="togglePasswordVisibility('loginPassword', 'loginPasswordIcon')" class="absolute right-5 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-primary transition-colors">
                            <span id="loginPasswordIcon" class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-white font-bold h-14 md:h-16 rounded-full shadow-lg shadow-primary/30 hover:bg-primary-dark transition-all transform active:scale-95 mt-4 text-base md:text-lg">
                    Masuk Sekarang
                </button>
            </form>

            <p class="text-center mt-8 text-sm font-medium text-neutral-500">
                Belum punya akun? <button type="button" onclick="switchView('register')" class="text-primary font-bold hover:underline outline-none">Daftar Gratis</button>
            </p>
        </div>

        <div id="registerSection" class="hidden transition-all duration-300 transform translate-x-8 opacity-0">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-[#151613] mb-2 tracking-tight">Buat Akun</h2>
                <p class="text-neutral-500 font-medium text-sm">Bergabunglah untuk menjaga bumi kita.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="text-sm font-bold text-[#151613] ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Anda" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required />
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-bold text-[#151613] ml-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Anda" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required />
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-bold text-[#151613] ml-1">Password</label>
                    <div class="relative">
                        <input id="regPassword" type="password" name="password" placeholder="Buat sandi yang kuat" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required minlength="6" />
                        <button type="button" onclick="togglePasswordVisibility('regPassword', 'regPasswordIcon')" class="absolute right-5 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-primary transition-colors">
                            <span id="regPasswordIcon" class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#151613] text-white font-bold h-14 rounded-full shadow-lg hover:bg-black transition-all transform active:scale-95 mt-6 text-base">
                    Daftar & Masuk
                </button>
            </form>

            <p class="text-center mt-6 text-sm font-medium text-neutral-500">
                Sudah punya akun? <button type="button" onclick="switchView('login')" class="text-primary font-bold hover:underline outline-none">Masuk di sini</button>
            </p>
        </div>

    </div>

    <script>
        // Fungsi Animasi Pindah Layar (Login <-> Register)
        function switchView(view) {
            const loginSec = document.getElementById("loginSection");
            const regSec = document.getElementById("registerSection");

            if (view === 'register') {
                loginSec.classList.add("hidden");
                loginSec.classList.remove("translate-x-0", "opacity-100");
                
                regSec.classList.remove("hidden");
                setTimeout(() => {
                    regSec.classList.remove("translate-x-8", "opacity-0");
                    regSec.classList.add("translate-x-0", "opacity-100");
                }, 10);
            } else {
                regSec.classList.add("hidden");
                regSec.classList.remove("translate-x-0", "opacity-100");
                regSec.classList.add("translate-x-8", "opacity-0");
                
                loginSec.classList.remove("hidden");
                setTimeout(() => {
                    loginSec.classList.add("translate-x-0", "opacity-100");
                }, 10);
            }
        }

        // Fungsi Lihat Password Dinamis
        function togglePasswordVisibility(inputId, iconId) {
            const pwd = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (pwd.type === "password") {
                pwd.type = "text";
                icon.innerText = "visibility_off";
            } else {
                pwd.type = "password";
                icon.innerText = "visibility";
            }
        }
    </script>
</body>
</html>