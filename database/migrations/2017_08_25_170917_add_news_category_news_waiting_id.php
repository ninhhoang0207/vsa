<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewsCategoryNewsWaitingId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_category', function (Blueprint $table) {
            //
            $table->integer('news_befor_update_id')->nullable();
            $table->integer('news_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_category', function (Blueprint $table) {
            //
            // $table->dropcolumn('news_waiting_id');
            $table->dropColumn('news_befor_update_id');
        });
    }
}
