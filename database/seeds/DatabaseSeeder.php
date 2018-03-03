<?php

use Illuminate\Database\Seeder;

use App\Item;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Item::truncate();

        $this->call(ItemsTableSeeder::class);
    }
}