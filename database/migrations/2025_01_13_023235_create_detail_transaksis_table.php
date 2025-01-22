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
            $table->uuid('id');
            $table->foreignId('id_transaksi')->constrained('transaksis')->onDelete('cascade');
            $table->foreignId('id_layanan')->nullable()->constrained('layanans')->onDelete('set null');
            $table->foreignId('id_jasa')->nullable()->constrained('jasa')->onDelete('set null');
            $table->decimal('harga_satuan', 15, 2);
            $table->string('status')->default('pending');
            $table->boolean('status_garansi')->default(false);
            $table->timestamps();
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
