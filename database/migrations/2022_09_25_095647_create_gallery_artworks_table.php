<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_artworks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gallery_id')
            ->constrained('galleries')
            ->onDelete('no action');

            $table->foreignId('artwork_id')
            ->constrained('artworks')
            ->onDelete('no action');

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
        Schema::dropIfExists('gallery_artworks');
    }
}
