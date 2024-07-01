<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(2)->create();

        Document::factory(10)->create();
    }
}
