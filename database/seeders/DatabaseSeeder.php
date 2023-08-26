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
            'name' => 'Nadya Safitri',
            'slug' => 'pembiming-Nadya',
            'roles' => 'PEMBIMBING',
            'email' => 'nadya@gmail.com',
            'nip' => 4321,
            'fakultas_id' => 1,           
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Dwi I',
            'slug' => 'pembiming-Dwi',
            'roles' => 'PEMBIMBING',
            'email' => 'dwi@gmail.com',
            'nip' => 12345,
            'fakultas_id' => 1,           
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Nada Aura Wansa',
            'slug' => 'user-Nada',
            'roles' => 'USER',
            'email' => 'nada@gmail.com',
            'fakultas_id' => 1,
            'programstudi' => 2,
            'npm' => 2019320020,
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Muhammad Aldisyah Rahman',
            'slug' => 'user-Aldis',
            'roles' => 'USER',
            'email' => 'aldisyah@gmail.com',
            'fakultas_id' => 1,
            'programstudi' => 2,
            'npm' => 2019320021,
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Dewi Ariani',
            'slug' => 'user-Ariani',
            'roles' => 'USER',
            'email' => 'ariani@gmail.com',
            'fakultas_id' => 1,
            'programstudi' => 3,
            'npm' => 2019330001,
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Inta Dzuhri Nugroho',
            'slug' => 'user-Inta',
            'roles' => 'USER',
            'email' => 'inta@gmail.com',
            'fakultas_id' => 1,
            'programstudi' => 1,
            'npm' => 2019320010,
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);

        User::create([
            'name' => 'Mutiara Vazzla Puteri',
            'slug' => 'user-Mutiara',
            'roles' => 'USER',
            'email' => 'mutiara@gmail.com',
            'fakultas_id' => 2,
            'programstudi' => 5,
            'npm' => 2019320011,
            'no_hp' => '0000',
            'password' => bcrypt('binainsani')
        ]);
    }
}
