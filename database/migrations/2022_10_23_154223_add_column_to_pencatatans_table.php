<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPencatatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pencatatans', function (Blueprint $table) {
            $table->string('jenis_kitab')->nullable()->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pencatatans', function (Blueprint $table) {
            $table->dropColumn('jenis_kitab');
        });
    }
}
