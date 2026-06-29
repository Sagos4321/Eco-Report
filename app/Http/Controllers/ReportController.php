<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Ditambahkan untuk fitur hapus gambar

class ReportController extends Controller
{
    // Halaman Jelajah (Melihat semua laporan publik)
    public function index()
    {
        // tampilin yang udah approp aja dari admin
        $reports = Report::with(['user', 'comments.user', 'likes'])
                ->where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->get();
                
        return view('jelajah', compact('reports'));
    }

    // Menampilkan form Lapor
    public function create()
    {
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240', 
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        Report::create([
            'user_id' => $request->has('is_anonymous') ? null : Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image_path' => $imagePath,
            'status' => 'pending',
            'likes' => 0
        ]);

        return redirect('/jelajah')->with('success', 'Laporan berhasil dikirim dan sedang menunggu tinjauan!');
    }

    // FITUR BARU: Menghapus Laporan Sendiri
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        // Keamanan: Pastikan hanya pemilik asli yang bisa menghapus laporannya
        if ($report->user_id !== Auth::id()) {
            return back()->withErrors(['error' => 'Anda tidak memiliki hak untuk menghapus laporan ini.']);
        }

        // Hapus file gambar dari folder storage jika ada
        if ($report->image_path && Storage::disk('public')->exists($report->image_path)) {
            Storage::disk('public')->delete($report->image_path);
        }

        // Hapus data dari database
        $report->delete();

        return back()->with('success', 'Laporan berhasil dihapus dari riwayat Anda.');
    }

    // Fungsi Admin
    public function approve($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'approved';
        $report->save();

        return back()->with('success', 'Laporan berhasil disetujui!');
    }

    public function reject($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'rejected';
        $report->save();

        return back()->with('success', 'Laporan telah ditolak.');
    }
    
    // Fungsi Komentar
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment_text' => 'required|string'
        ]);

        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu.'
            ], 401); 
        }

        $comment = new \App\Models\Comment();
        $comment->user_id = auth()->id();
        $comment->report_id = $id;
        $comment->comment_text = $request->comment_text;
        $comment->save();

        return response()->json([
            'success' => true,
            'user_name' => auth()->user()->name,
            'body' => $comment->comment_text
        ]);
    }

    // Fungsi Suka
    public function toggleLike($id)
    {
        $userId = Auth::id();
        $existingLike = \App\Models\Like::where('user_id', $userId)->where('report_id', $id)->first();
        
        if ($existingLike) {
            $existingLike->delete(); 
            $isLiked = false;
        } else {
            \App\Models\Like::create([ 
                'user_id' => $userId,
                'report_id' => $id
            ]);
            $isLiked = true;
        }

        $likeCount = \App\Models\Like::where('report_id', $id)->count();

        $report = Report::findOrFail($id);
        $report->likes = $likeCount;
        $report->save();

        return response()->json([
            'success' => true,
            'isLiked' => $isLiked,
            'likeCount' => $likeCount
        ]);
    }
}