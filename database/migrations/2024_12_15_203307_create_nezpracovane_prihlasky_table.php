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
        Schema::create('nezpracovane_prihlasky', function (Blueprint $table) {
            $table->id();
            $table->longText('formData');
            $table->longText('wordPaths');
            $table->string('folderPathPatient', 1028);
            $table->longText('rocnik');
            $table->boolean('zprocesovano')->default(0);
            $table->timestamps();

            // Adding JSON validation check for MySQL
            $table->check('json_valid(`formData`)');
            $table->check('json_valid(`wordPaths`)');
            $table->check('json_valid(`rocnik`)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nezpracovane_prihlasky');
    }
};
