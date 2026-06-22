<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Login/Register
    public function showLogin()
    {
        return view('login');
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => 'user', // Default role
        ]);

        // Langsung login setelah register
        Auth::login($user);

        return redirect('/')->with('success', 'Akun berhasil dibuat!');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Bersihkan format kata dari database (atasi huruf besar/spasi)
            $role = strtolower(trim(Auth::user()->role));
            
            if ($role === 'admin') {
                return redirect('/admin'); // Jika admin, arahkan ke Dasbor Admin
            }
            
            return redirect('/'); // Jika user biasa, arahkan ke Beranda
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Menampilkan halaman Profil
    public function profile()
    {
        // Ambil data user yang sedang login beserta laporan miliknya
        $user = Auth::user();
        return view('profil', compact('user'));
    }
}