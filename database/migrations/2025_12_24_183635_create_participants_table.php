<?php

use App\Enums\Gender;
use App\Enums\ParticipantStatus;
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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('company_id')->constrained()->onDelete('cascade');
            $table->string('unique_code')->unique()->comment('Kode unik untuk akses tes');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('employee_id')->nullable()->comment('ID karyawan di perusahaan');
            
            // Demographic info (optional, bisa diisi saat tes)
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', Gender::cases())->nullable();
            $table->string('education')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            
            // Periode tes keseluruhan
            $table->timestamp('test_period_start')->nullable()->comment('Waktu mulai periode tes');
            $table->timestamp('test_period_end')->nullable()->comment('Waktu akhir periode tes');
            
            // Summary fields untuk quick access (optional, bisa dihapus jika mau normalisasi penuh)
            $table->json('assigned_tests_summary')->nullable()->comment('JSON summary: [{test_id, name, order, status}]');
            $table->integer('total_assigned_tests')->default(0);
            $table->integer('completed_tests')->default(0);
            $table->integer('in_progress_tests')->default(0);
            $table->integer('pending_tests')->default(0);
            
            // Status overall participant
            $table->enum('status', ParticipantStatus::cases())->default(ParticipantStatus::PENDING);
            $table->timestamp('invited_at')->nullable();
            $table->timestamp('first_accessed_at')->nullable();
            $table->timestamp('started_test_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('banned_at')->nullable();
            $table->text('ban_reason')->nullable();
            
            // Access tracking
            $table->string('access_token')->nullable()->comment('Token untuk akses tes');
            $table->timestamp('token_expires_at')->nullable();
            $table->integer('access_count')->default(0);
            $table->timestamp('last_accessed_at')->nullable();
            
            // Profile completion
            $table->boolean('profile_completed')->default(false);
            $table->timestamp('profile_completed_at')->nullable();
            $table->json('profile_data')->nullable()->comment('Data profil yang diisi peserta');
            
            // Metadata
            $table->json('metadata')->nullable()->comment('Additional metadata');
            $table->foreignId('import_batch_id')->nullable()->constrained('import_batches')->onDelete('set null');
            
            $table->timestamps();
            $table->softDeletes();
        
            // Indexes
            $table->index('unique_code');
            $table->index(['company_id', 'status']);
            $table->index('test_period_end');
            $table->index('email');
            $table->index('access_token');
            $table->index('profile_completed');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
