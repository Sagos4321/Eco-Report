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

            <form class="space-y-6" onsubmit="prosesLogin(event)">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-[#151613] ml-1">Email</label>
                    <input id="loginEmail" type="email" placeholder="Email Anda" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required />
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-[#151613] ml-1">Password</label>
                    <div class="relative">
                        <input id="loginPassword" type="password" placeholder="••••••••" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required />
                        <button type="button" onclick="togglePasswordVisibility('loginPassword', 'loginPasswordIcon')" class="absolute right-5 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-primary transition-colors">
                            <span id="loginPasswordIcon" class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                    <p id="loginErrorMsg" class="hidden text-red-500 text-xs font-bold ml-1 mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">error</span> Email atau password salah!
                    </p>
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

            <form class="space-y-4" onsubmit="prosesDaftar(event)">
                <div class="space-y-1">
                    <label class="text-sm font-bold text-[#151613] ml-1">Nama Lengkap</label>
                    <input id="regName" type="text" placeholder="Nama Anda" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required />
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-bold text-[#151613] ml-1">Email</label>
                    <input id="regEmail" type="email" placeholder="Email Anda" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required />
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-bold text-[#151613] ml-1">Password</label>
                    <div class="relative">
                        <input id="regPassword" type="password" placeholder="Buat sandi yang kuat" class="w-full bg-neutral-50 border border-neutral-100 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all" required minlength="6" />
                        <button type="button" onclick="togglePasswordVisibility('regPassword', 'regPasswordIcon')" class="absolute right-5 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-primary transition-colors">
                            <span id="regPasswordIcon" class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                    <p id="regErrorMsg" class="hidden text-red-500 text-xs font-bold ml-1 mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">error</span> Email ini sudah terdaftar!
                    </p>
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
        // 1. Buat Akun Dummy Otomatis (Langsung timpa data lama)
        const defaultUsers = [
            { name: "Ulya", email: "ulya@gmail.com", password: "password", role: "user" },
            { name: "Administrator", email: "admin@eco-report.com", password: "admin123", role: "admin" }
        ];
        
        // Cek jika database kosong, baru tanam akun default
        if (!localStorage.getItem("eco_users")) {
            localStorage.setItem("eco_users", JSON.stringify(defaultUsers));
        }

        // 2. Fungsi Animasi Pindah Layar (Login <-> Register)
        function switchView(view) {
            const loginSec = document.getElementById("loginSection");
            const regSec = document.getElementById("registerSection");

            if (view === 'register') {
                loginSec.classList.add("hidden");
                loginSec.classList.remove("translate-x-0", "opacity-100");
                
                regSec.classList.remove("hidden");
                // Sedikit delay agar animasi tailwind jalan
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

        // 3. Fungsi Lihat Password Dinamis (Bisa untuk Login & Register)
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

        // 4. Fungsi Proses Login
        function prosesLogin(event) {
            event.preventDefault();
            const email = document.getElementById("loginEmail").value;
            const password = document.getElementById("loginPassword").value;
            const btn = event.target.querySelector("button[type='submit']");
            const errorMsg = document.getElementById("loginErrorMsg");

            const textAwal = btn.innerHTML;
            btn.innerHTML = "Memeriksa...";
            btn.disabled = true;
            errorMsg.classList.add("hidden");

            setTimeout(() => {
                const users = JSON.parse(localStorage.getItem("eco_users") || "[]");
                const user = users.find(u => u.email === email && u.password === password);

                if (user) {
                    localStorage.setItem("eco_current_user", JSON.stringify(user));
                    if (user.role === "admin" || user.email === "admin@eco-report.com") {
                        btn.innerHTML = "Halo Admin! Mengalihkan...";
                        window.location.href = "{{ url('/admin') }}";
                    } else {
                        btn.innerHTML = "Berhasil!";
                        window.location.href = "{{ url('/') }}";
                    }
                } else {
                    btn.innerHTML = textAwal;
                    btn.disabled = false;
                    errorMsg.classList.remove("hidden");
                }
            }, 800);
        }

        // 5. Fungsi Proses Daftar
        function prosesDaftar(event) {
            event.preventDefault();
            const name = document.getElementById("regName").value;
            const email = document.getElementById("regEmail").value;
            const password = document.getElementById("regPassword").value;
            const btn = event.target.querySelector("button[type='submit']");
            const errorMsg = document.getElementById("regErrorMsg");

            const textAwal = btn.innerHTML;
            btn.innerHTML = "Membuat Akun...";
            btn.disabled = true;
            errorMsg.classList.add("hidden");

            setTimeout(() => {
                const users = JSON.parse(localStorage.getItem("eco_users") || "[]");
                
                // Cek apakah email sudah dipakai
                const emailExists = users.some(u => u.email === email);

                if (emailExists) {
                    btn.innerHTML = textAwal;
                    btn.disabled = false;
                    errorMsg.classList.remove("hidden");
                } else {
                    // Buat akun baru dengan role "user"
                    const newUser = { name: name, email: email, password: password, role: "user" };
                    users.push(newUser);
                    localStorage.setItem("eco_users", JSON.stringify(users));
                    
                    // Langsung Login-kan user baru tersebut
                    localStorage.setItem("eco_current_user", JSON.stringify(newUser));
                    
                    btn.innerHTML = "Sukses! Mengalihkan...";
                    window.location.href = "{{ url('/') }}";
                }
            }, 800);
        }
    </script>
</body>
</html>