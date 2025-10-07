<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition()
    {
        return [
            // adapte aux colonnes de ta table users (email, password_hash, isAdmin, isAuteur, join_date, profile_image_url, username)
            'email' => $this->faker->unique()->safeEmail(),
            'password_hash' => Hash::make('password'), // mot de passe par défaut
            'isAdmin' => $this->faker->boolean(10) ? 1 : 0,
            'isAuteur' => $this->faker->boolean(40) ? 1 : 0,
            'join_date' => $this->faker->date(),
            'profile_image_url' => $this->faker->imageUrl(400, 400, 'people'),
            'username' => $this->faker->userName(),
        ];
    }
}
