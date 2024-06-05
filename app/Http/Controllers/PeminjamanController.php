<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Session;
use Illuminate\Validation\Rule;
use App\Models\Ruangan;
use App\Models\Barang;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\Kelas;
use App\Models\Prodi;

class PeminjamanController extends Controller
{
    // function mengambil data dari database untuk digunakan di dropdown
    public function index_peminjaman()
    {
        //Ambil data dari model untuk digunakan dalam dropdown
        $dosens = Dosen::pluck('nama_dosen');
        $matkuls = Matkul::pluck('matkul');
        $ruangans = Ruangan::pluck('nama_ruangan');
        $barangs = Barang::select('nama_barang', 'merek_barang')->get();
        $kelass = Kelas::pluck('kelas');
        $prodis = Prodi::pluck('prodi');
        //melewati data yang diambil ke tampilan 'peminjaman'
        return view('peminjaman', compact('dosens', 'matkuls', 'ruangans', 'barangs', 'kelass', 'prodis'));
    }

    // function ini untuk menginput peminjaman
    public function input_peminjaman(Request $request)
    {
            //validasi input menggunakan Validasi Laravel
            $request->validate([
                'nama_peminjam' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
                'no_telp' => 'required|string|digits_between:9,13|regex:/^[0-9]+$/',
                'nim_peminjam' => 'required|string|max:12|regex:/^[0-9]+$/',
                'barang1' => 'nullable|not_in:Pilih Barang 1',
                'barang2' => 'nullable|not_in:Pilih Barang 2',
                'barang3' => 'nullable|not_in:Pilih Barang 3',


                'jam_peminjaman' => 'required', // Menyatakan bahwa harus diisi
                'jam_pengembalian' => 'required', // Menyatakan bahwa harus diisi
                'nama_dosen' => 'required', // Menyatakan bahwa harus diisi
                'nama_matakuliah' => 'required', // Menyatakan bahwa harus diisi
                'ruangan' => 'required', // Menyatakan bahwa harus diisi
                'tanggal' => 'required', // Menyatakan bahwa harus diisi
                'kelas' => 'required', // Menyatakan bahwa harus diisi
                'prodi' => 'required', // Menyatakan bahwa harus diisi
            ]);

            //membuat objek Peminjaman
            $peminjaman = new Peminjaman();

            //mengatur nilai atribut objek Peminjaman dari data yang diinputkan
            $peminjaman->jam_peminjaman = $request->input('jam_peminjaman');
            $peminjaman->jam_pengembalian = $request->input('jam_pengembalian');
            $peminjaman->nama_dosen = $request->input('nama_dosen');
            $peminjaman->nama_matakuliah = $request->input('nama_matakuliah');
            $peminjaman->ruangan = $request->input('ruangan');
            $peminjaman->barang1 = $request->input('barang1');
            $peminjaman->barang2 = $request->input('barang2');
            $peminjaman->barang3 = $request->input('barang3');
            $peminjaman->tanggal = $request->input('tanggal');
            $peminjaman->nama_peminjam = $request->input('nama_peminjam');
            $peminjaman->nim_peminjam = $request->input('nim_peminjam');
            $peminjaman->no_telp = $request->input('no_telp');
            $peminjaman->kelas = $request->input('kelas');
            $peminjaman->prodi = $request->input('prodi');

            // Set nilai jam peminjaman berdasarkan opsi yang dipilih
            if ($request->input('jam_peminjaman') === 'newOption') {
                $peminjaman->jam_peminjaman = $request->input('newJamPeminjaman');
            } else {
                $peminjaman->jam_peminjaman = $request->input('jam_peminjaman');
            }
            
            // Set nilai jam pengembalian berdasarkan opsi yang dipilih
            if ($request->input('jam_pengembalian') === 'newOption') {
                $peminjaman->jam_pengembalian = $request->input('newJamPengembalian');
            } else {
                $peminjaman->jam_pengembalian = $request->input('jam_pengembalian');
            }

            //menyimpan objek Peminjaman ke dalam database
            $peminjaman->save();

            // Definisi variabel yang hilang
            $jam_peminjaman = $request->input('jam_peminjaman');
            $jam_pengembalian = $request->input('jam_pengembalian');
            $nama_dosen = $request->input('nama_dosen');
            $nama_matakuliah = $request->input('nama_matakuliah');
            $ruangan = $request->input('ruangan');
            $barang1 = $request->input('barang1');
            $barang2 = $request->input('barang2');
            $barang3 = $request->input('barang3');
            $tanggal = $request->input('tanggal');
            $nama_peminjam = $request->input('nama_peminjam');
            $nim_peminjam = $request->input('nim_peminjam');
            $no_telp = $request->input('no_telp');
            $kelas = $request->input('kelas');
            $prodi = $request->input('prodi');

            //redirect kembali ke halaman peminjaman
            return redirect('/peminjaman')->with('success', 'Barang telah ditambahkan.');
    }
}
