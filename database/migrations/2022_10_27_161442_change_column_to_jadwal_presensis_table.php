<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToJadwalPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_presensis', function (Blueprint $table) {
            $table->dateTime('tanggal_awal')->nullable()->change();
            $table->dateTime('tanggal_akhir')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_presensis', function (Blueprint $table) {
            //
        });
    }
}
