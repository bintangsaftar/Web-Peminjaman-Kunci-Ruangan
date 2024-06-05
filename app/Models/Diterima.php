<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diterima extends Model
{
    protected $table = 'diterima';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jam_peminjaman',
        'jam_pengembalian',
        'nama_dosen',
        'nama_matakuliah',
        'ruangan',
        'barang1',
        'barang2',
        'barang3',
        'tanggal',
        'nama_peminjam',
        'nim_peminjam',
        'no_telp',
        'kelas',
        'prodi',
    ];
    public $timestamps = false;

}