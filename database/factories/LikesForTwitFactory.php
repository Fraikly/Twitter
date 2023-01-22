<?php

namespace Database\Factories;

use App\Models\Twit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikesForTwit>
 */
class LikesForTwitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'twit_id' =>Twit::get()->random()->id,
            'User_id'=>User::get()->random()->id
        ];
    }
}
