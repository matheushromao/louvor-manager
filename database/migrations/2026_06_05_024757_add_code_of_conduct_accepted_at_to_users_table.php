<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Registra o momento em que cada usuário aceitou as Boas Condutas de Uso.
     * Quando nulo, o termo ainda não foi aceito e deve ser exibido no primeiro acesso.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('code_of_conduct_accepted_at')->nullable()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('code_of_conduct_accepted_at');
        });
    }
};
