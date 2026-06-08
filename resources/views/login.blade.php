<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Masuk - Eco-Report</title>
    
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

    <div class="bg-white w-full max-w-[460px] rounded-[2.5rem] p-8 md:p-12 shadow-2xl border border-neutral-100 relative z-10 mx-4">
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
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute right-5 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-primary transition-colors">
                        <span id="passwordIcon" class="material-symbols-outlined">visibility</span>
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
    </div>

    <script>
        // 1. Buat Akun Dummy Otomatis
        if (!localStorage.getItem("eco_users")) {
            localStorage.setItem("eco_users", JSON.stringify([{ name: "Ulya", email: "admin@gmail.com", password: "password" }]));
        }

        // 2. Fungsi Lihat Password
        function togglePasswordVisibility() {
            const pwd = document.getElementById("loginPassword");
            const icon = document.getElementById("passwordIcon");
            if (pwd.type === "password") {
                pwd.type = "text";
                icon.innerText = "visibility_off";
            } else {
                pwd.type = "password";
                icon.innerText = "visibility";
            }
        }

        // 3. Fungsi Logika Login
        function prosesLogin(event) {
            event.preventDefault(); // Cegah halaman reload!

            const email = document.getElementById("loginEmail").value;
            const password = document.getElementById("loginPassword").value;
            const btn = event.target.querySelector("button[type='submit']");
            const errorMsg = document.getElementById("loginErrorMsg");

            // Munculkan tulisan loading
            const textAwal = btn.innerHTML;
            btn.innerHTML = "Memeriksa...";
            btn.disabled = true;
            errorMsg.classList.add("hidden");

            setTimeout(() => {
                const users = JSON.parse(localStorage.getItem("eco_users") || "[]");
                const user = users.find(u => u.email === email && u.password === password);

                if (user) {
                    // Kalau Berhasil
                    localStorage.setItem("eco_current_user", JSON.stringify(user));
                    btn.innerHTML = "Berhasil! Mengalihkan...";
                    window.location.href = "{{ url('/') }}"; // Pindah ke Beranda
                } else {
                    // Kalau Gagal
                    btn.innerHTML = textAwal;
                    btn.disabled = false;
                    errorMsg.classList.remove("hidden");
                }
            }, 800);
        }
    </script>
</body>
</html>