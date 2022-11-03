<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJenisToHafalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hafalans', function (Blueprint $table) {
            $table->integer('jenis')->nullable()->after('guru_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hafalans', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
}
