<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resenas', function (Blueprint $table) {
            if (! Schema::hasColumn('resenas', 'rating')) {
                $table->unsignedTinyInteger('rating')->default(5)->after('contenido');
            }
            if (! Schema::hasColumn('resenas', 'producto')) {
                $table->string('producto')->default('Sin producto')->after('rating');
            }
        });
    }

    public function down(): void
    {
        Schema::table('resenas', function (Blueprint $table) {
            $table->dropColumn(['rating', 'producto']);
        });
    }
};
