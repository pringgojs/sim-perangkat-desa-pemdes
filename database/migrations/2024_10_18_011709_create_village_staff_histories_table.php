<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('village_staff_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('village_staff_id');
            $table->uuid('village_position_type_id');
            $table->uuid('village_id');
            $table->string('position_code')->nullable();
            $table->uuid('position_type_id');
            $table->string('position_name')->nullable();
            $table->uuid('position_type_status_id');
            $table->decimal('siltap', 15, 2)->default(0);
            $table->boolean('is_active')->default(1);
            $table->decimal('tunjangan', 15, 2)->default(0);
            $table->decimal('thp', 15, 2)->default(0);
            $table->string('no_sk')->nullable();
            $table->dateTime('date_of_sk')->nullable();
            $table->dateTime('date_of_appointment')->nullable();
            $table->dateTime('enddate_of_office')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('village_staff_id')->references('id')->on('village_staff')->onDelete('cascade');
            $table->foreign('village_position_type_id')->references('id')->on('village_position_type')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('position_type_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('position_type_status_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_staff_histories');
    }
};
