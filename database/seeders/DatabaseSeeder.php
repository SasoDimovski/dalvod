<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            CountriesSeeder::class,
            DocumentsSeeder::class,
            EmailTypeSeeder::class,
            ExpirationTimeSeeder::class,
            GroupsModulesSeeder::class,
            GroupsSeeder::class,
            GroupsUsersSeeder::class,
            LanguagesSeeder::class,
            ModulesDesignSeeder::class,
            ModulesSeeder::class,
            ModulesTypeSeeder::class,
            ModulesUsersSeeder::class,
            PasswordsSeeder::class,
            UsersSeeder::class,
        ]);
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
