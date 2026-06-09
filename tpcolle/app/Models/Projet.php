<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projet extends Model
{
    // Indiquer la clé primaire personnalisée
    protected $primaryKey = 'idProjet';

    // Les champs modifiables en masse
    protected $fillable = ['nomProjet', 'dateDebut', 'dateFin', 'lienGithub'];

    /**
     * Relation : Un projet possède plusieurs tâches (1,n)
     */
    public function taches(): HasMany
    {
        // 'projet_id' est la clé étrangère dans la table 'taches'
        // 'idProjet' est la clé locale dans la table 'projets'
        return $this->hasMany(Tache::class, 'projet_id', 'idProjet');
    }
}