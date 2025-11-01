<?php

namespace Database\Seeders;

use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => SlugService::createSlug(User::class, 'username', 'Jon Doe'),
            'first_name' => 'Jon',
            'last_name' => 'doe',
            'email' => 'jon@test.com',
            'password' => 'pass',
        ]);

        User::factory(2)->create();
    }
}
