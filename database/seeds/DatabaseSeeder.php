<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
