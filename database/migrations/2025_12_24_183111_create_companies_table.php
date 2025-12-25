<?php

use App\Enums\CompanyStatus;
use App\Enums\SubscriptionType;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique()->comment('Kode unik perusahaan');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable()->default('Indonesia');
            $table->string('postal_code')->nullable();
            
            // Company branding
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('primary_color')->default('#3B82F6');
            $table->string('secondary_color')->default('#1E40AF');
            
            // Subscription info
            $table->enum('subscription_type', SubscriptionType::cases())->default(SubscriptionType::TRIAL);
            $table->timestamp('subscription_start')->nullable();
            $table->timestamp('subscription_end')->nullable();
            $table->integer('max_participants')->default(0)->comment('Jumlah peserta maksimal');
            $table->integer('current_participants')->default(0)->comment('Jumlah peserta aktif');
            
            // Billing info
            $table->string('billing_name')->nullable();
            $table->string('billing_email')->nullable();
            $table->text('billing_address')->nullable();
            $table->string('tax_id')->nullable()->comment('NPWP');
            
            // Status
            $table->enum('status', CompanyStatus::cases())->default(CompanyStatus::PENDING);
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            
            // Settings
            $table->json('settings')->nullable()->comment('Company-specific settings');
            $table->json('test_configurations')->nullable()->comment('Konfigurasi tes khusus perusahaan');
            
            // Metadata
            $table->string('timezone')->default('Asia/Jakarta');
            $table->string('language')->default('id');
            $table->foreignId('created_by')->nullable()->comment('ID super admin yang membuat');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('code');
            $table->index('status');
            $table->index('subscription_end');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
