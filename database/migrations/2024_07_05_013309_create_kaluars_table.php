<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaluars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jumlah');
            $table->string('keterangan');
            $table->date('tanggal_keluar');
            $table->unsignedBigInteger('id_data');
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
        Schema::dropIfExists('kaluars');
    }
};
