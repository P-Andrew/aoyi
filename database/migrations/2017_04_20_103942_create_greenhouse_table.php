<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenhouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('greenhouse',function(Blueprint $table){

            $table->increments('id');
            $table->string('name',100)->unique();
            $table->integer('ground_num')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('desc',255)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('greenhouse');
    }
}
