<?php

use App\Enums\ParticipantTestAssignmentStatus;
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
        Schema::create('participant_test_assignments', function (Blueprint $table) {
            $table->id();
            
            // Foreign Keys
            $table->foreignId('participant_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('test_id')->constrained('tests')->onDelete('cascade');
            $table->foreignId('import_batch_id')->nullable()->constrained('import_batches')->onDelete('set null');
            
            // Assignment Configuration
            $table->integer('test_order')->default(1)->comment('Urutan pengerjaan tes');
            $table->timestamp('assigned_at')->useCurrent();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->onDelete('set null');
            
            // Time Constraints
            $table->timestamp('available_from')->nullable()->comment('Tes tersedia mulai');
            $table->timestamp('available_until')->nullable()->comment('Tes tersedia sampai');
            $table->integer('time_limit_minutes')->nullable()->comment('Batas waktu pengerjaan per tes');
            
            // Status & Progress Tracking
            $table->enum('status', ParticipantTestAssignmentStatus::cases())->default(ParticipantTestAssignmentStatus::PENDING);
            
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->integer('total_time_spent')->default(0)->comment('Total waktu pengerjaan dalam detik');
            
            // Attempt Management
            $table->integer('max_attempts')->default(1);
            $table->integer('attempts_count')->default(0);
            $table->boolean('allow_retake')->default(false);
            $table->integer('retake_interval_days')->nullable()->comment('Minimal interval retake');
            
            // Results (best score dari semua attempts)
            $table->decimal('best_score', 5, 2)->nullable();
            $table->json('best_results')->nullable()->comment('Hasil terbaik dalam JSON');
            
            // Settings Override
            $table->json('custom_settings')->nullable()->comment('Override settings untuk assignment ini');
            
            // Metadata
            $table->json('metadata')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->unique(['participant_id', 'test_id']); // Satu peserta hanya punya satu assignment per tes
            $table->index(['participant_id', 'status', 'test_order']);
            $table->index(['test_id', 'status']);
            $table->index('available_until');
            $table->index('assigned_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_test_assignments');
    }
};
