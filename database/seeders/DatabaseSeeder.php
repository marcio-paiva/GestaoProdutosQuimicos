<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Marcio Solicitante',
            'email' => 'marcio@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'solicitante',
        ]);

        User::create([
            'name' => 'Tech Avaliador',
            'email' => 'tech@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'avaliador',
        ]);

        User::create([
            'name' => 'Administrador',
            'email' => 'adm@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'adm',
        ]);
    }
}