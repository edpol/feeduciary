<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('advisors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('name')->index()->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('st')->nullable();
            $table->string('zip')->nullable();
            $table->string('url')->nullable();
            $table->string('facebook')->nullable();
            $table->string('finraBrokercheck')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->integer('discretionaryAUM')->unsigned()->default(0);
            $table->integer('minimum_amt')->unsigned()->default(0);
            $table->integer('maximum_amt')->unsigned()->default(10000000);
            $table->integer('minimum_fee')->unsigned()->default(0);
            $table->integer('feeCalculation')->default(0);
            $table->decimal('lat', 11, 7)->default(0);
            $table->decimal('lng', 11, 7)->default(0);
            $table->timestamps();
            $table->string('brochure')->nullable();
            $table->text('bio')->nullable();
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
        Schema::dropIfExists('advisors');
    }
}
