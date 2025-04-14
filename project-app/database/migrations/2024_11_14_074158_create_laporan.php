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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pemasukan');
            $table->date('tanggal_pengeluaran')->nullable();
            $table->unsignedBigInteger('pembayaran_id');
            $table->integer('nominal_pemasukan')->nullable();
            $table->integer('nominal_pengeluaran')->nullable();
            $table->integer('total')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('status_laporan', ['pemasukan', 'pengeluaran'])->default('pemasukan');
            $table->string('catatan')->nullable();

            $table->foreign('pembayaran_id')->references('id')->on('pembayaran')->onDelete('cascade');
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
        Schema::dropIfExists('transaksi');
    }
};
