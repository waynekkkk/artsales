<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->longText('description');

            $table->foreignId('artwork_id')
            ->nullable()
            ->constrained('artworks')
            ->onDelete('no action');

            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->onDelete('no action');

            $table->boolean('is_read')->default(0);

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
        Schema::dropIfExists('notifications');
    }
}
