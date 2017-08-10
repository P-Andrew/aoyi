<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->nullable();
            $table->string('company_log')->nullable();
            $table->string('company_info')->nullable();
            $table->string('server_phone')->nullable();
            $table->string('company_address')->nullable();
            $table->string('pay_left_time')->nulllable();
            $table->string('ground_left_time')->nullable();
            $table->text('help')->nullable();
            $table->text('about')->nullable();
            $table->longText('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system');
    }
}
