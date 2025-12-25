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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('user_type')->nullable()->comment('Type of user: super_admin, company_admin, public_user, participant');
            $table->string('event')->comment('Action performed');
            $table->string('model_type')->nullable()->comment('Model class if applicable');
            $table->unsignedBigInteger('model_id')->nullable()->comment('Model ID if applicable');
            $table->text('description')->nullable();
            $table->json('old_values')->nullable()->comment('Previous values');
            $table->json('new_values')->nullable()->comment('New values');
            $table->json('metadata')->nullable()->comment('Additional context data');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'created_at']);
            $table->index('event');
            $table->index(['model_type', 'model_id']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
