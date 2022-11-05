<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNoSurahToPencatatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pencatatans', function (Blueprint $table) {
            $table->integer('no_surah')->unsigned()->nullable()->after('murid_id');
            $table->integer('guru_id')->unsigned()->nullable()->after('jenis_kitab');
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
            $table->dropColumn('no_surah');
            $table->dropColumn('guru_id');
        });
    }
}
