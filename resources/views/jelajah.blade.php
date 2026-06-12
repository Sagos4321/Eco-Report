@extends('layouts.app')

@section('content')
<section class="py-10 md:py-16 relative overflow-hidden" id="explore">
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-30">
        <div class="absolute top-20 right-20 w-96 h-96 bg-primary/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-20 left-20 w-80 h-80 bg-orange-100/40 rounded-full blur-[80px]"></div>
    </div>

    <div class="layout-content-container flex w-full max-w-[1280px] mx-auto flex-col gap-6 md:gap-10 px-4 relative z-10">
        
        <div class="flex flex-col gap-1 md:gap-2 max-w-xl">
            <span class="text-primary font-bold uppercase tracking-widest text-xs">Galeri Publik</span>
            <h2 class="text-2xl md:text-5xl font-display font-bold text-[#151613] dark:text-white">
                Jelajahi Laporan Dampak
            </h2>
            <p class="text-[#151613]/60 dark:text-white/60 text-sm md:text-lg">
                Daftar seluruh laporan lingkungan yang dilaporkan langsung oleh warga.
            </p>
        </div>

        <div id="cards-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            
            <div class="report-card group relative aspect-[3/4] overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500" onclick="openReport('1')">
                <img alt="Pembabatan Hutan" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ asset('images/raja-ampat.jpeg') }}" />
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-90 transition-opacity duration-300"></div>
                
                <div class="absolute top-6 left-6 flex flex-wrap gap-2 pr-4 z-10">
                    <span class="px-4 py-1.5 rounded-full bg-red-500/80 backdrop-blur-md text-white text-xs font-bold border border-red-400/50 shadow-sm">Penebangan Liar</span>
                    <span class="px-3 py-1.5 rounded-full bg-black/60 backdrop-blur-md text-white text-xs font-medium border border-white/10">Menunggu Verifikasi</span>
                </div>
                
                <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 translate-y-4 group-hover:-translate-y-2 transition-transform duration-500 ease-out z-10">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-sm text-[#D4E8C2]">location_on</span>
                        <p class="text-[#D4E8C2] text-sm font-medium">Raja Ampat, Papua</p>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-tight">Pembabatan Hutan Terselubung</h3>
                    <div>
                        <p class="text-white/80 text-sm leading-relaxed mb-6 line-clamp-3">
                            Ditemukan aktivitas alat berat dan penebangan liar di area zona hijau konservasi. Diduga kuat untuk pembukaan lahan tambang ilegal yang mengancam ekosistem.
                        </p>
                        <button onclick="event.stopPropagation(); openReport('1')" class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-[#151613] font-bold text-sm hover:bg-primary hover:text-white transition-colors shadow-lg">
                            Lihat Laporan Lengkap
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="report-card group relative aspect-[3/4] overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500" onclick="openReport('2')">
                <img alt="Sampah Pantai" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ asset('images/pantai-kotor.jpeg') }}" />
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-90 transition-opacity duration-300"></div>
                
                <div class="absolute top-6 left-6 flex flex-wrap gap-2 pr-4 z-10">
                    <span class="px-4 py-1.5 rounded-full bg-amber-500/80 backdrop-blur-md text-white text-xs font-bold border border-amber-400/50 shadow-sm">Polusi / Limbah</span>
                    <span class="px-3 py-1.5 rounded-full bg-black/60 backdrop-blur-md text-white text-xs font-medium border border-white/10">Sedang Diselidiki</span>
                </div>
                
                <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 translate-y-4 group-hover:-translate-y-2 transition-transform duration-500 ease-out z-10">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-sm text-[#D4E8C2]">location_on</span>
                        <p class="text-[#D4E8C2] text-sm font-medium">Pantai Teluk Labuan, Banten</p>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-tight">Darurat Sampah Pantai</h3>
                    <div>
                        <p class="text-white/80 text-sm leading-relaxed mb-6 line-clamp-3">
                            Tumpukan sampah plastik, limbah rumah tangga, hingga limbah medis menutupi hampir seluruh bibir pantai. Bau menyengat dan mencemari air laut.
                        </p>
                        <button onclick="event.stopPropagation(); openReport('2')" class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-[#151613] font-bold text-sm hover:bg-primary hover:text-white transition-colors shadow-lg">
                            Lihat Laporan Lengkap
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="report-card group relative aspect-[3/4] overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500" onclick="openReport('3')">
                <img alt="Polusi Asap" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ asset('images/cerobong-asap.jpg') }}" />
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-90 transition-opacity duration-300"></div>
                
                <div class="absolute top-6 left-6 flex flex-wrap gap-2 pr-4 z-10">
                    <span class="px-4 py-1.5 rounded-full bg-amber-500/80 backdrop-blur-md text-white text-xs font-bold border border-amber-400/50 shadow-sm">Polusi / Limbah</span>
                    <span class="px-3 py-1.5 rounded-full bg-blue-500/80 backdrop-blur-md text-white text-xs font-medium border border-blue-400/50">Diteruskan ke KLHK</span>
                </div>
                
                <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 translate-y-4 group-hover:-translate-y-2 transition-transform duration-500 ease-out z-10">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-sm text-[#D4E8C2]">location_on</span>
                        <p class="text-[#D4E8C2] text-sm font-medium">Kawasan Industri, Riau</p>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-tight">Polusi Asap Hitam Pekat</h3>
                    <div>
                        <p class="text-white/80 text-sm leading-relaxed mb-6 line-clamp-3">
                            Sudah tiga hari berturut-turut cerobong asap dari kilang minyak mengeluarkan asap hitam pekat. Jarak pandang menurun dan warga mengeluh ISPA.
                        </p>
                        <button onclick="event.stopPropagation(); openReport('3')" class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-[#151613] font-bold text-sm hover:bg-primary hover:text-white transition-colors shadow-lg">
                            Lihat Laporan Lengkap
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ========================================== -->
    <!-- MODAL DETAIL LAPORAN (POPUPS) -->
    <!-- ========================================== -->
    <div id="reportModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4 md:p-6 opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-[2rem] w-full max-w-5xl max-h-[90vh] flex flex-col md:flex-row overflow-hidden relative shadow-2xl transform scale-95 transition-transform duration-300" id="reportModalContent">
            
            <!-- Tombol Tutup -->
            <button onclick="closeReport()" class="absolute top-4 right-4 z-50 bg-white/80 backdrop-blur text-[#151613] size-10 flex items-center justify-center rounded-full hover:bg-red-500 hover:text-white transition-colors shadow-sm">
                <span class="material-symbols-outlined">close</span>
            </button>

            <!-- Kiri: Gambar Full -->
            <div class="w-full md:w-1/2 h-64 md:h-full relative bg-neutral-100 flex-shrink-0">
                <img id="modalImage" src="" alt="Foto Laporan" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent md:hidden"></div>
            </div>

            <!-- Kanan: Konten, Like & Komentar -->
            <div class="w-full md:w-1/2 flex flex-col h-full max-h-[calc(90vh-16rem)] md:max-h-[90vh] bg-white">
                
                <!-- Area Scrollable (Detail & List Komentar) -->
                <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
                    
                    <!-- Header Judul -->
                    <div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span id="modalCategory" class="px-3 py-1 rounded-full bg-primary/10 text-primary-dark text-xs font-bold border border-primary/20"></span>
                            <span id="modalStatus" class="px-3 py-1 rounded-full bg-neutral-100 text-neutral-600 text-xs font-bold border border-neutral-200"></span>
                        </div>
                        <h2 id="modalTitle" class="text-2xl md:text-3xl font-extrabold text-[#151613] leading-tight mb-2"></h2>
                        <div class="flex items-center gap-2 text-neutral-500 mb-4">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <p id="modalLocation" class="text-sm font-medium"></p>
                        </div>
                        
                        <!-- Profil Pelapor -->
                        <div class="flex items-center gap-3 py-4 border-y border-neutral-100">
                            <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold text-sm" id="modalUserAvatar"></div>
                            <div>
                                <p class="text-sm font-bold text-[#151613]" id="modalUserName"></p>
                                <p class="text-xs text-neutral-400" id="modalDate"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Kronologi / Deskripsi -->
                    <div>
                        <h3 class="text-sm font-bold text-[#151613] mb-2">Kronologi / Detail:</h3>
                        <p id="modalDescription" class="text-neutral-600 text-sm leading-relaxed"></p>
                    </div>

                    <!-- Tombol Aksi (Like & Jumlah Komentar) -->
                    <div class="flex items-center gap-4 pt-4 border-t border-neutral-100">
                        <button onclick="toggleLike()" id="btnLike" class="flex items-center gap-2 px-4 py-2 rounded-full border border-neutral-200 text-neutral-600 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors font-bold text-sm">
                            <span class="material-symbols-outlined text-lg" id="iconLike">favorite</span>
                            <span id="likeCount">0</span> Dukung
                        </button>
                        <div class="flex items-center gap-2 px-4 py-2 text-neutral-500 font-bold text-sm">
                            <span class="material-symbols-outlined text-lg">chat</span>
                            <span id="commentCount">0</span> Komentar
                        </div>
                    </div>

                    <!-- List Komentar -->
                    <div class="pt-2">
                        <div id="commentsList" class="space-y-4">
                            <!-- Komentar akan di-generate oleh JS -->
                        </div>
                    </div>
                </div>

                <!-- Input Komentar (Fixed di Bawah) -->
                <div class="p-4 md:p-6 border-t border-neutral-100 bg-neutral-50 shrink-0">
                    <form onsubmit="submitComment(event)" class="flex gap-2">
                        <input type="text" id="commentInput" placeholder="Tulis komentar atau dukungan..." class="flex-1 bg-white border border-neutral-200 rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-primary outline-none" required>
                        <button type="submit" class="bg-[#151613] hover:bg-black text-white rounded-full px-5 py-2 flex items-center justify-center transition-colors shadow-md">
                            <span class="material-symbols-outlined text-sm mr-1">send</span> Kirim
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        // 1. Database Laporan Dummy (Jika belum ada di LocalStorage)
        const initialReports = [
            {
                id: "1",
                title: "Pembabatan Hutan Terselubung",
                location: "Raja Ampat, Papua",
                category: "Penebangan Liar",
                status: "Menunggu Verifikasi",
                date: "Hari ini, 09:30 WITA",
                userName: "Anonim",
                description: "Ditemukan aktivitas alat berat dan penebangan liar di area zona hijau konservasi. Diduga kuat untuk pembukaan lahan tambang ilegal yang mengancam ekosistem. Kami butuh bantuan dinas terkait untuk meninjau lokasi secepatnya!",
                imageUrl: "{{ asset('images/raja-ampat.jpeg') }}",
                likes: 124,
                comments: [{ name: "WargaLokal", text: "Tolong segera diviralkan, alat beratnya makin banyak!" }]
            },
            {
                id: "2",
                title: "Darurat Sampah Pantai",
                location: "Pantai Teluk Labuan, Banten",
                category: "Polusi / Limbah",
                status: "Sedang Diselidiki",
                date: "Kemarin, 14:15 WIB",
                userName: "WargaPesisir",
                description: "Tumpukan sampah plastik, limbah rumah tangga, hingga limbah medis menutupi hampir seluruh bibir pantai. Bau menyengat dan mencemari air laut. Nelayan kesulitan bersandar.",
                imageUrl: "{{ asset('images/pantai-kotor.jpeg') }}",
                likes: 890,
                comments: [{ name: "BudiS", text: "Pemerintah daerah harus segera turun tangan!" }]
            },
            {
                id: "3",
                title: "Polusi Asap Hitam Pekat",
                location: "Kawasan Industri, Riau",
                category: "Polusi / Limbah",
                status: "Diteruskan ke KLHK",
                date: "2 Hari lalu, 10:00 WIB",
                userName: "PejuangNapas",
                description: "Sudah tiga hari berturut-turut cerobong asap dari kilang minyak mengeluarkan asap hitam pekat. Jarak pandang menurun dan banyak warga mulai mengeluh sesak napas (ISPA).",
                imageUrl: "{{ asset('images/cerobong-asap.jpg') }}",
                likes: 3412,
                comments: [{ name: "SitiA", text: "Pabriknya harus ditutup sementara sampai amdalnya jelas!" }]
            }
        ];

        // Simpan ke localStorage jika kosong agar komentar bisa disimpan
        if (!localStorage.getItem("eco_public_reports")) {
            localStorage.setItem("eco_public_reports", JSON.stringify(initialReports));
        }

        let currentReportId = null; // Menyimpan ID laporan yang sedang dibuka

        // 2. Fungsi Buka Modal
        function openReport(id) {
            currentReportId = id;
            const reports = JSON.parse(localStorage.getItem("eco_public_reports"));
            const report = reports.find(r => r.id === id);

            if(!report) return;

            // Isi Data ke Modal
            document.getElementById("modalImage").src = report.imageUrl;
            document.getElementById("modalCategory").innerText = report.category;
            
            // Ubah Warna Badge Status
            const statusBadge = document.getElementById("modalStatus");
            statusBadge.innerText = report.status;
            if(report.status.includes("Menunggu")) {
                statusBadge.className = "px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-bold border border-amber-200";
            } else if(report.status.includes("KLHK")) {
                statusBadge.className = "px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold border border-blue-200";
            } else {
                statusBadge.className = "px-3 py-1 rounded-full bg-neutral-100 text-neutral-600 text-xs font-bold border border-neutral-200";
            }

            document.getElementById("modalTitle").innerText = report.title;
            document.getElementById("modalLocation").innerText = report.location;
            document.getElementById("modalUserName").innerText = report.userName;
            document.getElementById("modalUserAvatar").innerText = report.userName.charAt(0);
            document.getElementById("modalDate").innerText = report.date;
            document.getElementById("modalDescription").innerText = report.description;
            
            // Update Like & Comment Count
            document.getElementById("likeCount").innerText = report.likes;
            document.getElementById("commentCount").innerText = report.comments.length;

            // Render List Komentar
            renderComments(report.comments);

            // Tampilkan Modal dengan Animasi
            const modal = document.getElementById("reportModal");
            const modalContent = document.getElementById("reportModalContent");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            
            setTimeout(() => {
                modal.classList.remove("opacity-0");
                modalContent.classList.remove("scale-95");
                modalContent.classList.add("scale-100");
            }, 10);

            // Matikan scroll pada body website
            document.body.style.overflow = "hidden";
        }

        // 3. Fungsi Tutup Modal
        function closeReport() {
            const modal = document.getElementById("reportModal");
            const modalContent = document.getElementById("reportModalContent");
            
            modal.classList.add("opacity-0");
            modalContent.classList.remove("scale-100");
            modalContent.classList.add("scale-95");
            
            setTimeout(() => {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
                document.body.style.overflow = "auto";
            }, 300);
        }

        // 4. Fungsi Toggle Like
        function toggleLike() {
            const reports = JSON.parse(localStorage.getItem("eco_public_reports"));
            const reportIndex = reports.findIndex(r => r.id === currentReportId);
            
            const btn = document.getElementById("btnLike");
            const icon = document.getElementById("iconLike");
            const count = document.getElementById("likeCount");

            // Animasi & Ganti Warna
            if (btn.classList.contains("text-red-500")) {
                // Unlike
                reports[reportIndex].likes -= 1;
                btn.classList.remove("text-red-500", "bg-red-50", "border-red-200");
                icon.classList.remove("fill-current"); // Outline
            } else {
                // Like
                reports[reportIndex].likes += 1;
                btn.classList.add("text-red-500", "bg-red-50", "border-red-200");
                icon.classList.add("fill-current"); // Block color
            }

            count.innerText = reports[reportIndex].likes;
            localStorage.setItem("eco_public_reports", JSON.stringify(reports));
        }

        // 5. Fungsi Render Komentar
        function renderComments(commentsArray) {
            const list = document.getElementById("commentsList");
            list.innerHTML = "";
            
            if(commentsArray.length === 0) {
                list.innerHTML = `<p class="text-sm text-neutral-400 italic">Belum ada komentar. Jadilah yang pertama memberi dukungan!</p>`;
                return;
            }

            commentsArray.forEach(comment => {
                list.innerHTML += `
                    <div class="bg-neutral-50 p-3 rounded-xl border border-neutral-100">
                        <p class="text-xs font-bold text-[#151613] mb-1">${comment.name}</p>
                        <p class="text-sm text-neutral-600">${comment.text}</p>
                    </div>
                `;
            });
        }

        // 6. Fungsi Tambah Komentar
        function submitComment(event) {
            event.preventDefault();
            
            // Cek apakah User sudah login
            const currentUser = JSON.parse(localStorage.getItem("eco_current_user"));
            if(!currentUser) {
                alert("Silakan masuk (login) terlebih dahulu untuk memberikan komentar dukungan!");
                return;
            }

            const input = document.getElementById("commentInput");
            const text = input.value.trim();
            if(!text) return;

            const reports = JSON.parse(localStorage.getItem("eco_public_reports"));
            const reportIndex = reports.findIndex(r => r.id === currentReportId);

            // Tambahkan komentar baru
            reports[reportIndex].comments.push({
                name: currentUser.name,
                text: text
            });

            // Update Database Local & UI
            localStorage.setItem("eco_public_reports", JSON.stringify(reports));
            document.getElementById("commentCount").innerText = reports[reportIndex].comments.length;
            renderComments(reports[reportIndex].comments);
            
            input.value = ""; // Bersihkan kolom input
            
            // Scroll ke komentar terbaru
            const commentsContainer = document.getElementById("commentsList").parentElement.parentElement;
            commentsContainer.scrollTop = commentsContainer.scrollHeight;
        }
    </script>
@endsection