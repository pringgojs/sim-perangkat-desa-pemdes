<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('village_position_type', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('village_id');
            $table->uuid('position_type_id');
            $table->uuid('position_type_status_id');
            $table->string('position_name')->nullable();
            $table->decimal('siltap', 15, 2)->default(0);
            $table->decimal('tunjangan', 15, 2)->default(0);
            $table->decimal('thp', 15, 2)->default(0);
            $table->string('code')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('position_type_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('position_type_status_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('village_position_type');
    }
};
