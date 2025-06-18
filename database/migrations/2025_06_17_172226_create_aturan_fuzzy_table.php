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
        Schema::create('aturan_fuzzy', function (Blueprint $table) {
            $table->id();
            $table->string('rapor1');
            $table->string('rapor2');
            $table->string('rapor3');
            $table->string('rapor4');
            $table->string('rapor5');
            $table->string('output');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturan_fuzzy');
    }
};
