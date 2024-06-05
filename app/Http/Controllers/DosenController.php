<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index_mengelola_dosen() {
        $dosenItems = Dosen::all();
        return view('mengelolaDosen', compact('dosenItems'));
    }

    public function index_tambah_dosen()
    {
        return view('tambahDosen');
    }

    public function tambah_dosen(Request $request)
    {
        $request->validate([
            'nipk' => 'required|string|max:18|regex:/^[0-9.]+$/',
            'nama_dosen' => 'required|string|max:100',
        ], [
            'nipk.required' => 'Kolom NIP/NIK harus diisi.',
            'nipk.max' => 'Kolom NIP/NIK tidak boleh lebih dari 18 karakter.',
            'nipk.regex' => 'Kolom NIP/NIK hanya boleh mengandung khusus karakter angka. (Simbol titik diperbolehkan)',
            'nama_dosen.required' => 'Kolom Nama Dosen harus diisi.',
            'nama_dosen.max' => 'Kolom Nama Dosen tidak boleh lebih dari 100 karakter.',
        ]);

        Dosen::create([
            'nipk' => $request->input('nipk'),
            'nama_dosen' => $request->input('nama_dosen'),
        ]);

        return redirect('/mengelola-dosen')->with('success', 'Dosen telah ditambahkan.');
    }

    public function index_ubah_dosen($iddosen)
    {
        $dosenItems = Dosen::all()->where('iddosen', $iddosen);
        return view('ubahDosen', compact('dosenItems'));
    }

    public function ubah_dosen(Request $request, $iddosen)
    {
        $dosenItems =  Dosen::findOrFail($iddosen);

        $request->validate([
            'nipk' => 'required|string|max:18|regex:/^[0-9.]+$/',
            'nama_dosen' => 'required|string|max:100',
        ], [
            'nipk.required' => 'Kolom NIP/NIK harus diisi.',
            'nipk.max' => 'Kolom NIP/NIK tidak boleh lebih dari 18 karakter.',
            'nipk.regex' => 'Kolom NIP/NIK hanya boleh mengandung khusus karakter angka. (Simbol titik diperbolehkan)',
            'nama_dosen.required' => 'Kolom Nama Dosen harus diisi.',
            'nama_dosen.max' => 'Kolom Nama Dosen tidak boleh lebih dari 100 karakter.',
        ]);

        $dosenItems->update([
            'nipk' => $request->input('nipk'),
            'nama_dosen' => $request->input('nama_dosen'),
        ]);

        return redirect('/mengelola-dosen')->with('success', 'Dosen berhasil diubah.');
    }

    public function hapus_dosen($iddosen)
    {
        // Cari dosen berdasarkan ID
        $dosen = Dosen::find($iddosen);

        if (!$dosen) {
            return response()->json(['success' => false, 'message' => 'Dosen tidak ditemukan.']);
        }

        // Lakukan penghapusan dosen
        $dosen->delete();

        return response()->json(['success' => true, 'message' => 'Dosen berhasil dihapus.']);
    }
}
