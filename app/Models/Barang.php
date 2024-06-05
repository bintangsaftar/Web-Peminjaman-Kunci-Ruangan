<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'idbarang';
    protected $fillable = ['kode_barang', 'nama_barang', 'deskripsi_barang', 'status_barang', 'merek_barang'];
    public $timestamps = false;
}
