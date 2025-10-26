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
        Schema::create('backups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('filename', 255);
            $table->enum('type', ['manual', 'auto', 'scheduled'])->default('manual');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->bigInteger('size')->nullable(); // Tamaño en bytes
            $table->text('description')->nullable();
            $table->json('contents')->nullable(); // Detalle del contenido
            $table->json('metadata')->nullable(); // Metadatos adicionales
            $table->string('checksum', 64)->nullable(); // SHA-256 hash
            $table->string('compression', 20)->default('gzip');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
            
            $table->index(['type', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backups');
    }
};
