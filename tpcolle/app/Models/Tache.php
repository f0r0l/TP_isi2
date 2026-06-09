<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tache extends Model
{
    protected $primaryKey = 'idTache';

    protected $fillable = ['titre', 'details', 'etat', 'priorite', 'utilisateur_id', 'projet_id'];

    /**
     * Relation : La tâche appartient à un projet (1,1)
     */
    public function projet(): BelongsTo
    {
        return $this->belongsTo(Projet::class, 'projet_id', 'idProjet');
    }

    /**
     * Relation : La tâche est affectée à un utilisateur (1,1)
     */
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'utilisateur_id', 'idUtilisateur');
    }
}