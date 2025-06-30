<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Admin - Lihat semua user
    public function index()
    {
        $users = User::all();
        return view('account.index', compact('users'));
    }

    // Admin - Form tambah user
    public function create()
    {
        return view('account.tambah');
    }

    // Admin - Simpan user baru
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,user',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // Admin - Form edit user
    public function edit(User $user)
    {
        return view('account.edit', compact('user'));
    }

    // Admin - Update data user
   public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:8',
        ]);

        // Siapkan data yang akan diupdate
        $data = $request->only(['name', 'email', 'role']);

        // Jika password diisi, hash dan simpan
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update user
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    // Admin - Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
    





}
