<?php

use Illuminate\Database\Seeder;
use \App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Administrador Geral
        User::create([
            'id' => 1,
            'name' => 'Roberto Pinheiro',
            'email'  => 'robertopinheiro7843@gmail.com',
            'level' => 1,
            'password' => '$2y$10$efMzNcWnA1qrJ2bc2CKAAeVci1p2kbJ/vpOYDIN9BHYVBR/9v5b1K',
            'created_at' => '2022-04-16 13:28:10',
            'updated_at' => '2022-04-16 13:28:10'
        ]);

        // Administrador
        User::create([
            'id' => 2,
            'name' => 'Administrador',
            'email'  => 'administrador@gmail.com',
            'level' => 2,
            'password' => '$2y$10$6/tpEze8ZGFKEQP.niSuUucU0rV.aQDcX2ZhWezk7f4Njw5qFV5CO',
            'created_at' => '2022-04-16 13:28:10',
            'updated_at' => '2022-04-16 13:28:10'
        ]);

        // Guest
        User::create([
            'id' => 3,
            'name' => 'Fernanda Baos',
            'email'  => 'fernanda_baos@gmail.com',
            'level' => 0,
            'password' => '$2y$10$8MSGGTe.5xI9zKE./nlsoeP/rp5gW5gnErb5CkijlnvbObRfDnfO6',
            'created_at' => '2022-04-16 13:28:10',
            'updated_at' => '2022-04-16 13:28:10'
        ]);
        

    }
}