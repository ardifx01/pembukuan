<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    if ($request->hasFile('avatar')) {
        // Hapus avatar lama
        if ($user->avatar && file_exists(public_path($user->avatar))) {
            unlink(public_path($user->avatar));
        }
        
        $avatar = $request->file('avatar');
        $avatarName = time() . '_' . $avatar->getClientOriginalName();
        $avatar->move(public_path('uploads/avatars'), $avatarName);
        $data['avatar'] = 'uploads/avatars/' . $avatarName;
        
        // Debug
        \Log::info('Avatar saved: ' . $data['avatar']);
    }

    // Update user
    $user->update($data);
    
    // Debug
    \Log::info('User after update: ', $user->toArray());

    return redirect()->route('profile.edit')
        ->with('success', 'Profil berhasil diperbarui!');
}

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.edit')
            ->with('success', 'Password berhasil diubah!');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}