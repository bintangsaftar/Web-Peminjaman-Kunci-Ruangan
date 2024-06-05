<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Mahasiswa extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'user_mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'password',
    ];

    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class, 'nama_mahasiswa', 'nim');
    }

}
