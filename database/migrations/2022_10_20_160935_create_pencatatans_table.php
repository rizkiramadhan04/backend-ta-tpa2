<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePencatatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencatatans', function (Blueprint $table) {
            $table->bigIncrements("id")->nullable();
            $table->integer('murid_id')->nullable();
            $table->integer('no_surat')->nullable();
            $table->integer('no_ayat')->nullable();
            $table->integer('no_iqro')->nullable();
            $table->integer('jilid')->nullable();
            $table->integer('halaman')->nullable();
            $table->integer('guru_id')->nullable();
            $table->string('hasil')->nullable();
            $table->date('tanggal')->nullable();

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
        Schema::dropIfExists('pencatatans');
    }
}
