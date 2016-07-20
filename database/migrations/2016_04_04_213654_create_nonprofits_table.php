<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonprofitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonprofits', function ($table) {
            $table->increments('id');
            $table->string('ein')->unique();
            $table->string('name');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('deductibility_status_code');
        });

        DB::statement('ALTER TABLE nonprofits ADD FULLTEXT nonprofit_vector(name, city, ein)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nonprofits', function($table) {
            $table->dropIndex('nonprofit_search');
        });

        Schema::drop('nonprofits');
    }
}
