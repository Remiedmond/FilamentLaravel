<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint; // Assurez-vous que cette ligne est présente
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // REMPLACEZ (Table $table) PAR (Blueprint $table)
        Schema::table('registrations', function (Blueprint $table) {
            $table->json('guests_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('guests_details');
        });
    }
};
