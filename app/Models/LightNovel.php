<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LightNovel extends Model
{
    use HasFactory;

    // La table suit la convention 'light_novels', donc pas besoin de protected $table.
    // Remarque : la colonne 'Contenu' dans le dump est avec un C majusacule, on la garde.
    protected $fillable = [
        'titre',
        'auteur',
        'statut',
        'chapitres',
        'Contenu',
        'photo'
    ];

    /**
     * Relation : un light_novel a plusieurs commentaires.
     * Clé étrangère dans la table commentaires : Light_Novel_id
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'Light_Novel_id', 'id');
    }
}
