<?php

namespace App\Models;

use App\Models\Mastercabang;
use App\Models\Masterpegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izinkunjungan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kodesurat','tujuan_surat','tanggal','id_masterpegawai','id_mastercabang','keterangan'
    ];

    public function mastercabang()
    {
        return $this->hasOne(Mastercabang::class, 'id', 'id_mastercabang');
    }

    public function masterpegawai()
    {
        return $this->hasOne(Masterpegawai::class, 'id', 'id_masterpegawai');
    }
}
