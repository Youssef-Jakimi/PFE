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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->integer('Numero');
            $table->integer('Nombre_Perso');
            $table->integer('Nombre_Lit');
            $table->integer('PrixPNuit');
            $table->integer('Type');
            $table->foreignId('categorie_id')->constrained();

            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
