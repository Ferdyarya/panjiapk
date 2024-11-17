<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masteranggota extends Model
{
    use HasFactory;
    protected $fillable = [
         'email', 'no_telp','kelas','jeniskelamin','tgl_lahir','status','id_anggota'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_anggota');
    }
}
