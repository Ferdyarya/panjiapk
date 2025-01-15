<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izinusaha extends Model
{
    use HasFactory;
    protected $fillable = [
        'kodesurat','tujuan_surat','atasnama','tanggal','keterangan','kategoripertanian'
    ];
}
