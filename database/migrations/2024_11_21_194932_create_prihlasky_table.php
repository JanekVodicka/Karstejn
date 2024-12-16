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
        Schema::create('prihlasky', function (Blueprint $table) {
            $table->id();
            $table->string('variable_symbol')->nullable();
            $table->string('parent_email');
            $table->string('parent_names');
            $table->string('parent_number');
            $table->string('parent_street');
            $table->string('parent_city');
            $table->string('parent_zip');
            $table->text('parent_note')->nullable();
            $table->string('child_first_name');
            $table->string('child_last_name');
            $table->string('child_birthday');
            $table->string('child_street');
            $table->string('child_city');
            $table->string('child_zip');
            $table->string('misto_nastupu');
            $table->string('plavec');
            $table->string('velikost_trika');
            $table->text('child_note');
            $table->string('photos_agreement');
            $table->string('facture');
            $table->string('zprocesovano');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prihlasky');
    }
};
