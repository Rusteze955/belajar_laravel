<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // INSERT INTO users () VALUES ()
        uSER::create([
            'name' => 'Abdullah',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345')
        ]);
    }
}
