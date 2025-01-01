<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->text('short_description')->nullable();
            $table->string('locale');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unique(['product_id', 'locale']);
            $table->timestamps();
        });
        //A FULLTEXT index is a special type of index used to perform full-text searches on textual data
        DB::statement("ALTER TABLE `product_translations` ADD FULLTEXT(`name`)");
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_translations');
    }
};
