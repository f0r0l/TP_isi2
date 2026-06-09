<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    // Indiquer la clé primaire personnalisée du MCD
    protected $primaryKey = 'idUtilisateur';

    protected $fillable = ['nom', 'prenom', 'email'];

    /**
     * Relation : Un utilisateur possède plusieurs tâches (0,n ou 1,n)
     */
    public function taches(): HasMany
    {
        return $this->hasMany(Tache::class, 'utilisateur_id', 'idUtilisateur');
    }
}