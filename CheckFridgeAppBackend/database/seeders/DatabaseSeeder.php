<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            FridgesTableSeeder::class,
            ProductTableSeeder::class,
        ]);

        $fridges = \App\Models\Fridge::all();

        $fridges->each(function ($fridge) {
            $fridge->products()->attach(
                \App\Models\Product::all()->random(rand(1, 5))->pluck('id')->toArray()
            );
            $fridge->users()->attach(
                \App\Models\User::all()->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
