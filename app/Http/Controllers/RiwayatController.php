<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\riwayat;
use App\Models\Ruangan;

class RiwayatController extends Controller
{
    public function index()
    {
        $data = riwayat::all();
        $ruangans = Ruangan::pluck('nama_ruangan');
        return view('riwayat-list-admin', compact('data', 'ruangans'));
    }

    public function filter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $room = $request->input('room');
        
        // Query ke database berdasarkan kriteria pencarian
        $data = riwayat::query()
        ->when($start_date, function ($query) use ($start_date) {
            return $query->whereDate('tanggal', '>=', $start_date);
        })
        
        ->when($end_date, function ($query) use ($end_date) {
            return $query->whereDate('tanggal', '<=', $end_date);
        })
        
        ->when($room, function ($query) use ($room) {
            return $query->where('ruangan', $room);
        })
        
        ->get();
        
        // Mengambil kembali data ruangan untuk dropdown
        $ruangans = Ruangan::pluck('nama_ruangan');
        
        // Mengirim kembali data yang difilter dan data ruangan ke view
        return view('riwayat-list-admin', compact('data', 'ruangans'));
    }
    
    public function showDiagram()
    {
        // Ambil data jumlah peminjaman ruangan dari model Riwayat
        $dataPeminjamanRuangan = riwayat::select('ruangan', \DB::raw('COUNT(*) as total_peminjaman'))
            ->groupBy('ruangan')
            ->pluck('total_peminjaman', 'ruangan')
            ->toArray();

        // Ambil semua nama ruangan dari model Ruangan
        $ruangans = Ruangan::pluck('nama_ruangan')->toArray();

        // Kirim data ke view
        return view('riwayat-diagram-admin', compact('dataPeminjamanRuangan', 'ruangans'));
    }

    public function filterDiagram(Request $request)
    {
        $date = $request->input('date'); // Ambil nilai bulan dan tahun (format: 'YYYY-MM')

        // Jika tidak ada input bulan dan tahun, tampilkan semua data
        if (!$date) {
            $dataPeminjamanRuangan = riwayat::select('ruangan', \DB::raw('COUNT(*) as total_peminjaman'))
                ->groupBy('ruangan')
                ->pluck('total_peminjaman', 'ruangan')
                ->toArray();
        } else {
            // Parsing nilai bulan dan tahun dari input
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));

            // Filter berdasarkan bulan dan tahun dari tanggal
            $dataPeminjamanRuangan = riwayat::whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->select('ruangan', \DB::raw('COUNT(*) as total_peminjaman'))
                ->groupBy('ruangan')
                ->pluck('total_peminjaman', 'ruangan')
                ->toArray();
        }

        // Ambil semua nama ruangan dari model Ruangan
        $ruangans = Ruangan::pluck('nama_ruangan')->toArray();

        // Kirim data ke view
        return view('riwayat-diagram-admin', compact('dataPeminjamanRuangan', 'ruangans'));
    }

    public function index_mahasiswa()
    {
        $data = riwayat::all();
        $ruangans = Ruangan::pluck('nama_ruangan');
        return view('riwayat-list-mahasiswa', compact('data', 'ruangans'));
    }

    public function filter_mahasiswa(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $room = $request->input('room');
        
        // Query ke database berdasarkan kriteria pencarian
        $data = riwayat::query()
        ->when($start_date, function ($query) use ($start_date) {
            return $query->whereDate('tanggal', '>=', $start_date);
        })
        
        ->when($end_date, function ($query) use ($end_date) {
            return $query->whereDate('tanggal', '<=', $end_date);
        })
        
        ->when($room, function ($query) use ($room) {
            return $query->where('ruangan', $room);
        })
        
        ->get();
        
        // Mengambil kembali data ruangan untuk dropdown
        $ruangans = Ruangan::pluck('nama_ruangan');
        
        // Mengirim kembali data yang difilter dan data ruangan ke view
        return view('riwayat-list-mahasiswa', compact('data', 'ruangans'));
    }
    
    public function showDiagram_mahasiswa()
    {
        // Ambil data jumlah peminjaman ruangan dari model Riwayat
        $dataPeminjamanRuangan = riwayat::select('ruangan', \DB::raw('COUNT(*) as total_peminjaman'))
            ->groupBy('ruangan')
            ->pluck('total_peminjaman', 'ruangan')
            ->toArray();

        // Ambil semua nama ruangan dari model Ruangan
        $ruangans = Ruangan::pluck('nama_ruangan')->toArray();

        // Kirim data ke view
        return view('riwayat-diagram-mahasiswa', compact('dataPeminjamanRuangan', 'ruangans'));
    }

    public function filterDiagram_mahasiswa(Request $request)
    {
        $date = $request->input('date'); // Ambil nilai bulan dan tahun (format: 'YYYY-MM')

        // Jika tidak ada input bulan dan tahun, tampilkan semua data
        if (!$date) {
            $dataPeminjamanRuangan = riwayat::select('ruangan', \DB::raw('COUNT(*) as total_peminjaman'))
                ->groupBy('ruangan')
                ->pluck('total_peminjaman', 'ruangan')
                ->toArray();
        } else {
            // Parsing nilai bulan dan tahun dari input
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));

            // Filter berdasarkan bulan dan tahun dari tanggal
            $dataPeminjamanRuangan = riwayat::whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->select('ruangan', \DB::raw('COUNT(*) as total_peminjaman'))
                ->groupBy('ruangan')
                ->pluck('total_peminjaman', 'ruangan')
                ->toArray();
        }

        // Ambil semua nama ruangan dari model Ruangan
        $ruangans = Ruangan::pluck('nama_ruangan')->toArray();

        // Kirim data ke view
        return view('riwayat-diagram-mahasiswa', compact('dataPeminjamanRuangan', 'ruangans'));
    }

}