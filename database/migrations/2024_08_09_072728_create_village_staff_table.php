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
            $table->string('ktp_scan')->nullable();
            $table->string('phone_number')->nullable();
            $table->uuid('position_type_id')->nullable(); // Relation to options table
            $table->boolean('is_active')->default(true);
            $table->boolean('gender')->default(true); // default L
            $table->string('position_name')->nullable();
            $table->uuid('data_status_id');
            $table->string('sk_number')->nullable();
            $table->date('sk_tmt')->nullable();
            $table->date('sk_date')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('position_type_id')->references('id')->on('options')->onDelete('cascade');
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
