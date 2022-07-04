<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'nis',
        'nama_siswa',
        "tempat_lahir",
        "tanggal_lahir",
        "jenis_kelamin",
        "alamat",
        "foto_siswa",
        "id_kelas",
        "username",
        "password"
    ];
}
