<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index_mengelola_ruangan()
    {
        $ruanganItems = Ruangan::all();
        return view('mengelolaRuangan', compact('ruanganItems'));
    }

    public function index_tambah_ruangan()
    {
        return view('tambahRuangan');
    }

    public function tambah_ruangan(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|string|max:7',
            'nama_ruangan' => 'required|string|max:25',
            'luas_ruangan' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Validasi untuk angka 0 sampai 30
                    $numericValue = intval($value);
                    if (!is_numeric($value)) {
                        $fail("Kolom Luas Ruangan hanya boleh mengandung karakter angka.");
                    } elseif ($numericValue >= 0 && $numericValue <= 30) {
                        $fail("Kolom Luas Ruangan hanya boleh di antara 31 dan 99");
                    }
                },
                function ($attribute, $value, $fail) {
                    // Menghitung panjang string setelah menambahkan " m²"
                    $lengthAfterAddition = strlen($value . " m²");

                    // Melakukan validasi panjang maksimum
                    if ($lengthAfterAddition > 6) {
                        $fail("Kolom Luas Ruangan tidak boleh lebih dari 5 karakter.");
                    }
                },
            ],
            'status_ruangan' => 'required|string',
        ], [
            'kode_ruangan.required' => 'Kolom Kode Ruangan harus diisi.',
            'kode_ruangan.max' => 'Kolom Kode Ruangan tidak boleh lebih dari 7 karakter.',
            'nama_ruangan.required' => 'Kolom Nama Ruangan harus diisi.',
            'nama_ruangan.max' => 'Kolom Nama Ruangan tidak boleh lebih dari 25 karakter.',
            'luas_ruangan.required' => 'Kolom Luas Ruangan harus diisi.',
            'status_ruangan.required' => 'Kolom Status Ruangan harus diisi.',
        ]);

        $luasRuangan = $request->input('luas_ruangan');

        // Menambahkan " m²" di belakang nilai
        $luasRuangan .= " m²";

        Ruangan::create([
            'kode_ruangan' => $request->input('kode_ruangan'),
            'nama_ruangan' => $request->input('nama_ruangan'),
            'luas_ruangan' => $luasRuangan,
            'status_ruangan' => $request->input('status_ruangan'),
        ]);

        return redirect('/mengelola-ruangan')->with('success', 'Ruangan telah ditambahkan.');
    }

    public function index_ubah_ruangan($idruangan)
    {
        $ruanganItems = Ruangan::all()->where('idruangan', $idruangan);
        return view('ubahRuangan', compact('ruanganItems'));
    }

    public function ubah_ruangan(Request $request, $idruangan)
    {
        $ruanganItems =  Ruangan::findOrFail($idruangan);

        $request->validate([
            'kode_ruangan' => 'required|string|max:7',
            'nama_ruangan' => 'required|string|max:25',
            'luas_ruangan' => [
                'required',
                'string',
                'regex:/^[1-9][0-9]*(?:\s*m²)?$/',
                function ($attribute, $value, $fail) {
                    // Menghitung panjang string setelah menambahkan " m²"
                    $lengthAfterAddition = strlen($value . " m²");

                    // Melakukan validasi panjang maksimum
                    if ($lengthAfterAddition > 6) {
                        $fail("Kolom Luas Ruangan tidak boleh lebih dari 5 karakter.");
                    }

                    // Validasi tambahan untuk angka 0
                    if ($value === '0') {
                        $fail("Kolom Luas Ruangan tidak bisa 0.");
                    }
                },
            ],
            'status_ruangan' => 'required|string',
        ], [
            'kode_ruangan.required' => 'Kolom Kode Ruangan harus diisi.',
            'kode_ruangan.max' => 'Kolom Kode Ruangan tidak boleh lebih dari 7 karakter.',
            'nama_ruangan.required' => 'Kolom Nama Ruangan harus diisi.',
            'nama_ruangan.max' => 'Kolom Nama Ruangan tidak boleh lebih dari 25 karakter.',
            'luas_ruangan.required' => 'Kolom Luas Ruangan harus diisi.',
            'luas_ruangan.regex' => 'Kolom Luas Ruangan hanya boleh mengandung khusus karakter angka.',
            'status_ruangan.required' => 'Kolom Status Ruangan harus diisi.',
        ]);

        $luasRuangan = $request->input('luas_ruangan');

        // Menambahkan " m²" di belakang nilai
        $luasRuangan .= " m²";

        $ruanganItems->update([
            'kode_ruangan' => $request->input('kode_ruangan'),
            'nama_ruangan' => $request->input('nama_ruangan'),
            'luas_ruangan' => $luasRuangan,
            'status_ruangan' => $request->input('status_ruangan'),
        ]);

        return redirect('/mengelola-ruangan')->with('success', 'Ruangan berhasil diubah.');
    }

    public function hapus_ruangan($idruangan)
    {
        // Cari ruangan berdasarkan ID
        $ruangan = Ruangan::find($idruangan);

        if (!$ruangan) {
            return response()->json(['success' => false, 'message' => 'Ruangan tidak ditemukan.']);
        }

        // Lakukan penghapusan ruangan
        $ruangan->delete();

        return response()->json(['success' => true, 'message' => 'Ruangan berhasil dihapus.']);
    }
}
