<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resenas', function (Blueprint $table) {
            if (! Schema::hasColumn('resenas', 'tiempo_llegada')) {
                $table->string('tiempo_llegada')->default('Sin especificar')->after('producto');
            }
            if (! Schema::hasColumn('resenas', 'estado_paquete')) {
                $table->string('estado_paquete')->default('No especificado')->after('tiempo_llegada');
            }
        });
    }

    public function down(): void
    {
        Schema::table('resenas', function (Blueprint $table) {
            $table->dropColumn(['tiempo_llegada', 'estado_paquete']);
        });
    }
};
