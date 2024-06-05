<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diterima;
use App\Models\riwayat;

class DiterimaController extends Controller
{
    public function index()
    {
        $data = Diterima::all();
        return view('diterima', ['data' => $data]);
    }
    public function riwayat(Request $request, $id)
    {
        $diterima = Diterima::find($id);

        // Pindahkan data ke tabel diterima
        riwayat::create($diterima->toArray());

        // Hapus data dari tabel req_peminjaman
        $diterima->delete();

        // Redirect atau tampilkan pesan sukses
        return response()->json(['message' => 'Kunci Ruangan dan Barang Sudah Selesai Dikembalikan']);
    }
}