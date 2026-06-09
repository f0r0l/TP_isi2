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
    $table->id('idTache'); // idTache
    $table->string('titre');
    $table->text('details')->nullable();
    
    // Note : etat est de type booléen (vrai = terminée, faux = en cours)
    $table->boolean('etat')->default(false);
    
    // Le champ « priorite » contient une liste définie
    $table->enum('priorite', [
        'top priority', 
        'very high priority', 
        'high priority', 
        'normal priority', 
        'low priority'
    ])->default('normal priority');

    // Clés étrangères (Foreign Keys) découlant des relations 1,1
    $table->foreignId('utilisateur_id')->constrained('users', 'idUtilisateur')->onDelete('cascade');
    $table->foreignId('projet_id')->constrained('projets', 'idProjet')->onDelete('cascade');
    
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
