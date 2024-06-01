<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'usertype' => 'adm',
            'password' => Hash::make('password0'),

        ]);

        User::factory()->create([
            'name' => 'Recruiter',
            'email' => 'recruiter@gmail.com',
            'usertype' => 'rec',
            'password' => Hash::make('password1'),

        ]);

        User::factory()->create([
            'name' => 'Candidate',
            'email' => 'user@gmail.com',
            'usertype' => 'cnd',
            'password' => Hash::make('password2'),

        ]);

        Category::create(['name' => 'Information Technology']);
        Category::create(['name' => 'Industrial']);
        Category::create(['name' => 'Construction']);
        Category::create(['name' => 'Business']);
        Category::create(['name' => 'Visual Arts and Design']);
        Category::create(['name' => 'Science']);
        Category::create(['name' => 'Medical']);
        Category::create(['name' => 'Education']);



    }

     
}
 
