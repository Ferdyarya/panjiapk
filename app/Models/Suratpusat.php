<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratpusat extends Model
{
    use HasFactory;
    protected $fillable = [
        'kodesurat','asalsurat','tujuan_surat','tentangsurat','filesurat','klasifikasi'
    ];
    // public function masterbuku()
    // {
    //     return $this->hasOne(Masterbuku::class, 'id', 'id_buku');
    // }
}
