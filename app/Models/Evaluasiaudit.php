<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasiaudit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nmrsurat','auditor','keterangan','tanggal','saran','id_mastercabang'
    ];
    public function mastercabang()
    {
        return $this->hasOne(Mastercabang::class, 'id', 'id_mastercabang');
    }
}
