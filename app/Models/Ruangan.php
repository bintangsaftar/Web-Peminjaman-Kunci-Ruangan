<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'idruangan';
    protected $fillable = ['nama_ruangan', 'kode_ruangan', 'luas_ruangan', 'status_ruangan'];
    public $timestamps = false;
}