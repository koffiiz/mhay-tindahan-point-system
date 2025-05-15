<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Create 10 sample customers
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => "Customer $i",
                'email' => "customer$i@example.com",
                'password' => bcrypt('password'), // default password
                'role' => 'customer',
                'qr_token' => Str::uuid(),
            ]);
        }
    }
}
