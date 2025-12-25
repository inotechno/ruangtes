<?php

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
        Schema::create('company_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('company_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('position')->nullable()->comment('Jabatan di perusahaan');
            $table->string('department')->nullable()->comment('Departemen');
            $table->string('employee_id')->nullable()->comment('ID karyawan');
            
            // Contact info
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            
            // Permissions level
            $table->enum('role', ['owner', 'admin', 'manager', 'viewer'])->default('admin');
            $table->json('permissions')->nullable()->comment('Custom permissions untuk admin ini');
            
            // Status
            $table->boolean('is_primary')->default(false)->comment('Admin utama perusahaan');
            $table->boolean('is_active')->default(true);
            
            // Login tracking
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->integer('login_count')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('company_id');
            $table->index('role');
            $table->index('is_active');
        });

      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_admins');
    }
};
