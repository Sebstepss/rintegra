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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->string('category')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            // Índices para mejor performance
            $table->index(['created_at', 'updated_at']);
            $table->index('category');
            $table->index('is_favorite');
            $table->fullText(['title', 'content']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
