@extends('layouts.app')

@section('content')
<section class="py-10 md:py-16 relative min-h-screen">
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-30 -z-10">
        <div class="absolute top-0 left-10 w-96 h-96 bg-primary/20 rounded-full blur-[100px]"></div>
    </div>

    <div class="layout-content-container flex w-full max-w-[1024px] mx-auto flex-col md:flex-row gap-8 px-4 relative z-10">
        
        <div class="w-full md:w-1/3 flex flex-col gap-6">
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-neutral-100 flex flex-col items-center text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-24 bg-primary/10"></div>
                
                <div class="size-24 rounded-full bg-primary text-white flex items-center justify-center text-4xl font-extrabold border-4 border-white shadow-md relative z-10 mt-6 mb-4">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                
                <h2 class="text-2xl font-bold text-[#151613] mb-1">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-neutral-500 mb-6">{{ Auth::user()->email }}</p>
                
                <span class="px-4 py-1.5 bg-green-50 text-green-600 font-bold text-xs rounded-full border border-green-200 mb-8">Relawan Aktif</span>
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-primary text-white rounded-xl text-sm font-semibold mb-2">Edit Profile</a>

                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin ingin keluar dari akun Anda?')" class="w-full flex items-center justify-center gap-2 bg-red-50 hover:bg-red-500 text-red-500 hover:text-white py-3 rounded-xl font-bold transition-colors">
                        <span class="material-symbols-outlined text-base">logout</span>
                        Keluar Akun
                    </button>
                </form>
            </div>
        </div>

        <div class="w-full md:w-2/3 flex flex-col gap-6">
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-neutral-100 min-h-[400px]">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-[#151613]">Riwayat Laporan Saya</h3>
                        <p class="text-sm text-neutral-500 mt-1">Daftar aksi nyata yang telah Anda suarakan.</p>
                    </div>
                    <span class="material-symbols-outlined text-4xl text-primary/20">history</span>
                </div>

                <div class="space-y-4">
                    @php
                        $myReports = \App\Models\Report::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
                    @endphp

                    @if($myReports->isEmpty())
                        <div class="py-12 text-center opacity-60 bg-neutral-50 rounded-2xl border border-neutral-100">
                            <span class="material-symbols-outlined text-5xl text-neutral-300 mb-3">nature</span>
                            <h4 class="text-lg font-bold text-[#151613]">Belum Ada Laporan</h4>
                            <p class="text-sm text-neutral-500 mt-1">Anda belum pernah membuat laporan lingkungan.</p>
                            <a href="{{ url('/lapor') }}" class="inline-block mt-4 text-primary font-bold hover:underline">Mulai Lapor Sekarang &rarr;</a>
                        </div>
                    @else
                        @foreach($myReports as $report)
                            <div class="flex flex-col md:flex-row gap-4 bg-white p-4 rounded-2xl border border-neutral-200 hover:border-primary/50 hover:shadow-md transition-all">
                                
                                <div class="w-full md:w-32 h-24 rounded-xl overflow-hidden shrink-0">
                                    @if($report->image_path)
                                        <img src="{{ asset('storage/' . $report->image_path) }}" alt="Foto" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-neutral-400">image_not_supported</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1 flex flex-col justify-center">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-bold text-[#151613] text-lg leading-tight line-clamp-1">{{ $report->title }}</h4>
                                        
                                        @if($report->status == 'pending')
                                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-bold border border-amber-200">Menunggu</span>
                                        @elseif($report->status == 'approved')
                                            <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-bold border border-green-200">Disetujui</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full bg-red-50 text-red-600 text-xs font-bold border border-red-200">Ditolak</span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center gap-2 text-neutral-500 text-xs font-medium mb-2">
                                        <span class="material-symbols-outlined text-[14px]">location_on</span>
                                        <span>{{ $report->location }}</span>
                                    </div>
                                    
                                    <div class="flex items-center gap-4 text-xs font-bold text-neutral-400">
                                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">favorite</span> {{ $report->likes }} Dukungan</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>
@endsection