<?php

use App\Enums\MonitoringTriggerType;
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
        Schema::create('monitoring_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained('test_attempts')->onDelete('cascade');
            $table->string('screenshot_url')->nullable();
            $table->enum('trigger_type', MonitoringTriggerType::cases())->default(MonitoringTriggerType::TIMER);
            $table->boolean('is_flagged')->default(false);
            $table->json('metadata')->nullable()->comment('Additional metadata: browser info, activity data, etc');
            $table->json('ai_analysis')->nullable()->comment('AI analysis results if applicable');
            $table->timestamps();

            // Indexes
            $table->index(['attempt_id', 'created_at']);
            $table->index('trigger_type');
            $table->index('is_flagged');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_snapshots');
    }
};
