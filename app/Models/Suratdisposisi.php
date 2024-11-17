<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratdisposisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nmrsurat','tglterima','asal','sifat','perihal','diteruskan','catatan','disposisi'
    ];
}
