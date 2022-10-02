<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apellido;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => "Gonzalo",
            'email' => "admin@gonzalo.com",
            "password" => Hash::make("12345678"),
            "role" => "Admin"
        ]);
        Apellido::factory()->create([
            "user_id" => $user->id,
            "apellido" => "Bazzani",
        ]);

        Apellido::factory(100)->create();
    }
}