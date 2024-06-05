<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Diterima;
use App\Models\Ditolak;

class PersetujuanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::all();
        return view('persetujuan', ['data' => $data]);
    }

    public function terima(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);

        // Pindahkan data ke tabel diterima
        Diterima::create($peminjaman->toArray());

        // Hapus data dari tabel req_peminjaman
        $peminjaman->delete();

        // Redirect atau tampilkan pesan sukses
        return response()->json(['message' => 'Peminjaman berhasil disetujui']);
    }

    public function tolak(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);

        // Pindahkan data ke tabel diterima
        Ditolak::create($peminjaman->toArray());

        // Hapus data dari tabel req_peminjaman
        $peminjaman->delete();

        // Redirect atau tampilkan pesan sukses
        return response()->json(['message' => 'Peminjaman berhasil ditolak']);
    }

}