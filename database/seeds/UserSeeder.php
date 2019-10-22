<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = [
        ['name' => 'Adeel Walmsley', 'email' => 'test1@restaurant.ca','password' => '12345'],
        ['name' => 'Suhail Davidson', 'email' => 'test2@restaurant.ca','password' => '12345'],
        ['name' => 'Kyle Casey', 'email' => 'test3@restaurant.ca','password' => '12345'],
      ];
      DB::table('users')->insert($users);
    }
}
