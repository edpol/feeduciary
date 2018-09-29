<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('history', function (Blueprint $table) {
            $table->increments('id');
            $table->char('zipcode',5)->index();
            $table->bigInteger('amount')->nullable(false)->unsigned();
            $table->integer('signup_id')->nullable(false)->unsigned();
            $table->boolean('downloaded')->default(false);
            $table->foreign('signup_id')->references('id')->on('signups')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
}
