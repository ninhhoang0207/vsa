<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsWaitingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_waitings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('title_slug');
            $table->string('title_image');
            $table->string('video')->nullable();
            $table->text('description');
            $table->text('content');
            $table->integer('views');
            $table->smallInteger('is_hot');
            $table->smallInteger('is_valid');
            $table->string('view_mode');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->datetime('posted_at')->nullable();
            $table->integer('news_id')->nullable();
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
        Schema::dropIfExists('news_waitings');
    }
}
