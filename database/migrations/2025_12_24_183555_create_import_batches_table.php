<?php

use App\Enums\ImportStatus;
use App\Enums\ImportType;
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
        Schema::create('import_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('batch_number')->unique();
            $table->string('file_name');
            $table->string('file_path');
            $table->enum('import_type', ImportType::cases())->default(ImportType::PARTICIPANTS);
            $table->enum('status', ImportStatus::cases())->default(ImportStatus::UPLOADED);

            // Statistics
            $table->integer('total_rows')->default(0);
            $table->integer('processed_rows')->default(0);
            $table->integer('successful_rows')->default(0);
            $table->integer('failed_rows')->default(0);

            // Error handling
            $table->json('errors')->nullable();
            $table->text('error_message')->nullable();

            // Metadata
            $table->json('mapping_config')->nullable()->comment('Column mapping configuration');
            $table->json('validation_rules')->nullable()->comment('Custom validation rules');
            $table->json('metadata')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('batch_number');
            $table->index(['user_id', 'status']);
            $table->index(['import_type', 'status']);
            $table->index('status');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_batches');
    }
};
