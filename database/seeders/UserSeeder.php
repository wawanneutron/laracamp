<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name'      =>  'Admin Laracamp',
            'email'     =>  'admin@laracamp.test',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password'  =>  bcrypt('password'),
            'is_admin'  =>  true,
        ]);
    }
}
