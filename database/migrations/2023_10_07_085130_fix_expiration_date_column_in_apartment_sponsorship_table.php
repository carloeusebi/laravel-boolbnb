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
        Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table->timestamp('expiration_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartment_sponsorshp', function (Blueprint $table) {
            $table->date('expiration_date')->change();
        });
    }
};
