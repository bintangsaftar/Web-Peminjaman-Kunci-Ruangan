<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'idkelas';
    protected $fillable = ['kelas'];
    public $timestamps = false;
}
