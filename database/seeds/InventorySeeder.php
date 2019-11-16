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
        ['name' => 'table salt', 'unit'=>'pack', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '3', 'imported_date' => Carbon::now()],
        ['name' => 'fish sauce', 'unit'=>'bottle', 'price' => '6.3', 'quantity' => '12', 'supplier_id' => '1', 'imported_date' => Carbon::now()],
        ['name' => 'jasmine rice', 'unit'=>'pack', 'price' => '12', 'quantity' => '12', 'supplier_id' => '2', 'imported_date' => Carbon::now()],
        ['name' => 'carrots', 'unit'=>'lbs', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '3', 'imported_date' => Carbon::now()],
        ['name' => 'Triple A beef', 'unit'=>'pack', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '1', 'imported_date' => Carbon::now()],
        ['name' => 'flour', 'unit'=>'pack', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '2', 'imported_date' => Carbon::now()],
        ['name' => 'ginger', 'unit'=>'unit', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '2', 'imported_date' => Carbon::now()],
        ['name' => 'chicken breast', 'unit'=>'lbs', 'price' => '3.6', 'quantity' => '12', 'supplier_id' => '3', 'imported_date' => Carbon::now()],
      ];

      DB::table('inventories')->insert($inventories);
    }
}
