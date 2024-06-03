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
        Schema::create('dci', function (Blueprint $table) {
            $table->id();
            $table->integer('IDdci');
            $table->string('dci');
            $table->string('forme');
            $table->string('dosage');
            $table->integer('quantite_en_stock')->nullable();
            $table->float('prix_unitaire')->nullable();
            $table->float('Montant')->nullable();
            $table->date('date_peremption');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('dci');
    }
};
