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
        Schema::create('pedidos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users');
    $table->foreignId('direccion_id')->nullable()->constrained('direcciones');
    $table->text('direccion_texto')->nullable();
    $table->timestamp('fecha_pedido')->useCurrent();
    $table->foreignId('estado_id')->constrained('estados_pedido');
    $table->decimal('total', 10, 2)->nullable();
    $table->boolean('activo')->default(true);
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
