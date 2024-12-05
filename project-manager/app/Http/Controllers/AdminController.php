<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua proyek dari database
        $projects = Project::all(); // Pastikan model Project sudah ada dan di-import

        // Kirim data ke tampilan admin
        return view('admin.dashboard', compact('projects'));
    }

    /**
     * Menampilkan halaman untuk mengedit pengguna.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Ambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Kirim data pengguna ke tampilan untuk diedit
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'level' => 'required|in:Admin,User', // Menentukan role yang valid
        ]);

        // Cari pengguna berdasarkan ID dan perbarui data
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level, // Update role pengguna
        ]);

        // Kembalikan ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Menghapus pengguna dari sistem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Cari pengguna berdasarkan ID dan hapus
        $user = User::findOrFail($id);
        $user->delete();

        // Kembalikan ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
