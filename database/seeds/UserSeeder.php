<?php

use Illuminate\Database\Seeder;
use App\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@inventory.com',
            'id_level' => 1,
            'password' => Hash::make('123456')
            ]);
        }
    }
