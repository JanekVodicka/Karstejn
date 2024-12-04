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
        Schema::create('rocniky', function (Blueprint $table) {
            $table->id();
            $table->string('rok')->unique();
            $table->string('cena')->nullable();
            $table->string('termin_1beh')->nullable();
            $table->string('tema_1beh')->nullable();
            $table->string('termin_2beh')->nullable();
            $table->string('tema_2beh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rocniky');
    }
};
