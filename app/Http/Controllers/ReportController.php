<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Halaman Jelajah (Melihat semua laporan publik)
    public function index()
    {
            // tampilin yang udah approp aja dari admin
            $reports = \App\Models\Report::with(['user', 'comments.user', 'likes'])
                    ->where('status', 'approved')
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('jelajah', compact('reports'));
    }

    // Menampilkan form Lapor
    public function create()
    {
        // Pastikan hanya user yang sudah login yang bisa melapor
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['email' => 'Silakan login terlebih dahulu untuk melapor.']);
        }
        return view('lapor');
    }

    // Proses menyimpan laporan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // Maks 10MB
        ]);

        // Proses upload gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke folder storage/app/public/reports
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        // Simpan data ke database
        Report::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image_path' => $imagePath,
            'status' => 'pending',
            'likes' => 0
        ]);

        return redirect('/jelajah')->with('success', 'Laporan berhasil dikirim dan sedang menunggu tinjauan!');
    }

    public function approve($id)
    {
        $report = \App\Models\Report::findOrFail($id);
        $report->status = 'approved';
        $report->save();

        return back()->with('success', 'Laporan berhasil disetujui!');
    }

    public function reject($id)
    {
        $report = \App\Models\Report::findOrFail($id);
        $report->status = 'rejected';
        $report->save();

        return back()->with('success', 'Laporan telah ditolak.');
    }
    
    // Fungsi Tambah Komentar
    public function addComment(Request $request, $id)
{
    // 1. Validasi input terlebih dahulu agar text komentar wajib diisi
    $request->validate([
        'comment_text' => 'required|string'
    ]);

    // 2. Cek apakah user benar-benar sudah login
    if (!auth()->check()) {
        return response()->json([
            'success' => false,
            'message' => 'Anda harus login terlebih dahulu untuk berkomentar.'
        ], 401); // Kirim status 401 Unauthorized
    }

    // 3. Jika lolos cek login, baru simpan komentar
    $comment = new \App\Models\Comment();
    $comment->user_id = auth()->id();
    $comment->report_id = $id;
    $comment->comment_text = $request->comment_text;
    $comment->save();

    // 4. Kembalikan respon JSON sukses
    return response()->json([
        'success' => true,
        'user_name' => auth()->user()->name,
        'body' => $comment->comment_text
    ]);
}

    // Fungsi Tombol Suka (Like / Unlike)
    public function toggleLike($id)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();
        
        // Cek apakah user sudah pernah like laporan ini
        $existingLike = \App\Models\Like::where('user_id', $userId)->where('report_id', $id)->first();
        
        if ($existingLike) {
            $existingLike->delete(); // Jika sudah, batalkan Suka (Unlike)
            $isLiked = false;
        } else {
            \App\Models\Like::create([ // Jika belum, tambahkan Suka (Like)
                'user_id' => $userId,
                'report_id' => $id
            ]);
            $isLiked = true;
        }

        $likeCount = \App\Models\Like::where('report_id', $id)->count();

        // Sinkronisasi kolom likes di tabel reports agar data di profil terupdate
        $report = \App\Models\Report::findOrFail($id);
        $report->likes = $likeCount;
        $report->save();

        return response()->json([
            'success' => true,
            'isLiked' => $isLiked,
            'likeCount' => $likeCount
        ]);
    }
}