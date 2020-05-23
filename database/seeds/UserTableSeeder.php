<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create a store 50 users
        factory(App\User::class, 50) -> create();
        //create and return array of 50 users without store
        //factory(App\User::class, 50) -> create();

    }
}
