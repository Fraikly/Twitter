<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikesForComment>
 */
class LikesForCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment_id'=>Comment::get()->random()->id,
            'user_id'=>User::get()->random()->id
        ];
    }
}
