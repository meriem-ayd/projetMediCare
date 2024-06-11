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
        Schema::table('bon_commande_fournisseurs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_chef_pharmacien')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bon_commande_fournisseurs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_chef_pharmacien')->nullable(false)->change();

        });
    }
};
