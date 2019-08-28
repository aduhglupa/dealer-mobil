<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penjualan_id');
            $table->unsignedInteger('mobil_id');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('subtotal');
            $table->timestamps();

            $table->foreign('penjualan_id')
                ->references('id')
                ->on('penjualans')
                ->onDelete('cascade');

            $table->foreign('mobil_id')
                ->references('id')
                ->on('mobils');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_details');
    }
}
