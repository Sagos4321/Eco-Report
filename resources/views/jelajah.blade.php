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
                Daftar seluruh laporan lingkungan yang telah diverifikasi dan disetujui.
            </p>
        </div>

        <div id="cards-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            
            @php
                // Ambil data Laporan beserta relasi Komentar dan Like
                $approvedReports = \App\Models\Report::with(['user', 'comments.user', 'likes'])
                                    ->where('status', 'approved')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
            @endphp

            @if($approvedReports->count() > 0)
                @foreach($approvedReports as $report)
            @php
                // Pastikan $report->likes adalah collection, jika tidak, anggap kosong
                $reportLikes = ($report->likes instanceof \Illuminate\Support\Collection) ? $report->likes : collect();
                
                $isLikedByMe = Auth::check() ? $reportLikes->contains('user_id', Auth::id()) : false;

                $reportData = [
                    'id' => $report->id,
                    'title' => $report->title,
                    'location' => $report->location,
                    'category' => $report->category ?? 'Laporan Warga',
                    'description' => $report->description,
                    'image_url' => $report->image_path ? asset('storage/' . $report->image_path) : '',
                    'user_name' => $report->user ? $report->user->name : 'Anonim',
                    'date' => $report->created_at->format('d M Y'),
                    'likes' => $reportLikes->count(),
                    'isLikedByMe' => $isLikedByMe,
                    'comments' => $report->comments->map(function($c) {
                        return ['name' => $c->user->name ?? 'Anonim', 'text' => $c->body];
                    })->toArray()
                ];
            @endphp

                    <div class="report-card group relative aspect-[3/4] overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500" 
                         onclick='openReport(@json($reportData))'>
                        
                        @if($report->image_path)
                            <img alt="{{ $report->title }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ asset('storage/' . $report->image_path) }}" />
                        @else
                            <div class="absolute inset-0 h-full w-full bg-neutral-300 flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-neutral-500">image</span>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-90 transition-opacity duration-300"></div>
                        
                        <div class="absolute top-6 left-6 flex flex-wrap gap-2 pr-4 z-10">
                            @if(($report->category ?? '') == 'Penebangan Liar')
                                <span class="px-4 py-1.5 rounded-full bg-red-500/80 backdrop-blur-md text-white text-xs font-bold border border-red-400/50 shadow-sm">{{ $report->category }}</span>
                            @elseif(($report->category ?? '') == 'Polusi / Pembuangan Limbah')
                                <span class="px-4 py-1.5 rounded-full bg-amber-500/80 backdrop-blur-md text-white text-xs font-bold border border-amber-400/50 shadow-sm">Polusi / Limbah</span>
                            @else
                                <span class="px-4 py-1.5 rounded-full bg-blue-500/80 backdrop-blur-md text-white text-xs font-bold border border-blue-400/50 shadow-sm">{{ $report->category ?? 'Lainnya' }}</span>
                            @endif
                            <span class="px-3 py-1.5 rounded-full bg-green-500/80 backdrop-blur-md text-white text-xs font-medium border border-white/10">Diverifikasi</span>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 translate-y-4 group-hover:-translate-y-2 transition-transform duration-500 ease-out z-10">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-sm text-[#D4E8C2]">location_on</span>
                                <p class="text-[#D4E8C2] text-sm font-medium">{{ $report->location }}</p>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-tight">{{ $report->title }}</h3>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full py-20 text-center opacity-60">
                    <span class="material-symbols-outlined text-5xl text-neutral-400 mb-4">inbox</span>
                    <h3 class="text-xl font-bold text-[#151613] dark:text-white">Belum Ada Laporan Publik</h3>
                </div>
            @endif

        </div>
    </div>
</section>

<div id="reportModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4 md:p-6 opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-[2rem] w-full max-w-5xl max-h-[90vh] flex flex-col md:flex-row overflow-hidden relative shadow-2xl transform scale-95 transition-transform duration-300" id="reportModalContent">
        
        <button onclick="closeReport()" class="absolute top-4 right-4 z-50 bg-white/80 backdrop-blur text-[#151613] size-10 flex items-center justify-center rounded-full hover:bg-red-500 hover:text-white transition-colors shadow-sm">
            <span class="material-symbols-outlined">close</span>
        </button>

        <div class="w-full md:w-1/2 h-64 md:h-full relative bg-neutral-100 flex-shrink-0">
            <img id="modalImage" src="" alt="Foto Laporan" class="w-full h-full object-cover">
        </div>

        <div class="w-full md:w-1/2 flex flex-col h-full max-h-[calc(90vh-16rem)] md:max-h-[90vh] bg-white">
            <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
                
                <div>
                    <h2 id="modalTitle" class="text-2xl md:text-3xl font-extrabold text-[#151613] mb-2"></h2>
                    <div class="flex items-center gap-3 py-4 border-y border-neutral-100">
                        <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold text-sm" id="modalUserAvatar"></div>
                        <div>
                            <p class="text-sm font-bold text-[#151613]" id="modalUserName"></p>
                            <p class="text-xs text-neutral-400" id="modalDate"></p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-[#151613] mb-2">Detail Laporan:</h3>
                    <p id="modalDescription" class="text-neutral-600 text-sm leading-relaxed whitespace-pre-wrap"></p>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-neutral-100">
                    <button id="btnLike" onclick="submitLike()" class="flex items-center gap-2 px-4 py-2 rounded-full border border-neutral-200 text-neutral-600 transition-colors font-bold text-sm">
                        <span id="iconLike" class="material-symbols-outlined text-lg">favorite</span>
                        <span id="likeCount">0</span> Dukung
                    </button>
                    <div class="flex items-center gap-2 px-4 py-2 text-neutral-500 font-bold text-sm">
                        <span class="material-symbols-outlined text-lg">chat</span>
                        <span id="commentCount">0</span> Komentar
                    </div>
                </div>

                <div class="pt-2">
                    <div id="commentsList" class="space-y-4"></div>
                </div>
            </div>

            <div class="p-4 md:p-6 border-t border-neutral-100 bg-neutral-50 shrink-0">
                <form id="commentForm" class="flex gap-2" onsubmit="submitComment(event)">
                    @csrf
                    <input type="hidden" id="formReportId">
                    <input type="text" id="commentInput" placeholder="Tulis komentar dukungan..." class="flex-1 bg-white border border-neutral-200 rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-primary outline-none" required>
                    <button type="submit" class="bg-[#151613] hover:bg-black text-white rounded-full px-5 py-2 flex items-center justify-center transition-colors shadow-md">
                        <span class="material-symbols-outlined text-sm mr-1">send</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    // Cek status login ke JavaScript
    const isLoggedIn = @json(Auth::check());

    function openReport(report) {
        document.getElementById("modalImage").src = report.image_url;
        document.getElementById("modalTitle").innerText = report.title;
        document.getElementById("modalUserName").innerText = report.user_name;
        document.getElementById("modalUserAvatar").innerText = report.user_name.charAt(0).toUpperCase();
        document.getElementById("modalDate").innerText = report.date;
        document.getElementById("modalDescription").innerText = report.description;
        
        document.getElementById("formReportId").value = report.id;
        document.getElementById("likeCount").innerText = report.likes;
        document.getElementById("commentCount").innerText = report.comments.length;

        // Atur warna tombol Like jika sudah dilike
        const btnLike = document.getElementById("btnLike");
        const iconLike = document.getElementById("iconLike");
        if(report.isLikedByMe) {
            btnLike.classList.add("text-red-500", "bg-red-50", "border-red-200");
            iconLike.classList.add("fill-current");
        } else {
            btnLike.classList.remove("text-red-500", "bg-red-50", "border-red-200");
            iconLike.classList.remove("fill-current");
        }

        // Render Daftar Komentar
        const list = document.getElementById("commentsList");
        list.innerHTML = "";
        if(report.comments.length === 0) {
            list.innerHTML = `<p class="text-sm text-neutral-400 italic" id="emptyKomen">Belum ada komentar.</p>`;
        } else {
            report.comments.forEach(c => {
                list.innerHTML += `
                    <div class="bg-neutral-50 p-3 rounded-xl border border-neutral-100">
                        <p class="text-xs font-bold text-[#151613] mb-1">${c.name}</p>
                        <p class="text-sm text-neutral-600">${c.text}</p>
                    </div>`;
            });
        }

        // Tampilkan Modal
        const modal = document.getElementById("reportModal");
        const modalContent = document.getElementById("reportModalContent");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        setTimeout(() => {
            modal.classList.remove("opacity-0");
            modalContent.classList.remove("scale-95");
            modalContent.classList.add("scale-100");
        }, 10);
        document.body.style.overflow = "hidden";
    }

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

    // --- FUNGSI AJAX: KOMENTAR & LIKE ---

    async function submitComment(event) {
        event.preventDefault();
        
        if (!isLoggedIn) {
            alert("Silakan masuk (login) terlebih dahulu untuk memberi komentar!");
            window.location.href = "{{ route('login') }}";
            return;
        }

        const reportId = document.getElementById("formReportId").value;
        const input = document.getElementById("commentInput");
        const text = input.value.trim();
        const token = document.querySelector('input[name="_token"]').value;

        if(!text) return;

        // Kirim data ke Controller menggunakan Fetch API
        try {
            const response = await fetch(`/report/${reportId}/comment`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ body: text })
            });

            const data = await response.json();
            
            if (data.success) {
                // Sembunyikan tulisan "Belum ada komentar"
                const emptyKomen = document.getElementById("emptyKomen");
                if(emptyKomen) emptyKomen.remove();

                // Tambahkan elemen komentar baru ke tampilan
                const list = document.getElementById("commentsList");
                list.innerHTML += `
                    <div class="bg-primary/5 p-3 rounded-xl border border-primary/20">
                        <p class="text-xs font-bold text-primary-dark mb-1">${data.user_name} (Kamu)</p>
                        <p class="text-sm text-neutral-600">${data.body}</p>
                    </div>`;
                
                // Tambah angka jumlah komentar
                let count = parseInt(document.getElementById("commentCount").innerText);
                document.getElementById("commentCount").innerText = count + 1;
                
                input.value = ""; // Bersihkan kolom
                
                // Scroll ke paling bawah
                const commentsContainer = list.parentElement.parentElement;
                commentsContainer.scrollTop = commentsContainer.scrollHeight;
            }
        } catch (error) {
            console.error("Gagal mengirim komentar:", error);
        }
    }

    async function submitLike() {
        if (!isLoggedIn) {
            alert("Silakan masuk (login) terlebih dahulu untuk memberi dukungan!");
            window.location.href = "{{ route('login') }}";
            return;
        }

        const reportId = document.getElementById("formReportId").value;
        const token = document.querySelector('input[name="_token"]').value;

        try {
            const response = await fetch(`/report/${reportId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            });

            const data = await response.json();
            
            if (data.success) {
                const btnLike = document.getElementById("btnLike");
                const iconLike = document.getElementById("iconLike");
                
                document.getElementById("likeCount").innerText = data.likeCount;

                if (data.isLiked) {
                    btnLike.classList.add("text-red-500", "bg-red-50", "border-red-200");
                    iconLike.classList.add("fill-current");
                } else {
                    btnLike.classList.remove("text-red-500", "bg-red-50", "border-red-200");
                    iconLike.classList.remove("fill-current");
                }
            }
        } catch (error) {
            console.error("Gagal memberi dukungan:", error);
        }
    }
</script>
@endsection