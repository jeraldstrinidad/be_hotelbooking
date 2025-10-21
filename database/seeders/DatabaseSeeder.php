<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name'=>'Test User',
            'email'=>'user@example.com',
            'password'=>Hash::make('password')
        ]);

        Room::insert([
            ['name'=>'Standard Double','description'=>'Cozy room for two','capacity'=>2,'price_per_night'=>150,'available'=>true],
            ['name'=>'Deluxe Suite','description'=>'More space, great view','capacity'=>4,'price_per_night'=>300,'available'=>true],
            ['name'=>'Single Budget','description'=>'Good for solo travellers','capacity'=>1,'price_per_night'=>80,'available'=>true],
        ]);
    }
}
