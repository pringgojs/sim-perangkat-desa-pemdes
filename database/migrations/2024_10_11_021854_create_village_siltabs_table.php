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
        Schema::create('village_siltap', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('village_id');
            $table->uuid('position_type_id');
            $table->decimal('siltap', 15, 2)->default(0);
            $table->decimal('tunjangan', 15, 2)->default(0);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('position_type_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('village_siltap');
    }
};
