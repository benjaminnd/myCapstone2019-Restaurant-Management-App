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
        $this->call(AdminSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(MenuItemSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(UserSeeder::class);
    }
}
