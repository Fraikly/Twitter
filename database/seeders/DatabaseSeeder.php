<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Image;
use App\Models\LikesForComment;
use App\Models\LikesForTwit;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $NumberOfUsers = 100;
        $NumberOfTwits = 300;
        $NumberOfComments = 300;
        $NumberOfLikesForTwits = 10000;
        $NumberOfLikesForComments = 5000;

        $MaxNumberOfSubscribers = 50;
        $MinNumberOfSubscribers = 0;

        $users = User::factory($NumberOfUsers)->create();
        $icons = Storage::files('public/icons');
        if (count($icons) > 0)
            foreach ($users as $user) {
                $user->update([
                    'picture' => explode('public/', $icons[rand(0, count($icons) - 1)])[1],
                ]);
                $subscribers = $users->random(rand($MinNumberOfSubscribers, $MaxNumberOfSubscribers))->pluck('id');
                $user->subscribers()->attach($subscribers);
            }

        $twits = Twit::factory($NumberOfTwits)->create();

        for ($i = 0; $i < count($twits); $i += rand(1, 20)) {
            for ($j = 0; $j < rand(1, 5); $j++)
                Twit::create([
                    'user_id' => User::get()->random()->id,
                    'text' => fake()->text(200),
                    'retwit' => 1,
                    'original_twit' => Twit::get()->random()->id,
                ]);
        }

        LikesForTwit::factory($NumberOfLikesForTwits)->create();
        $photos = Storage::files('public/photos');

        if (count($photos) > 0)
            foreach (Twit::all() as $twit) {
                for ($i = 0; $i < rand(0, 3); $i++) {
                    Image::create([
                        'twit_id' => $twit->id,
                        'patch' => explode('public/', $photos[rand(0, count($photos) - 1)])[1],
                    ]);
                }
            }


        $comments = Comment::factory($NumberOfComments)->create();

        for ($i = 0; $i < count($comments); $i += rand(1, 5)) {
            for ($j = 0; $j < rand(1, 10); $j++)
                Comment::create([
                    'twit_id' => $comments[$i]->twit_id,
                    'user_id' => User::get()->random()->id,
                    'text' => fake()->text(190),
                    'is_answer' => 1,
                    'comment_id' => $comments[$i]->id,
                ]);
        }
        LikesForComment::factory($NumberOfLikesForComments)->create();
    }
}
