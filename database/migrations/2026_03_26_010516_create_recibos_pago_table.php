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
        Schema::create('recibos_pago', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pedido_id')->constrained('pedidos');
    $table->string('numero_recibo')->unique();
    $table->decimal('subtotal', 10, 2)->nullable();
    $table->decimal('impuestos', 10, 2)->nullable();
    $table->decimal('total', 10, 2)->nullable();
    $table->string('estado')->default('emitido');
    $table->boolean('visible')->default(true);
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibos_pago');
    }
};
