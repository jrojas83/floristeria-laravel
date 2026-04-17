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
        Schema::create('pagos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pedido_id')->constrained('pedidos');
    $table->foreignId('metodo_pago_id')->constrained('metodos_pago');
    $table->foreignId('estado_id')->constrained('estados_pago');
    $table->decimal('monto', 10, 2);
    $table->timestamp('fecha')->useCurrent();
    $table->boolean('activo')->default(true);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
