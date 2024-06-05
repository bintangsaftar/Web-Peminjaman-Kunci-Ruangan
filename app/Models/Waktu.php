<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    protected $table = 'waktu';
    protected $primaryKey = 'idwaktu';
    protected $fillable = ['waktu'];
    public $timestamps = false;
}
