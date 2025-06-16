<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\Masterpegawai;

use App\Models\User;
use App\Models\Masteranggota;
use App\Models\Masterpegawai;
use Illuminate\Database\Seeder;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::table('masterpegawais')->insert([
        //     'kode' => '1111',
        //     'nama' => 'Hendra',
        //     'no_telp' => '081999234478',
        // ]);

        User::create([
            'name' => 'Riska',
            'email' => 'riska@gmail.com',
            'password' => bcrypt('1'),
            'roles' => 'pimpinan'
        ]);
        User::create([
            'name' => 'Panji',
            'email' => 'panji@gmail.com',
            'password' => bcrypt('2'),
            'roles' => 'admin'
        ]);
        User::create([
            'name' => 'Mike',
            'email' => 'mike@gmail.com',
            'password' => bcrypt('2'),
            'roles' => 'auditor'
        ]);

        User::create([
            'name' => 'Reza',
            'email' => 'reza@gmail.com',
            'password' => bcrypt('3'),
            'roles' => 'petugas'
        ]);

        Masterpegawai::create([
            'nama' => 'oki',
            'email' => 'oki@gmail.com',
            'no_telp' => '91919191',
            'jabatan' => 'kepala lppk',
            'jeniskelamin' => 'laki-laki',
        ]);

    }
}
