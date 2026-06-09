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
        Schema::create('projets', function (Blueprint $table) {
            // Clé primaire personnalisée conforme au MCD
            $table->id('idProjet');
            
            // Attributs du projet définis dans l'énoncé
            $table->string('nomProjet');
            $table->date('dateDebut');
            $table->date('dateFin')->nullable(); // nullable car un projet en cours n'a pas encore de date de fin
            $table->string('lienGithub')->nullable(); // nullable au cas où le projet n'a pas de dépôt Git
            
            $table->timestamps(); // Crée 'created_at' et 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};