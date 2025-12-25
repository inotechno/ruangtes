<?php

use App\Enums\TestType;
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
        Schema::create('tests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('category_id')->nullable()->constrained('test_categories')->onDelete('set null');
            $table->string('code')->unique()->comment('Kode unik tes: DISC, IQ, MBTI, dll');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            
            // Pricing
            $table->decimal('price', 10, 2)->default(0)->comment('Harga untuk public user');
            $table->decimal('company_price', 10, 2)->nullable()->comment('Harga khusus perusahaan');
            $table->boolean('is_free')->default(false);
            $table->boolean('has_discount')->default(false);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->timestamp('discount_ends_at')->nullable();
            
            // Test configuration
            $table->integer('duration_minutes')->nullable()->comment('Durasi tes dalam menit, NULL untuk unlimited');
            $table->integer('total_questions')->default(0);
            $table->integer('passing_score')->nullable()->comment('Nilai kelulusan jika ada');
            $table->integer('max_attempts')->default(1)->comment('Maksimal percobaan');
            $table->boolean('randomize_questions')->default(false);
            $table->boolean('show_results_immediately')->default(true);
            $table->boolean('requires_profile')->default(true)->comment('Butuh lengkapi profil sebelum tes');
            
            // Availability
            $table->enum('type', TestType::cases())->default(TestType::ALL);
            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->nullable();
            
            // Routes untuk dynamic handling
            $table->string('instruction_route')->nullable()->comment('Route untuk halaman instruksi');
            $table->string('test_route')->nullable()->comment('Route untuk halaman tes');
            $table->string('result_route')->nullable()->comment('Route untuk halaman hasil');
            
            // Metadata untuk dynamic test handler
            $table->json('meta')->nullable()->comment('JSON configuration untuk tes: settings, components, calculations');
            
            // Security & monitoring
            $table->boolean('enable_webcam')->default(false);
            $table->boolean('enable_screen_capture')->default(false);
            $table->boolean('disable_copy_paste')->default(true);
            $table->boolean('disable_right_click')->default(true);
            $table->boolean('fullscreen_required')->default(false);
            
            // Report settings
            $table->boolean('generate_certificate')->default(false);
            $table->string('certificate_template')->nullable();
            $table->boolean('generate_pdf_report')->default(true);
            $table->json('report_settings')->nullable()->comment('Pengaturan laporan');
            
            // Statistics
            $table->integer('total_attempts')->default(0);
            $table->decimal('average_score', 5, 2)->nullable();
            $table->integer('average_completion_time')->nullable()->comment('Dalam menit');
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('code');
            $table->index('slug');
            $table->index('category_id');
            $table->index('type');
            $table->index('is_active');
            $table->index('published_at');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
