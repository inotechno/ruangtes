<?php

use App\Enums\Gender;
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
        Schema::create('public_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', Gender::cases())->nullable();
            
            // Contact info
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            
            // Education & career
            $table->string('education_level')->nullable()->comment('Tingkat pendidikan');
            $table->string('major')->nullable()->comment('Jurusan');
            $table->string('university')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->string('current_job')->nullable();
            $table->string('company')->nullable();
            
            // Profile
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cv_url')->nullable()->comment('URL CV jika diupload');
            
            // Preferences
            $table->json('preferences')->nullable()->comment('User preferences untuk tes');
            $table->json('test_history_summary')->nullable()->comment('Ringkasan histori tes');
            
            // Statistics
            $table->integer('total_tests_taken')->default(0);
            $table->decimal('average_score', 5, 2)->nullable();
            $table->timestamp('last_test_taken_at')->nullable();
            
            // Verification
            $table->boolean('is_profile_complete')->default(false);
            $table->timestamp('profile_completed_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('date_of_birth');
            $table->index('is_profile_complete');
            $table->index('total_tests_taken');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_users');
    }
};
