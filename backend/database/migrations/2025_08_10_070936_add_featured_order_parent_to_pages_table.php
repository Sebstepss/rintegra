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
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->after('status');
            $table->integer('sort_order')->default(0)->after('featured');
            $table->unsignedBigInteger('parent_id')->nullable()->after('sort_order');
            
            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('set null');
            $table->index(['sort_order', 'featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['sort_order', 'featured']);
            $table->dropColumn(['featured', 'sort_order', 'parent_id']);
        });
    }
};
