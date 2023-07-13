<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'SUPER ADMIN',
            'slug' => 'spadmin-admin-pendidikan',
            'roles' => 'SUPER_ADMIN',
            'email' => 'spadmin@gmail.com',
            
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Admin Pendidikan 1 (ADMIN)',
            'slug' => 'admin-pendidikan',
            'roles' => 'ADMIN',
            'email' => 'pendidikan@gmail.com',
            
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Nada Aura Wansa (Mahasiswa)',
            'slug' => 'user-Nada',
            'roles' => 'USER',
            'email' => 'nada@gmail.com',
            
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Nadya Safitri (Pembimbing)',
            'slug' => 'pembiming-Nadya',
            'roles' => 'PEMBIMBING',
            'email' => 'nadya@gmail.com',
            
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);
    }
}
