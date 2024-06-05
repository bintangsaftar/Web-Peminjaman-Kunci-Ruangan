<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $primaryKey = 'idmatkul';
    protected $fillable = ['kode_matkul', 'matkul', 'sks'];
    public $timestamps = false;
}
