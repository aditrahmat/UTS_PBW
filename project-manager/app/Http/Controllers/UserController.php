<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::all(); // Mengambil semua pengguna dari database
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan detail pengguna tertentu.
     */
    public function show($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID, error jika tidak ditemukan
        return view('users.show', compact('user'));
    }

    /**
     * Menampilkan form untuk mengedit data pengguna.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna di database.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'level' => 'required|in:ADMIN,USER', // Validasi level
        ]);

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->level === 'Administrator') {
            return redirect()->route('users.index')->with('error', 'Cannot delete administrator accounts.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
