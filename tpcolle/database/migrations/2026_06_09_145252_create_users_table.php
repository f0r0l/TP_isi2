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
        Schema::create('users', function (Blueprint $table) {
            // Clé primaire personnalisée pour correspondre exactement au MCD
            $table->id('idUtilisateur'); 
            
            // Propriétés de l'utilisateur définies dans le sujet
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique(); // 'unique' empêche d'avoir deux fois le même email
            
            // Optionnel mais indispensable pour Laravel (gestion des tokens de connexion et dates)
            $table->rememberToken();
            $table->timestamps(); // Crée 'created_at' et 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};