<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'nombre' => 'Admin',
            'correo' => 'admin@gmail.com',
            'contrasena' => bcrypt('12345678'),
            'rol_id' => 3,
            'telefono' => '69038862',
            'direccion' => 'B/adsd',
        ]);
    }
}
