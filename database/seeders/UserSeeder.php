<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create bigscreen admin
        User::create([
            'name' => 'Big Screen',
            'email' => 'bigscreen@example.com',
            'password' => Hash::make('azerty')
        ]);
    }
}
