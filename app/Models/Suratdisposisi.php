<?php

namespace App\Models;

use App\Models\Mastercabang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suratdisposisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nmrsurat','tglterima','asal','sifat','perihal','diteruskan','catatan','disposisi','id_mastercabang','id_masterpegawai','lampiran'
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
