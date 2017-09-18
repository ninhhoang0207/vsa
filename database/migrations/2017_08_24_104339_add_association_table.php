<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssociationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('associations', function (Blueprint $table) {
            //
            $table->date('birthday')->nullable();
            $table->string('position')->nullable();
            $table->string('hotline')->nullable();
            $table->string('action_process')->nullable();
            $table->string('info_add')->nullable();
            $table->string('train_process')->nullable();
            $table->string('company')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('associations', function (Blueprint $table) {
            //
            $table->dropColumn('birthday');
            $table->dropColumn('position');
            $table->dropColumn('hotline');
            $table->dropColumn('action_process');
            $table->dropColumn('info_add');
            $table->dropColumn('train_process');
            $table->dropColumn('company');
        });
    }
}
