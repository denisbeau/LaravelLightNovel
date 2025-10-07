<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LightNovel>
 */
class LightNovelFactory extends Factory
{
    public function definition()
    {
        return [
            'titre' => $this->faker->sentence(3, true),
            'auteur' => $this->faker->name(),
            'statut' => $this->faker->randomElement(['En cours', 'Terminé', 'Hiatus']),
            'chapitres' => $this->faker->numberBetween(1, 200),
            'Contenu' => $this->faker->paragraphs(5, true),
        ];
    }
}
