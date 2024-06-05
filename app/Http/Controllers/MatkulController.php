<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index_mengelola_matkul() {
        $matkulItems = Matkul::all();
        return view('mengelolaMatkul', compact('matkulItems'));
    }

    public function index_tambah_matkul()
    {
        return view('tambahMatkul');
    }

    public function tambah_matkul(Request $request)
    {
        $request->validate([
            'kode_matkul' => 'required|string|max:10',
            'matkul' => 'required|string|max:100',
            'sks' => 'required|integer',
        ], [
            'kode_matkul.required' => 'Kolom Kode Mata Kuliah harus diisi.',
            'kode_matkul.max' => 'Kolom Kode Mata Kuliah tidak boleh lebih dari 10 karakter.',
            'matkul.required' => 'Kolom Mata Kuliah harus diisi.',
            'matkul.max' => 'Kolom Mata Kuliah tidak boleh lebih dari 100 karakter.',
            'sks.required' => 'Kolom SKS harus diisi.',
            'sks.integer' => 'Kolom SKS hanya boleh mengandung khusus karakter angka.',
        ]);

        Matkul::create([
            'kode_matkul' => $request->input('kode_matkul'),
            'matkul' => $request->input('matkul'),
            'sks' => $request->input('sks'),
        ]);

        return redirect('/mengelola-matkul')->with('success', 'Mata Kuliah telah ditambahkan.');
    }

    public function index_ubah_matkul($idmatkul)
    {
        $matkulItems = Matkul::all()->where('idmatkul', $idmatkul);
        return view('ubahMatkul', compact('matkulItems'));
    }

    public function ubah_matkul(Request $request, $idmatkul)
    {
        $matkulItems =  Matkul::findOrFail($idmatkul);

        $request->validate([
            'kode_matkul' => 'required|string|max:10',
            'matkul' => 'required|string|max:100',
            'sks' => 'required|integer',
        ], [
            'kode_matkul.required' => 'Kolom Kode Mata Kuliah harus diisi.',
            'kode_matkul.max' => 'Kolom Kode Mata Kuliah tidak boleh lebih dari 10 karakter.',
            'matkul.required' => 'Kolom Mata Kuliah harus diisi.',
            'matkul.max' => 'Kolom Mata Kuliah tidak boleh lebih dari 100 karakter.',
            'sks.required' => 'Kolom SKS harus diisi.',
            'sks.integer' => 'Kolom SKS hanya boleh mengandung khusus karakter angka.',
        ]);

        $matkulItems->update([
            'kode_matkul' => $request->input('kode_matkul'),
            'matkul' => $request->input('matkul'),
            'sks' => $request->input('sks'),
        ]);

        return redirect('/mengelola-matkul')->with('success', 'Mata Kuliah berhasil diubah.');
    }

    public function hapus_matkul($idmatkul)
    {
        // Cari matkul berdasarkan ID
        $matkul = Matkul::find($idmatkul);

        if (!$matkul) {
            return response()->json(['success' => false, 'message' => 'Mata Kuliah tidak ditemukan.']);
        }

        // Lakukan penghapusan matkul
        $matkul->delete();

        return response()->json(['success' => true, 'message' => 'Mata Kuliah berhasil dihapus.']);
    }
}
