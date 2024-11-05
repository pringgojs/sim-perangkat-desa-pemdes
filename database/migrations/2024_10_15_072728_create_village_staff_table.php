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
        Schema::create('village_staff', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID as primary key
            $table->unsignedBigInteger('user_id');
            $table->uuid('village_id');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('name')->nullable();
            $table->string('another_name')->nullable();
            $table->string('ktp_scan')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('is_active')->default(true); // 
            $table->string('gender')->nullable();
            $table->uuid('position_id')->nullable(); // dipake untuk query jabatan
            $table->uuid('position_is_active')->default(1); // untuk cek jabatan definitif aktif apa enggak
            $table->uuid('position_plt_id')->nullable(); // 
            $table->uuid('position_plt_status_id')->nullable(); // plt, pj, definitif
            $table->uuid('education_level_id')->nullable(); // 
            $table->text('reason_note')->nullable();
            $table->uuid('data_status_id');
            $table->string('position_name')->nullable();
            $table->string('position_code')->nullable();
            $table->string('position_plt_is_active')->default(1);
            $table->string('position_plt_name')->nullable();
            $table->string('position_plt_code')->nullable();
            // $table->string('sk_number')->nullable();
            // $table->date('sk_tmt')->nullable();
            // $table->date('sk_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('education_level_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('position_plt_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('position_plt_status_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('data_status_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_staff');
    }
};
