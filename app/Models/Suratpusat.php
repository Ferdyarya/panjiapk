<?php

namespace App\Models;

use App\Models\Mastercabang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suratpusat extends Model
{
    use HasFactory;
    protected $fillable = [
        'kodesurat','asalsurat','tujuan_surat','tentangsurat','filesurat','klasifikasi','id_mastercabang','tanggal'
    ];
    public function mastercabang()
    {
        return $this->hasOne(Mastercabang::class, 'id', 'id_mastercabang');
    }
}
