<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonprofitsStagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonprofits_staging', function ($table) {
            $table->increments('id');
            $table->string('ein')->unique();
            $table->string('name');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('deductibility_status_code');
            $table->tsvector('nonprofit_vector');
            $table->gin('nonprofit_vector');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nonprofits_staging');
    }
}
