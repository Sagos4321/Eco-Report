<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        auth()->user()->update([
            'name' => $request->name
        ]);

        return redirect('/profil')
            ->with('success', 'Username berhasil diperbarui');
    }
}