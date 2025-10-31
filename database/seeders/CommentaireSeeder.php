<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commentaire;
use App\Models\LightNovel;
use App\Models\User;

class CommentaireSeeder extends Seeder
{
    public function run(): void
    {
        // récupérer tous les ids existants
        $lightNovelIds = LightNovel::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        // s'il n'y a pas d'ids, quitter proprement
        if (empty($lightNovelIds) || empty($userIds)) {
            return;
        }

        // créer des commentaires aléatoires
        foreach (range(1, 20) as $i) {
            Commentaire::create([
                'light_novel_id' => $this->fakerChoice($lightNovelIds),
                'user_id' => $this->fakerChoice($userIds),
                'texte' => 'Commentaire exemple ' . $i,
                'efface' => 0,
            ]);
        }

        // quelques commentaires provenant de ton dump
        Commentaire::insert([
            [
                'light_novel_id' => 2,
                'user_id' => 1,
                'texte' => 'J’adore l’ambiance. On se croirait dans un vrai animé."',
                'efface' => 0,
            ],
            [
                'light_novel_id' => 2,
                'user_id' => 3,
                'texte' => 'L’univers est super immersif, hâte de lire le prochain chapitre !',
                'efface' => 0,
            ],
        ]);
    }

    // helper simple pour choisir un id au hasard sans faker directement
    private function fakerChoice(array $arr)
    {
        return $arr[array_rand($arr)];
    }
}
