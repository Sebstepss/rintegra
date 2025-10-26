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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre original del archivo
            $table->string('file_name'); // Nombre del archivo en servidor
            $table->string('mime_type'); // Tipo MIME del archivo
            $table->string('extension', 10); // Extensión del archivo
            $table->unsignedBigInteger('size'); // Tamaño en bytes
            $table->string('path'); // Ruta relativa del archivo
            $table->string('url'); // URL completa para acceder al archivo
            $table->enum('type', ['image', 'video', 'document', 'other']); // Tipo de medio
            $table->json('metadata')->nullable(); // Metadatos adicionales (dimensiones, duración, etc.)
            $table->unsignedBigInteger('uploaded_by')->nullable(); // ID del usuario que subió el archivo
            $table->string('alt_text')->nullable(); // Texto alternativo para imágenes
            $table->text('description')->nullable(); // Descripción del medio
            $table->timestamps();
            
            // Índices
            $table->index('type');
            $table->index('mime_type');
            $table->index('uploaded_by');
            $table->index('created_at');
            
            // Relación con usuarios
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
