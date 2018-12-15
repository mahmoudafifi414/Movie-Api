<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->longText('description');
            $table->longText('image_url');
            $table->float('rating',4,2);
            $table->integer('release_year');
            $table->string('gross_profit');
            $table->string('director',100);
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
        Schema::table('create', function (Blueprint $table) {
            //
        });
    }
}
