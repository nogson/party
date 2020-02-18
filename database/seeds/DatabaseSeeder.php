<?php

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
        DB::table('users')->delete();
        DB::table('profiles')->delete();
        DB::table('skills')->delete();

        factory(App\User::class, 10)->create();
        factory(App\Profile::class, 10)->create();
        factory(App\Skill::class, 40)->create();

    }
}
