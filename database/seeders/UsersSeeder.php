<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            "prenom" => "youssef",
            "tel" => "0611223344",
            "ville_id" => rand(1, 16),
            "is_admin" => 1,
            "password" => bcrypt("112233445"),
        ]);
        User::create([
            "prenom" => "oussama",
            "tel" => "0611223345",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
        User::create([
            "prenom" => "Hassan",
            "tel" => "0601234567",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
        User::create([
            "prenom" => "Fatima",
            "tel" => "0612345678",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
        
        User::create([
            "prenom" => "Mohamed",
            "tel" => "0623456789",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
        
        User::create([
            "prenom" => "Khadija",
            "tel" => "0634567890",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
        
        User::create([
            "prenom" => "Rachid",
            "tel" => "0645678901",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
        
        User::create([
            "prenom" => "Salma",
            "tel" => "0656789012",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
        
        User::create([
            "prenom" => "Anas",
            "tel" => "0667890123",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
        
        User::create([
            "prenom" => "Imane",
            "tel" => "0678901234",
            "ville_id" => rand(1, 16),
            "password" => bcrypt("1122334455"),
        ]);
    }
}
