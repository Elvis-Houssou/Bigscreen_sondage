<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ChoiceSeeder;
use Database\Seeders\SurveySeeder;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\ResponseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(SurveySeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(ChoiceSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(ResponseSeeder::class);

    }
}
