<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('title_slug');
            $table->string('title_image');
            $table->string('desciption')->nullable();
            $table->string('url')->nullable();
            $table->smallInteger('is_hot');
            $table->smallInteger('is_valid');//Co duoc phep hien thi len trang web
            $table->string('type');//thanh vien hoac tat cac moi nguoi co the xem video
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->softDeletes();
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
        Schema::dropIfExists('videos');
    }
}
