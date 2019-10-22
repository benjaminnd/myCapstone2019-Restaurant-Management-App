<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $suppliers = [
        ['name' => 'cotsco', 'email' => 'cotsco@gmail.ca', 'phone' => '905555555'],
        ['name' => 'walmart', 'email' => 'walmart@gmail.ca', 'phone' => '9056666666'],
        ['name' => 'fortinos', 'email' => 'fortinos@gmail.ca', 'phone' => '9057777777'],
        ['name' => 'nations', 'email' => 'nations@gmail.ca', 'phone' => '9058888888'],
      ];

      DB::table('suppliers')->insert($suppliers);
    }
}
