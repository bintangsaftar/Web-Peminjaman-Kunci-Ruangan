<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index_mengelola_barang()
    {
        $barangItems = Barang::all();
        return view('mengelolaBarang', compact('barangItems'));
    }

    public function index_tambah_barang()
    {
        return view('tambahBarang');
    }

    public function tambah_barang(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:7',
            'nama_barang' => 'required|string|max:25',
            'deskripsi_barang' => 'required|string|max:350',
            'status_barang' => 'required|string',
            'merek_barang' => 'required|string|max:20',
        ], [
            'kode_barang.required' => 'Kolom Kode Barang harus diisi.',
            'kode_barang.max' => 'Kolom Kode Barang tidak boleh lebih dari 7 karakter.',
            'nama_barang.required' => 'Kolom Nama Barang harus diisi.',
            'nama_barang.max' => 'Kolom Nama Barang tidak boleh lebih dari 25 karakter.',
            'deskripsi_barang.required' => 'Kolom Deskripsi Barang harus diisi.',
            'deskripsi_barang.max' => 'Kolom Deskripsi Barang tidak boleh lebih dari 350 karakter.',
            'status_barang.required' => 'Kolom Status Barang harus diisi.',
            'merek_barang.required' => 'Kolom Merek Barang harus diisi.',
            'merek_barang.max' => 'Kolom Merek Barang tidak boleh lebih dari 20 karakter.',
        ]);

        Barang::create([
            'kode_barang' => $request->input('kode_barang'),
            'nama_barang' => $request->input('nama_barang'),
            'deskripsi_barang' => $request->input('deskripsi_barang'),
            'status_barang' => $request->input('status_barang'),
            'merek_barang' => $request->input('merek_barang'),
        ]);

        return redirect('/mengelola-barang')->with('success', 'Barang telah ditambahkan.');
    }

    public function index_ubah_barang($idbarang)
    {
        $barangItems = Barang::all()->where('idbarang', $idbarang);
        return view('ubahBarang', compact('barangItems'));
    }

    public function ubah_barang(Request $request, $idbarang) {
        $barangItems =  Barang::findOrFail($idbarang);

        $request->validate([
            'kode_barang' => 'required|string|max:7',
            'nama_barang' => 'required|string|max:45',
            'deskripsi_barang' => 'required|string|max:350',
            'status_barang' => 'required|string',
            'merek_barang' => 'required|string|max:20',
        ], [
            'kode_barang.required' => 'Kolom Kode Barang harus diisi.',
            'kode_barang.max' => 'Kolom Kode Barang tidak boleh lebih dari 7 karakter.',
            'nama_barang.required' => 'Kolom Nama Barang harus diisi.',
            'nama_barang.max' => 'Kolom Nama Barang tidak boleh lebih dari 45 karakter.',
            'deskripsi_barang.required' => 'Kolom Deskripsi Barang harus diisi.',
            'deskripsi_barang.max' => 'Kolom Deskripsi Barang tidak boleh lebih dari 350 karakter.',
            'status_barang.required' => 'Kolom Status Barang harus diisi.',
            'merek_barang.required' => 'Kolom Merek Barang harus diisi.',
            'merek_barang.max' => 'Kolom Merek Barang tidak boleh lebih dari 20 karakter.',
        ]);

        $barangItems->update([
            'kode_barang' => $request->input('kode_barang'),
            'nama_barang' => $request->input('nama_barang'),
            'deskripsi_barang' => $request->input('deskripsi_barang'),
            'status_barang' => $request->input('status_barang'),
            'merek_barang' => $request->input('merek_barang'),
        ]);

        return redirect('/mengelola-barang')->with('success', 'Barang berhasil diubah.');
    }

    public function hapus_barang($idbarang)
    {
        // Cari barang berdasarkan ID
        $barang = Barang::find($idbarang);

        if (!$barang) {
            return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan.']);
        }

        // Lakukan penghapusan barang
        $barang->delete();

        return response()->json(['success' => true, 'message' => 'Barang berhasil dihapus.']);
    }
}
