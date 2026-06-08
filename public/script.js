const API_KEY = "";

const AVATARS = [
  "https://api.dicebear.com/7.x/bottts/svg?seed=Felix",
  "https://api.dicebear.com/7.x/bottts/svg?seed=Aria",
  "https://api.dicebear.com/7.x/bottts/svg?seed=Luna",
  "https://api.dicebear.com/7.x/bottts/svg?seed=Milo",
];

// --- STATE MANAGEMENT DENGAN LOCALSTORAGE ---
// --- STATE MANAGEMENT DENGAN LOCALSTORAGE ---
const DEFAULT_REPORTS = [
  {
    id: "1",
    title: "Pembabatan Hutan Terselubung",
    description: "Ditemukan aktivitas alat berat dan penebangan liar di area yang seharusnya menjadi zona hijau konservasi. Diduga kuat untuk pembukaan lahan tambang ilegal yang akan mengancam ekosistem warga lokal.",
    imageUrl: "/images/raja-ampat.jpeg",
    location: "Raja Ampat, Papua",
    userId: "u1",
    userName: "Anonim",
    userAvatar: "https://api.dicebear.com/7.x/bottts/svg?seed=Anon",
    createdAt: new Date().toISOString(),
    category: "Penebangan Liar",
    status: "Menunggu Verifikasi",
    likes: 842,
    comments: [],
  },
  {
    id: "2",
    title: "Darurat Sampah Pantai",
    description: "Kondisi sangat parah. Tumpukan sampah plastik, limbah rumah tangga, hingga limbah medis menutupi hampir seluruh bibir pantai. Bau menyengat dan mencemari air laut, mengancam biota laut dan kesehatan warga sekitar pesisir.",
    imageUrl: "/images/pantai-kotor.jpeg",
    userId: "u2",
    userName: "WargaPesisir",
    userAvatar: AVATARS[1],
    createdAt: new Date(Date.now() - 86400000).toISOString(),
    category: "Polusi / Pembuangan Limbah",
    status: "Sedang Diselidiki",
    likes: 1250,
    comments: [],
  },
  {
    id: "3",
    title: "Polusi Asap Hitam Pekat",
    description: "Sudah tiga hari berturut-turut cerobong asap dari kilang minyak di kawasan industri mengeluarkan asap hitam pekat dan debu beracun. Jarak pandang menurun dan banyak warga mulai mengeluh sesak napas (ISPA).",
    imageUrl: "/images/cerobong-asap.jpg",
    location: "Kawasan Industri, Riau",
    userId: "u3",
    userName: "PejuangNapas",
    userAvatar: AVATARS[3],
    createdAt: new Date(Date.now() - 172800000).toISOString(),
    category: "Polusi / Pembuangan Limbah",
    status: "Diteruskan ke KLHK",
    likes: 3410,
    comments: [],
  }
];

function loadState() {
  const saved = localStorage.getItem("ecoState");
  let parsed = {
    reports: [...DEFAULT_REPORTS],
  };

  if (saved) {
    try {
      const savedState = JSON.parse(saved);
      parsed = { ...parsed, ...savedState };

      // Pastikan data default tidak hilang
      DEFAULT_REPORTS.forEach((defReport) => {
        const exists = parsed.reports.find((r) => r.id === defReport.id);
        if (!exists) {
          parsed.reports.push(defReport);
        }
      });
    } catch (e) {
      console.error("Gagal memuat state", e);
    }
  }
  return parsed;
}

function saveState() {
  localStorage.setItem("ecoState", JSON.stringify(state));
}

const state = loadState();

// --- UTILITIES ---
function timeAgo(dateString) {
  const date = new Date(dateString);
  const now = new Date();
  const seconds = Math.floor((now - date) / 1000);

  let interval = seconds / 31536000;
  if (interval > 1) return Math.floor(interval) + " tahun lalu";
  interval = seconds / 2592000;
  if (interval > 1) return Math.floor(interval) + " bulan lalu";
  interval = seconds / 86400;
  if (interval > 1) return Math.floor(interval) + " hari lalu";
  interval = seconds / 3600;
  if (interval > 1) return Math.floor(interval) + " jam lalu";
  interval = seconds / 60;
  if (interval > 1) return Math.floor(interval) + " menit lalu";
  return "Baru saja";
}

function showToast(message) {
  let container = document.getElementById("toast-container");
  if (!container) {
    container = document.createElement("div");
    container.id = "toast-container";
    container.className = "fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] flex flex-col gap-2";
    document.body.appendChild(container);
  }

  const toast = document.createElement("div");
  toast.className = "bg-[#151613] text-white px-6 py-3 rounded-full shadow-2xl flex items-center gap-3 text-sm font-medium transform transition-all duration-300 translate-y-10 opacity-0";
  toast.innerHTML = `<span class="material-symbols-outlined text-green-400 text-lg">check_circle</span> ${message}`;
  
  container.appendChild(toast);

  // Animasi Masuk
  setTimeout(() => {
    toast.classList.remove("translate-y-10", "opacity-0");
  }, 10);

  // Animasi Keluar
  setTimeout(() => {
    toast.classList.add("opacity-0", "-translate-y-4");
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

// --- FUNGSI AUTENTIKASI ---
const getUsers = () => JSON.parse(localStorage.getItem("eco_users") || "[]");
const saveUserToDB = (user) => {
  const users = getUsers();
  users.push(user);
  localStorage.setItem("eco_users", JSON.stringify(users));
};
const setCurrentUser = (user) => {
  localStorage.setItem("eco_current_user", JSON.stringify(user));
  updateAuthUI(user);
};
const getCurrentUser = () => JSON.parse(localStorage.getItem("eco_current_user"));
const logout = () => {
  localStorage.removeItem("eco_current_user");
  updateAuthUI(null);
  showToast("Anda telah keluar.");
};

function updateAuthUI(user) {
  const desktopLoginBtn = document.getElementById("loginBtn");
  const mobileLoginBtn = document.getElementById("mobileLoginBtn");

  if (user) {
    if (desktopLoginBtn) {
      desktopLoginBtn.innerHTML = `<span class="material-symbols-outlined mr-1">account_circle</span> ${user.name}`;
      desktopLoginBtn.href = "#"; 
      desktopLoginBtn.onclick = (e) => {
        e.preventDefault();
        if (confirm(`Halo ${user.name}, ingin keluar akun?`)) {
            logout();
            window.location.reload(); 
        }
      };
    }
    if (mobileLoginBtn) {
      mobileLoginBtn.innerHTML = `<span class="material-symbols-outlined align-middle mr-1">logout</span> Keluar (${user.name})`;
      mobileLoginBtn.href = "#";
      mobileLoginBtn.onclick = (e) => {
        e.preventDefault();
        logout();
        window.location.reload();
      };
    }
  } else {
    // Jika belum login, tombol tetap mengarah ke halaman /login (diatur di HTML)
    if (desktopLoginBtn) {
      desktopLoginBtn.innerText = "Masuk";
      desktopLoginBtn.onclick = null; 
    }
    if (mobileLoginBtn) {
      mobileLoginBtn.innerText = "Masuk / Daftar";
      mobileLoginBtn.onclick = null;
    }
  }
}

// --- FITUR PASSWORD VISIBILITY (MATA) ---
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('loginPassword');
    const passwordIcon = document.getElementById('passwordIcon');
    
    if (passwordInput && passwordIcon) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.textContent = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            passwordIcon.textContent = 'visibility';
        }
    }
}

// --- FUNGSI SUBMIT LAPORAN ---
function handleStaticReportSubmit(e) {
  e.preventDefault();
  const type = document.getElementById("incident-type").value;
  const location = document.getElementById("location").value;
  const desc = document.getElementById("description").value;
  
  if (!location || !desc || type === "Pilih tipe...") {
    showToast("Mohon lengkapi kategori, lokasi, dan deskripsi.");
    return;
  }

  const btn = e.target.querySelector('button[type="submit"]');
  const originalText = btn.innerHTML;
  btn.innerHTML = `<span class="animate-spin material-symbols-outlined">refresh</span> Mengirim...`;
  btn.disabled = true;

  setTimeout(() => {
    try {
      e.target.reset();
      const anonCheckbox = document.getElementById("isAnonymous");
      if (anonCheckbox) anonCheckbox.checked = false;
      showToast("Laporan berhasil dikirim! Terima kasih atas kontribusinya.");
    } catch (error) {
      console.error("Error submitting report:", error);
      showToast("Terjadi kesalahan saat mengirim laporan.");
    } finally {
      btn.innerHTML = originalText;
      btn.disabled = false;
    }
  }, 1500);
}


// --- EVENT LISTENERS SAAT HALAMAN DIMUAT ---
document.addEventListener("DOMContentLoaded", () => {
  
  // 1. Cek sesi login saat halaman dimuat
  const sessionUser = getCurrentUser();
  updateAuthUI(sessionUser);

  // 2. Menu Mobile Hamburger
  const mobileMenuBtn = document.getElementById("mobileMenuBtn");
  const mobileMenu = document.getElementById("mobileMenu");

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener("click", () => {
      const isHidden = mobileMenu.classList.contains("hidden");
      if (isHidden) {
        mobileMenu.classList.remove("hidden");
        setTimeout(() => {
          mobileMenu.classList.remove("scale-95", "opacity-0");
          mobileMenu.classList.add("scale-100", "opacity-100");
        }, 10);
      } else {
        mobileMenu.classList.remove("scale-100", "opacity-100");
        mobileMenu.classList.add("scale-95", "opacity-0");
        setTimeout(() => {
          mobileMenu.classList.add("hidden");
        }, 300);
      }
    });
  }

  // 3. Buat Akun Dummy Otomatis (Jika database lokal kosong)
  if (getUsers().length === 0) {
    saveUserToDB({ name: 'Ulya', email: 'admin@gmail.com', password: 'password' });
  }

  // 4. Logika Form di Halaman Login
  const loginFormPage = document.getElementById("loginFormPage");
  if (loginFormPage) {
    loginFormPage.addEventListener("submit", (e) => {
      e.preventDefault();
      
      const email = document.getElementById("loginEmail").value;
      const passwordInput = document.getElementById("loginPassword");
      const password = passwordInput.value;
      const btn = loginFormPage.querySelector('button[type="submit"]');
      const errorMsg = document.getElementById("loginErrorMsg");

      // Efek Loading Tombol
      const originalText = btn.innerText;
      btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-sm">refresh</span> Memeriksa...';
      btn.disabled = true;

      // Sembunyikan Error Lama
      if (errorMsg) errorMsg.classList.add("hidden");
      passwordInput.classList.remove("ring-1", "ring-red-500");

      setTimeout(() => {
        const users = getUsers();
        // Verifikasi Email & Password
        const user = users.find(u => u.email === email && u.password === password);

        btn.innerText = originalText;
        btn.disabled = false;

        if (user) {
          // Login Berhasil
          setCurrentUser(user);
          showToast(`Selamat datang, ${user.name}! Mengalihkan...`);
          setTimeout(() => {
            window.location.href = '/'; 
          }, 1000); 
        } else {
          // Login Gagal
          if (errorMsg) errorMsg.classList.remove("hidden");
          passwordInput.classList.add("ring-1", "ring-red-500");
        }
      }, 1000);
    });
  }

  // 5. Langganan Buletin (Footer)
  const newsletterForm = document.querySelector("footer form");
  if (newsletterForm) {
    newsletterForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const input = newsletterForm.querySelector("input");
      if (input.value) {
        showToast("Terima kasih telah berlangganan info dari Eco-Report!");
        input.value = "";
      }
    });
  }
});