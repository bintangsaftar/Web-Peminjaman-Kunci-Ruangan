<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index_mengelola_prodi() {
        $prodiItems = Prodi::all();
        return view('mengelolaProdi', compact('prodiItems'));
    }

    public function index_tambah_prodi()
    {
        return view('tambahProdi');
    }

    public function tambah_prodi(Request $request)
    {
        $request->validate([
            'prodi' => 'required|string|max:4',
        ], [
            'prodi.required' => 'Kolom Prodi harus diisi.',
            'prodi.max' => 'Kolom Prodi tidak boleh lebih dari 4 karakter.',
        ]);

        Prodi::create([
            'prodi' => $request->input('prodi'),
        ]);

        return redirect('/mengelola-prodi')->with('success', 'Prodi telah ditambahkan.');
    }

    public function index_ubah_prodi($idprodi)
    {
        $prodiItems = Prodi::all()->where('idprodi', $idprodi);
        return view('ubahProdi', compact('prodiItems'));
    }

    public function ubah_prodi(Request $request, $idprodi)
    {
        $prodiItems =  Prodi::findOrFail($idprodi);

        $request->validate([
            'prodi' => 'required|string|max:4',
        ], [
            'prodi.required' => 'Kolom Prodi harus diisi.',
            'prodi.max' => 'Kolom Prodi tidak boleh lebih dari 4 karakter.',
        ]);

        $prodiItems->update([
            'prodi' => $request->input('prodi'),
        ]);

        return redirect('/mengelola-prodi')->with('success', 'Prodi berhasil diubah.');
    }

    public function hapus_prodi($idprodi)
    {
        // Cari prodi berdasarkan ID
        $prodi = Prodi::find($idprodi);

        if (!$prodi) {
            return response()->json(['success' => false, 'message' => 'Prodi tidak ditemukan.']);
        }

        // Lakukan penghapusan prodi
        $prodi->delete();

        return response()->json(['success' => true, 'message' => 'Prodi berhasil dihapus.']);
    }
}
