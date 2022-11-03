<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKodePresensiToPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->integer('jadwal_presensi_id')->nullable()->after('tanggal_izin');
            $table->text('kode_jadwal_presensi')->nullable()->after('jadwal_presensi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->dropColumn('jadwal_presensi_id');
            $table->dropColumn('kode_jadwal_presensi');
        });
    }
}
