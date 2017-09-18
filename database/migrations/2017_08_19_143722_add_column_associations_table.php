<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('associations', function ($table) {
            if (!Schema::hasColumn('associations','product')) {
               $table->string('product')->nullable()->after('action_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('associations', function (Blueprint $table) {
            //
            $table->dropColumn('product');
        });
    }
}
