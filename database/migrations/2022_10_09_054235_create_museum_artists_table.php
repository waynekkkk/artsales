<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museum_artists', function (Blueprint $table) {
            $table->id();

            $table->foreignId('museum_id')
            ->constrained('museums')
            ->onDelete('no action');

            $table->foreignId('user_id')
            ->constrained('users')
            ->onDelete('no action');

            $table->dateTime('datetime_start');
            $table->dateTime('datetime_end');

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
        Schema::dropIfExists('museum_artists');
    }
}
