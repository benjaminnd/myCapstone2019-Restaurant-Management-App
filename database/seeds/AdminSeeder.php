<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds for admin user
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
          'name' => 'Minh Dang',
          'email' => 'minh.chef@restaurant.ca',
          'password' => bcrypt('12345')
      ]);
    }
}
