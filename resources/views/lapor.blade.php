@extends('layouts.app')

@section('content')
<section class="w-full max-w-[1280px] mx-auto mt-6 md:mt-12 mb-6 md:mb-10 px-4" id="report">
    <div class="bg-white rounded-[1.5rem] md:rounded-[3rem] shadow-xl overflow-hidden flex flex-col lg:flex-row border border-white/50">
        
        <div class="lg:w-[35%] bg-[#F4F8F1] p-6 md:p-10 lg:p-14 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 p-10 opacity-5">
                <span class="material-symbols-outlined text-[300px]">lock</span>
            </div>
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-6">
                    <span class="material-symbols-outlined text-base">shield</span>
                    Saluran Aman
                </div>
                <h2 class="text-xl md:text-3xl lg:text-4xl font-display font-bold text-[#151613] mb-4 md:mb-6">
                    Ajukan Laporan
                </h2>
                <p class="text-[#151613]/70 mb-6 md:mb-10 leading-relaxed text-sm md:text-lg">
                    Kami mengandalkan kewaspadaan masyarakat untuk mengidentifikasi ancaman lingkungan. Identitas Anda dapat tetap anonim dan terlindungi.
                </p>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="size-12 rounded-2xl bg-white flex items-center justify-center text-primary shadow-sm shrink-0">
                            <span class="material-symbols-outlined">visibility_off</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#151613] text-lg">Opsi Anonim</h4>
                            <p class="text-sm text-[#151613]/60 mt-1">Pilih 'Lapor Secara Anonim' untuk menyembunyikan detail pribadi Anda dari catatan publik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="lg:w-[65%] p-6 md:p-10 lg:p-16 bg-white">
            <form class="space-y-6 md:space-y-8" onsubmit="handleStaticReportSubmit(event)">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                    <div class="space-y-2 md:space-y-3">
                        <label class="text-sm font-bold text-[#151613] ml-1">Kategori Insiden</label>
                        <select id="incident-type" class="w-full bg-neutral-50 border-0 rounded-2xl px-4 py-3 md:px-5 md:py-4 text-[#151613] ring-1 ring-neutral-200 focus:ring-2 focus:ring-primary focus:bg-white transition-all appearance-none cursor-pointer text-sm md:text-base">
                            <option>Pilih tipe...</option>
                            <option>Penebangan Liar</option>
                            <option>Polusi / Pembuangan Limbah</option>
                            <option>Perdagangan Satwa Liar</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="space-y-2 md:space-y-3">
                        <label class="text-sm font-bold text-[#151613] ml-1">Lokasi Kejadian</label>
                        <div class="relative">
                            <input id="location" type="text" class="w-full bg-neutral-50 border-0 rounded-2xl px-4 py-3 md:px-5 md:py-4 pl-10 md:pl-12 text-[#151613] ring-1 ring-neutral-200 focus:ring-2 focus:ring-primary focus:bg-white transition-all placeholder:text-neutral-400 text-sm md:text-base" placeholder="Masukkan lokasi atau alamat detail..." />
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400">location_on</span>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-2 md:space-y-3">
                    <label class="text-sm font-bold text-[#151613] ml-1">Deskripsi Rinci</label>
                    <textarea id="description" rows="5" class="w-full bg-neutral-50 border-0 rounded-2xl px-4 py-3 md:px-5 md:py-4 text-[#151613] ring-1 ring-neutral-200 focus:ring-2 focus:ring-primary focus:bg-white transition-all placeholder:text-neutral-400 resize-none text-sm md:text-base" placeholder="Jelaskan kronologi insiden, waktu kejadian, dan detail spesifik lainnya..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="bg-neutral-50 p-4 rounded-2xl border border-neutral-200 flex items-center gap-3">
                        <input type="checkbox" id="isAnonymous" class="w-5 h-5 rounded text-primary focus:ring-primary border-neutral-300 cursor-pointer" />
                        <div>
                            <label for="isAnonymous" class="text-sm font-bold text-[#151613] cursor-pointer">Lapor Secara Anonim</label>
                            <p class="text-xs text-neutral-500">Nama Anda tidak akan dipublikasikan</p>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="file-upload" class="flex items-center gap-3 w-full bg-neutral-50 border border-dashed border-neutral-300 rounded-2xl px-4 py-4 cursor-pointer hover:bg-primary/5 hover:border-primary transition-all group">
                            <span class="material-symbols-outlined text-neutral-400 group-hover:text-primary">cloud_upload</span>
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-[#151613] group-hover:text-primary">Unggah Bukti Gambar</span>
                                <span class="text-[10px] text-neutral-400">JPG, PNG, PDF (Maks 10MB)</span>
                            </div>
                            <input class="hidden" id="file-upload" type="file" />
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="w-full bg-primary text-white font-bold h-[60px] md:h-[72px] rounded-2xl shadow-lg shadow-primary/30 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-3 text-base md:text-lg">
                        Kirim Laporan <span class="material-symbols-outlined">send</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection