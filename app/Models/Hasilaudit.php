<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasilaudit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nmrsurat','temuan','nilai','tanggal','id_mastercabang','status'
    ];
    public function mastercabang()
    {
        return $this->hasOne(Mastercabang::class, 'id', 'id_mastercabang');
    }
}
