<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Users\Domain\Model\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
   
    const RESULTS = 5;
   
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < self::RESULTS; $i++) {
            $name = $faker->name;
            
            User::create([
                'name' => $name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make($name), 
            ]);
        }
    }
}