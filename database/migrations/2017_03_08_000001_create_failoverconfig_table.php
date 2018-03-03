<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFailoverconfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failoverconfigs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('var1', 255);
            $table->string('var2', 255);
            $table->string('var3', 255);
            $table->string('var4', 255);
            $table->timestamps();
        });

               DB::table('failoverconfigs')->insert([
            ['id' => 1, 'name' => 'this_server_id', 'var1' => '1', 'var2' => 'this server id','var3' => '','var4' => '' ],
            ['id' => 2, 'name' => 'active_server_id', 'var1' => '1', 'var2' => 'active server id','var3' => '','var4' => ''],
            ['id' => 3, 'name' => 'host', 'var1' => '192.168.11.91', 'var2' => 'this host ip','var3' => '','var4' => '' ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('failoverconfigs');
    }

}