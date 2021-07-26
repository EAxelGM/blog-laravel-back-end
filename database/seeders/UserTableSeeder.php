<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Edgar Axel',
            'lastname' => 'Gonzalez Martinez',
            'email' => 'axel-canelo@hotmail.com',
            'password' => bcrypt('123456789'),
        ]);
        
        User::factory()->count(199)->create();
    }
}
