<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
    public function definition()
    {
        return [
            // on reliera correctement ces ids dans le seeder pour être sûr des FK
            'Light_Novel_id' => null, // sera remplacé dans le seeder
            'users_id' => null,      // sera remplacé dans le seeder
            'texte' => $this->faker->sentence(12, true),
            'efface' => 0,
        ];
    }
}
