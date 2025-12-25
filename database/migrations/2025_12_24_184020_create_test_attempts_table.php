<?php

use App\Enums\AttemptType;
use App\Enums\AttemptStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('attempt_code')->unique()->comment('Kode unik attempt: ATT-20240101-ABC123');

            // Relationships
            $table->foreignId('assignment_id')->nullable()->constrained('participant_test_assignments')->onDelete('cascade');
            $table->foreignId('participant_id')->nullable()->constrained('participants')->onDelete('cascade');
            $table->foreignUuid('test_id')->constrained('tests')->onDelete('cascade');
            $table->foreignUuid('company_id')->nullable()->constrained('companies')->onDelete('cascade');

            // Untuk public users (bukan participant)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('order_item_id')->nullable()->constrained('order_items')->onDelete('set null');

            // Attempt Type & Status
            $table->enum('attempt_type', AttemptType::cases())->default(AttemptType::COMPANY_PARTICIPANT);

                $table->enum('status', AttemptStatus::cases())->default(AttemptStatus::CREATED);

            // Timing
            $table->timestamp('instructions_started_at')->nullable();
            $table->timestamp('test_started_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            // Time Tracking
            $table->integer('instruction_time')->default(0)->comment('Detik di instruksi');
            $table->integer('test_time')->default(0)->comment('Detik aktif tes');
            $table->integer('idle_time')->default(0)->comment('Detik idle');
            $table->integer('total_time')->default(0)->comment('Total detik');

            // Progress
            $table->integer('current_page')->default(1);
            $table->integer('current_question')->default(0);
            $table->integer('total_questions')->default(0);
            $table->integer('questions_answered')->default(0);
            $table->integer('questions_skipped')->default(0);
            $table->integer('questions_flagged')->default(0);

            // Answers
            $table->json('answers')->nullable()->comment('Jawaban final');
            $table->json('answer_history')->nullable()->comment('Riwayat perubahan jawaban');
            $table->json('answer_timestamps')->nullable()->comment('Waktu jawab per pertanyaan');

            // Security & Monitoring
            $table->boolean('is_flagged')->default(false);
            $table->json('flag_reasons')->nullable()->comment('Alasan flag');
            $table->json('security_events')->nullable()->comment('Event keamanan');
            $table->json('browser_info')->nullable();
            $table->json('device_info')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('screen_resolution')->nullable();
            $table->boolean('was_fullscreen')->default(false);

            // Cheating Metrics
            $table->integer('tab_change_count')->default(0);
            $table->integer('copy_attempt_count')->default(0);
            $table->integer('right_click_count')->default(0);
            $table->integer('devtool_open_count')->default(0);
            $table->integer('inactivity_count')->default(0);
            $table->decimal('cheating_score', 5, 2)->nullable()->comment('Skor kecurangan 0-100');

            // Payment (untuk public)
            $table->enum('payment_status', PaymentStatus::cases())->default(PaymentStatus::FREE);
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->timestamp('paid_at')->nullable();

            // Snapshots
            $table->json('test_settings_snapshot')->nullable()->comment('Snapshot settings tes');
            $table->json('user_profile_snapshot')->nullable()->comment('Snapshot profil');

            // Results
            $table->decimal('raw_score', 10, 4)->nullable();
            $table->decimal('normalized_score', 10, 4)->nullable();
            $table->integer('percentile')->nullable();
            $table->json('section_scores')->nullable();
            $table->json('detailed_results')->nullable();

            // Report
            $table->string('report_url')->nullable();
            $table->string('certificate_url')->nullable();
            $table->timestamp('report_generated_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('attempt_code');
            $table->index(['participant_id', 'status']);
            $table->index(['assignment_id', 'status']);
            $table->index(['test_id', 'status']);
            $table->index(['company_id', 'status']);
            $table->index('attempt_type');
            $table->index('status');
            $table->index('created_at');
            $table->index('submitted_at');
            $table->index('is_flagged');
            $table->index('cheating_score');
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};
