<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHafalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hafalans', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer('murid_id')->nullable();
            $table->string('materi_hafalan')->nullable();
            $table->date('tanggal_hafalan')->nullable();
            $table->string('nilai')->nullable();
            $table->integer('guru_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hafalans');
    }
}
