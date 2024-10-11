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
        Schema::create('villages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('district_id');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('code')->nullable();
            $table->uuid('type_id');
            $table->string('no_sotk')->nullable();
            $table->integer('total_kasi')->default(0);
            $table->integer('total_kaur')->default(0);
            $table->timestamps();

            // Foreign keys
            $table->foreign('district_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
