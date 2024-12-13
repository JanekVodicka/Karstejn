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
        Schema::table('rocniky', function (Blueprint $table) {
            $table->string('zobrazit_v_galerii')->nullable();
            $table->string('zobrazit_v_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rocniky', function (Blueprint $table) {
            $table->dropColumn(['zobrazit_v_galerii', 'zobrazit_v_info']);
        });
    }
};
