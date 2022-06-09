<?php

use Illuminate\Database\Seeder;
use \App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Roberto Pinheiro',
            'email'  => 'robertopinheiro7843@gmail.com',
            'password' => '12345678',
            'created_at' => '2022-04-16 13:28:10',
            'updated_at' => '2022-04-16 13:28:10'
        ]);
        
    }
}