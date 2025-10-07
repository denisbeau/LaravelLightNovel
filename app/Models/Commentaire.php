<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    // La table 'commentaires' suit la convention, donc pas besoin de protected $table.
    protected $fillable = [
        'Light_Novel_id',
        'users_id',
        'texte',
        'efface',
    ];

    /**
     * Relation : le commentaire appartient à un light_novel.
     */
    public function lightNovel()
    {
        return $this->belongsTo(LightNovel::class, 'Light_Novel_id', 'id');
    }

    /**
     * Relation : le commentaire appartient à un user.
     * Le dump indique users.id est bigint unsigned (standard Laravel), donc users_id est bigint unsigned.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id', 'id');
    }
}
