<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdaColumnStatusToJadwalPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_presensis', function (Blueprint $table) {
            $table->integer('status')->default(0)->after('kode_presensi');
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
            $table->dropColumn('status');
        });
    }
}
