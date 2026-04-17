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
        Schema::create('agendamientos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pedido_id')->unique()->constrained('pedidos');
    $table->date('fecha')->nullable();
    $table->time('hora')->nullable();
    $table->text('direccion_entrega')->nullable();
    $table->boolean('activo')->default(true);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamientos');
    }
};
