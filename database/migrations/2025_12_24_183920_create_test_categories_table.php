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
        Schema::create('test_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable()->comment('Icon class atau URL');
            $table->string('color')->default('#6B7280')->comment('Warna kategori');
            
            // Hierarchy
            $table->foreignId('parent_id')->nullable()->constrained('test_categories')->onDelete('cascade');
            $table->integer('lft')->nullable()->comment('Nested set left');
            $table->integer('rgt')->nullable()->comment('Nested set right');
            $table->integer('depth')->default(0);
            
            // Display
            $table->integer('display_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            
            // Metadata
            $table->json('metadata')->nullable()->comment('Additional metadata');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('slug');
            $table->index('parent_id');
            $table->index('display_order');
            $table->index(['is_active', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_categories');
    }
};
