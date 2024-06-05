<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'iddosen';
    protected $fillable = ['nipk', 'nama_dosen'];
    public $timestamps = false;
}
