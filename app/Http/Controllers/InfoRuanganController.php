<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Diterima;
use Illuminate\Http\Request;

class InfoRuanganController extends Controller
{
        public function index()
    { 
        // Mengambil data dari model Ruangan
        $data = Ruangan::all();
        // Mengambil data dari model Diterima
        $datainfo = Diterima::all();
        return view('inforuangan-mahasiswa', compact('data', 'datainfo'));    
    }

    public function index_admin()
    { 
        // Mengambil data dari model Ruangan
        $data = Ruangan::all();
        // Mengambil data dari model Diterima
        $datainfo = Diterima::all();
        return view('inforuangan-admin', compact('data', 'datainfo'));    
    }
}









// class InfoRuanganController extends Controller
// {
//     public function index()
//     {
//         // Ambil data dari model Ruangan
//         $ruanganData = Ruangan::all();

//         // Ambil data terkait dari model Diterima berdasarkan hubungan yang telah ditentukan
//         $data = [];
//         foreach ($ruanganData as $ruangan) {
//             $relatedData = $ruangan->diterimas;
//             foreach ($relatedData as $item) {
//                 $data[] = [
//                     'ruangan' => $ruangan->nama_ruangan,
//                     'tanggal' => $item->tanggal,
//                     'waktu_peminjaman' => $item->jam_peminjaman,
//                     'waktu_pengembalian' => $item->jam_pengembalian,
//                     'nama_peminjam' => $item->nama_peminjam,
//                     'prodi' => $item->prodi,
//                     'kelas' => $item->kelas,
//                     'status' => $item->status, // Anda mungkin perlu menyesuaikan ini berdasarkan struktur data aktual Anda
//                 ];
//             }
//         }

//         return view('inforuangan', compact('data'));
//     }
// }

