<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $users = User::factory(50)->create();
//
//        foreach ($users as $user){
//            $subscribers = $users->random(rand(0,50))->pluck('id');
//            $user->subscribers()->attach($subscribers);
//        }
        Twit::factory(1000)->create();

    }
}
