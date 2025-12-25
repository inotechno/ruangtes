<?php

use App\Enums\CompanySubscriptionStatus;
use App\Enums\CancelledBy;
use App\Enums\PaymentMethod;
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
        Schema::create('company_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('subscription_plans')->onDelete('restrict');
            
            // Subscription details
            $table->string('subscription_number')->unique()->comment('Nomor subscription');
            $table->enum('status', CompanySubscriptionStatus::cases())->default(CompanySubscriptionStatus::PENDING);
            
            // Period
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamp('trial_ends_at')->nullable()->comment('Akhir masa trial');
            
            // User quota
            $table->integer('total_users')->default(0)->comment('Jumlah user yang dibeli');
            $table->integer('used_users')->default(0)->comment('Jumlah user yang terpakai');
            $table->integer('additional_users')->default(0)->comment('User tambahan yang dibeli');
            
            // Pricing
            $table->decimal('base_amount', 12, 2)->comment('Harga dasar plan');
            $table->decimal('additional_amount', 12, 2)->default(0)->comment('Harga tambahan user');
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->comment('Total yang harus dibayar');
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('amount_due', 12, 2)->default(0);
            
            // Payment info
            $table->enum('payment_method', PaymentMethod::cases())->nullable();
            $table->string('payment_reference')->nullable()->comment('Referensi pembayaran');
            $table->timestamp('paid_at')->nullable();
            $table->string('invoice_url')->nullable();
            
            // Auto-renewal
            $table->boolean('auto_renew')->default(false);
            $table->string('renewal_token')->nullable()->comment('Token untuk auto-renewal');
            
            // Metadata
            $table->json('features')->nullable()->comment('Fitur yang aktif');
            $table->json('customizations')->nullable()->comment('Kustomisasi yang dipilih');
            $table->text('notes')->nullable()->comment('Catatan admin');
            
            // Cancellation
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->enum('cancelled_by', CancelledBy::cases())->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('subscription_number');
            $table->index(['company_id', 'status']);
            $table->index('end_date');
            $table->index('auto_renew');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_subscriptions');
    }
};
