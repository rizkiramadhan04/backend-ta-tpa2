<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAlasanIzinToPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->text('alasan_izin')->nullable()->after('tanggal_izin');
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
            $table->dropColumn('alasan_izin');
        });
    }
}
