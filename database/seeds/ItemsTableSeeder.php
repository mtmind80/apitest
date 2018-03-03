<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

use \App\Item;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        $fake = Faker::create();

        foreach (range(1, 10) as $index) {
            Item::create([
                'name'        => $fake->sentence(4),
                'description' => $fake->paragraph(3),
                'disabled'    => $fake->boolean(),
            ]);
        }
    }
}