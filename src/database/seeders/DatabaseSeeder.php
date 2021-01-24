<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(100)->create();
        \App\Models\Sneaker::factory(100)->create();
        \App\Models\Rating::factory(100)->create();
		\App\Models\Note::factory(100)->create();
       // factory(App\Models\User::class, 100)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(SneakersTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
		$this->call(NoteSeeder::class);
    }
}
