<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Database seeds for Inventory
     *
     * @return void
     */
    public function run()
    {
      $inventories = [
        ['name' => 'table salt', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '3', 'imported_date' => Carbon::now()],
        ['name' => 'fish sauce', 'price' => '6.3', 'quantity' => '12', 'supplier_id' => '1', 'imported_date' => Carbon::now()],
        ['name' => 'jasmine rice', 'price' => '12', 'quantity' => '12', 'supplier_id' => '2', 'imported_date' => Carbon::now()],
        ['name' => 'carrots', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '3', 'imported_date' => Carbon::now()],
        ['name' => 'Triple A beef', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '1', 'imported_date' => Carbon::now()],
        ['name' => 'flour', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '2', 'imported_date' => Carbon::now()],
        ['name' => 'ginger', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '2', 'imported_date' => Carbon::now()],
        ['name' => 'chicken breast', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '3', 'imported_date' => Carbon::now()],
      ];

      DB::table('inventories')->insert($inventories);
    }
}
