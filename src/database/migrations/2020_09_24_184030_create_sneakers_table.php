<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSneakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sneakers', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id');
            $table->string('sneaker_name');
			$table->enum('hyper_level', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
			$table->string('price', 50);
			$table->dateTime('release_date', 0);
			
            $table->timestamps();
			
			/*$table->foreign('user_id')
            ->references('id')->on('users')
            ->on('users');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sneakers');
    }
}
