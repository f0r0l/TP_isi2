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
        Schema::create('taches', function (Blueprint $table) {
            // Clé primaire conforme au MCD
            $table->id('idTache');
            
            // Attributs textuels
            $table->string('titre');
            $table->text('details')->nullable(); // nullable permet de ne pas mettre de détails
            
            // État de la tâche : vrai si terminée, faux si en cours (par défaut)
            $table->boolean('etat')->default(false);
            
            // Liste stricte des priorités demandées dans l'énoncé
            $table->enum('priorite', [
                'top priority',
                'very high priority',
                'high priority',
                'normal priority',
                'low priority'
            ])->default('normal priority'); // Priorité par défaut si non spécifiée

            // --- CLÉS ÉTRANGÈRES ---
            
            // Liaison avec la table 'users' sur la clé personnalisée 'idUtilisateur'
            $table->foreignId('utilisateur_id')
                  ->constrained('users', 'idUtilisateur')
                  ->onDelete('cascade'); // Si l'utilisateur est supprimé, ses tâches le sont aussi

            // Liaison avec la table 'projets' sur la clé personnalisée 'idProjet'
            $table->foreignId('projet_id')
                  ->constrained('projets', 'idProjet')
                  ->onDelete('cascade'); // Si le projet est supprimé, ses tâches le sont aussi
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};