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
            "ville_id" => 5,
            "password" => bcrypt("112233445"),
        ]);
    }
}
