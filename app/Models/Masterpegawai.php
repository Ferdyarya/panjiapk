<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterpegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'email','no_telp','jabatan','jeniskelamin'
   ];
}
