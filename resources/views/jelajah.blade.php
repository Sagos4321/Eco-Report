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
@endsection