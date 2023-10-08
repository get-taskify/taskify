<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        \App\Models\User::create([
            'name' => 'Tim Tester',
            'email' => 'test@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => 'fisch123'
        ]);
        \App\Models\User_role::create([
            'role' => 1,
            'user_id' => 1,
            'created_at' => now()
        ]);
        \App\Models\User::factory(5)->create();
        \App\Models\Workshop::factory(5)->create();
        \App\Models\News::factory(5)->create();
        \App\Models\Repair_object::factory(5)->create();
        \App\Models\Note::factory(5)->create();
        \App\Models\Assignment::factory(5)->create();
        \App\Models\Task::factory(10)->create();
        \App\Models\Pc::factory(1)->create();
        // \App\Models\Default_task::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
