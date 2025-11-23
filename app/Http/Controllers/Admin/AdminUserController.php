<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = \App\Models\User::where('id', '!=', auth()->id())->get();
        return view('admin.users', compact('users'));
    }


    // Update role user
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,petugas,warga',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users.index')->with('success', 'Role pengguna berhasil diperbarui!');
    }
}
