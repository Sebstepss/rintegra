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
        Schema::create('site_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('config_type', 50)->index(); // 'globals', 'header', 'footer'
            $table->json('config_data'); // Datos de configuración en JSON
            $table->integer('version')->default(1);
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable(); // Descripción opcional del cambio
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index(['config_type', 'is_active']);
            $table->index(['config_type', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_configurations');
    }
};
