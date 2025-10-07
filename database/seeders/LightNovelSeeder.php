<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LightNovel;

class LightNovelSeeder extends Seeder
{
    public function run(): void
    {
        // 3 exemples depuis ton dump
        LightNovel::insert([
            [
                'titre' => 'Peccato',
                'auteur' => 'Azeeliaz',
                'statut' => 'En cours',
                'chapitres' => 12,
                'Contenu' => 'Dans un monde ou règnent la cruauté et les ténèbres... (texte abrégé)',
            ],
            [
                'titre' => 'Mon étoile',
                'auteur' => 'Eva_rangers',
                'statut' => 'Terminé',
                'chapitres' => 22,
                'Contenu' => 'Elle porte le courage... (texte abrégé)',
            ],
            [
                'titre' => "Les Cendres du Silence",
                'auteur' => 'Oranne6',
                'statut' => 'En cours',
                'chapitres' => 3,
                'Contenu' => "Deux âmes qui se croisent depuis l'enfance...",
            ],
        ]);

        // et quelques LN aléatoires si besoin
        LightNovel::factory()->count(7)->create();
    }
}
