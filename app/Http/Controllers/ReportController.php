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
        // Mengambil semua laporan, diurutkan dari yang terbaru
        $reports = Report::with('user')->orderBy('created_at', 'desc')->get();
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
}