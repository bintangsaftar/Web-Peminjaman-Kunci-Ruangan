<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'idprodi';
    protected $fillable = ['prodi'];
    public $timestamps = false;
}
