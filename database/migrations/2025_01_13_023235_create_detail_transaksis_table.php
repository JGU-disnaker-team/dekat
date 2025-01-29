<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id(); // Primary key otomatis bernama 'id'
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_layanan');
            $table->unsignedBigInteger('id_jasa');
            $table->decimal('harga_satuan', 15, 2);
            $table->string('status')->default('pending');
            $table->boolean('status_garansi')->default(false);
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('transaksis')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id')->on('layanans')->onDelete('cascade');
            $table->foreign('id_jasa')->references('id')->on('jasas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
