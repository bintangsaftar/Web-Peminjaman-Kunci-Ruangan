<?php

namespace App\Http\Controllers;

use App\Models\Waktu;
use Illuminate\Http\Request;

class WaktuController extends Controller
{
    public function index_mengelola_waktu() {
        $waktuItems = Waktu::all();
        return view('mengelolaWaktu', compact('waktuItems'));
    }

    public function index_tambah_waktu()
    {
        return view('tambahWaktu');
    }

    public function tambah_waktu(Request $request)
    {
        $request->validate([
            'waktu' => 'required|string|max:5|min:5|regex:/^[0-9.]+$/',
        ], [
            'waktu.required' => 'Kolom Waktu harus diisi.',
            'waktu.max' => 'Kolom Waktu tidak boleh lebih dari 5 karakter.',
            'waktu.min' => 'Kolom Waktu tidak boleh kurang dari 5 karakter.',
            'waktu.regex' => 'Kolom Waktu hanya boleh mengandung khusus karakter angka. (Simbol titik diperbolehkan)',
        ]);

        Waktu::create([
            'waktu' => $request->input('waktu'),
        ]);

        return redirect('/mengelola-waktu')->with('success', 'Waktu telah ditambahkan.');
    }

    public function index_ubah_waktu($idwaktu)
    {
        $waktuItems = Waktu::all()->where('idwaktu', $idwaktu);
        return view('ubahWaktu', compact('waktuItems'));
    }

    public function ubah_waktu(Request $request, $idwaktu)
    {
        $waktuItems =  Waktu::findOrFail($idwaktu);

        $request->validate([
            'waktu' => 'required|string|max:5|min:5|regex:/^[0-9.]+$/',
        ], [
            'waktu.required' => 'Kolom Waktu harus diisi.',
            'waktu.max' => 'Kolom Waktu tidak boleh lebih dari 15 karakter.',
            'waktu.min' => 'Kolom Waktu tidak boleh kurang dari 5 karakter.',
            'waktu.regex' => 'Kolom Waktu hanya boleh mengandung khusus karakter angka. (Simbol titik diperbolehkan)',
        ]);

        $waktuItems->update([
            'waktu' => $request->input('waktu'),
        ]);

        return redirect('/mengelola-waktu')->with('success', 'Waktu berhasil diubah.');
    }

    public function hapus_waktu($idwaktu)
    {
        // Cari waktu berdasarkan ID
        $waktu = Waktu::find($idwaktu);

        if (!$waktu) {
            return response()->json(['success' => false, 'message' => 'Waktu tidak ditemukan.']);
        }

        // Lakukan penghapusan waktu
        $waktu->delete();

        return response()->json(['success' => true, 'message' => 'Waktu berhasil dihapus.']);
    }
}
