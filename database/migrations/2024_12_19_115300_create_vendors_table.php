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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->boolean('is_active')->default(true);
            $table->text('address');
            $table->foreignId('category_id')->nullable()->constrained()->on('categories')->nullOnDelete();
            $table->string('logo')->nullable();
            $table->string('longitude', 30)->nullable();
            $table->string('latitude', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
