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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name', 60);
            $table->string('slug')->unique;
            $table->tinyInteger('rooms')->nullable;
            $table->tinyInteger('bedrooms')->nullable;
            $table->tinyInteger('bathrooms')->nullable;
            $table->tinyInteger('square_meters')->nullable;
            $table->string('image')->nullable;
            $table->text('description')->nullable;
            $table->boolean('is_published')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
