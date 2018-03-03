<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('description', 255);
            $table->boolean('disabled')->default(0);
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Admin User', 'email' => 'admin@localhost.com', 'password' => bcrypt('password')],
            ['id' => 2, 'name' => 'Auth User',  'email' => 'user@localhost.com',     'password' => bcrypt('password')],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }

}