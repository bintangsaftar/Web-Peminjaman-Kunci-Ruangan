<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index_mengelola_kelas() {
        $kelasItems = Kelas::all();
        return view('mengelolaKelas', compact('kelasItems'));
    }

    public function index_tambah_kelas()
    {
        return view('tambahKelas');
    }

    public function tambah_kelas(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:2|min:2|regex:/^[0-9A-Za-z]+$/',
        ], [
            'kelas.required' => 'Kolom Kelas harus diisi.',
            'kelas.max' => 'Kolom Kelas tidak boleh lebih dari 2 karakter.',
            'kelas.min' => 'Kolom Kelas tidak boleh kurang dari 2 karakter.',
            'kelas.regex' => 'Kolom Kelas hanya boleh mengandung khusus karakter angka dan huruf.',
        ]);

        Kelas::create([
            'kelas' => $request->input('kelas'),
        ]);

        return redirect('/mengelola-kelas')->with('success', 'Kelas telah ditambahkan.');
    }

    public function index_ubah_kelas($idkelas)
    {
        $kelasItems = Kelas::all()->where('idkelas', $idkelas);
        return view('ubahKelas', compact('kelasItems'));
    }
    
    public function ubah_kelas(Request $request, $idkelas)
    {
        $kelasItems =  Kelas::findOrFail($idkelas);

        $request->validate([
            'kelas' => 'required|string|max:2|min:2|regex:/^[0-9A-Za-z]+$/',
        ], [
            'kelas.required' => 'Kolom Kelas harus diisi.',
            'kelas.max' => 'Kolom Kelas tidak boleh lebih dari 2 karakter.',
            'kelas.min' => 'Kolom Kelas tidak boleh kurang dari 2 karakter.',
            'kelas.regex' => 'Kolom Kelas hanya boleh mengandung khusus karakter angka dan huruf.',
        ]);

        $kelasItems->update([
            'kelas' => $request->input('kelas'),
        ]);

        return redirect('/mengelola-kelas')->with('success', 'Kelas berhasil diubah.');
    }

    public function hapus_kelas($idkelas)
    {
        // Cari kelas berdasarkan ID
        $kelas = Kelas::find($idkelas);

        if (!$kelas) {
            return response()->json(['success' => false, 'message' => 'Kelas tidak ditemukan.']);
        }

        // Lakukan penghapusan kelas
        $kelas->delete();

        return response()->json(['success' => true, 'message' => 'Kelas berhasil dihapus.']);
    }
}
