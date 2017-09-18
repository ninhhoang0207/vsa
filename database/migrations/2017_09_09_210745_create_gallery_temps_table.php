<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_temps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id');
            $table->string('title');
            $table->string('title_slug');
            $table->string('avatar');
            $table->text('content');
            $table->integer('is_active')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->dateTime('posted_at')->nullable();
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
        Schema::dropIfExists('gallery_temps');
    }
}
