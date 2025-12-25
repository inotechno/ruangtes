<?php

use App\Enums\BillingCycle;
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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Kode plan: basic_3m, premium_1y, dll');
            $table->string('name');
            $table->text('description')->nullable();
            
            // Durasi
            $table->integer('duration_months')->comment('Durasi dalam bulan');
            $table->enum('billing_cycle', BillingCycle::cases())->default(BillingCycle::MONTHLY);
            
            // Pricing configuration
            $table->decimal('base_price', 12, 2)->default(0)->comment('Harga dasar');
            $table->json('price_tiers')->nullable()->comment('JSON: {5: 500000, 10: 900000, ...}');
            $table->decimal('price_per_user', 10, 2)->nullable()->comment('Harga per user tambahan');
            $table->decimal('extension_price_per_month', 10, 2)->nullable()->comment('Harga perpanjangan per bulan');
            
            // Features
            $table->integer('min_users')->default(1);
            $table->integer('max_users')->nullable()->comment('NULL untuk unlimited');
            $table->boolean('allow_custom_users')->default(false);
            $table->boolean('allow_extension')->default(true);
            $table->boolean('allow_user_topup')->default(true);
            
            // Test limitations
            $table->integer('max_tests_per_month')->nullable()->comment('Batas tes per bulan');
            $table->boolean('unlimited_tests')->default(false);
            $table->json('included_test_types')->nullable()->comment('Jenis tes yang termasuk');
            
            // Support & features
            $table->boolean('has_priority_support')->default(false);
            $table->boolean('has_custom_branding')->default(false);
            $table->boolean('has_api_access')->default(false);
            $table->boolean('has_advanced_analytics')->default(false);
            
            // Display & ordering
            $table->integer('display_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_popular')->default(false);
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_visible')->default(true);
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_until')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('code');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('display_order');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
