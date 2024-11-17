<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\Masterpegawai;

use App\Models\Masteranggota;
use App\Models\User;
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
            'name' => 'Reza',
            'email' => 'reza@gmail.com',
            'password' => bcrypt('3'),
            'roles' => 'petugas'
        ]);

    }
}
