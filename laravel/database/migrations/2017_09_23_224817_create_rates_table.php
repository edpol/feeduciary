<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roof')->unsigned();
            $table->decimal('rate',10,6)->nullable(false);
            $table->integer('advisor_id')->nullable(false)->unsigned();
            $table->foreign('advisor_id')->references('id')->on('advisors')->onDelete('cascade');
            $table->unique(['advisor_id','roof']);
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
        Schema::dropIfExists('rates');
    }
}
