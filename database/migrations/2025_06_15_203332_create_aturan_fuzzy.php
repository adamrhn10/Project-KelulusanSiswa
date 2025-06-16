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
            $table->text('kondisi');     // IF bagian
            $table->string('kesimpulan'); // THEN bagian, misalnya 'Lulus'
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
