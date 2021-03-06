<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Database seeds for user
     *
     * @return void
     */
    public function run()
    {
      $users = [
        ['name' => 'Adeel Walmsley', 'email' => 'test1@restaurant.ca','password' => Hash::make('12345')],
        ['name' => 'Suhail Davidson', 'email' => 'test2@restaurant.ca','password' => Hash::make('12345')],
        ['name' => 'Kyle Casey', 'email' => 'test3@restaurant.ca','password' => Hash::make('12345')],
      ];
      DB::table('users')->insert($users);
    }
}
