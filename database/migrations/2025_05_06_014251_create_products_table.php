<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->enum('jenis_barang', ['Makanan', 'Minuman', 'Bumbu', 'Obat-obatan', 'Sabun', 'Lainnya'])->default('Lainnya')->nullable();
            $table->decimal('harga_pcs', 10, 2)->nullable();
            $table->decimal('harga_2pcs', 10, 2)->nullable();
            $table->string('foto_barang')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
