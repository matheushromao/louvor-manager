<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Ligação entre músicas e repertórios (muitos para muitos)
    public function up(): void
    {
        Schema::create('musica_repertorio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('musica_id')->constrained()->onDelete('cascade');
            $table->foreignId('repertorio_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musica_repertorio');
    }
};
