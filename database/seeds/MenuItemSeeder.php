<?php

use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $menu_items = [
        ['name' => 'Chicken Sharwarma and Rice', 'recipe_id' => '1', 'price' => '12', 'item_description' => 'Vietnamese style chicken sharwarma on jasmine rice', 'type' => 'food', 'tags' => 'Halal, Vietnamese, spicy'],
        ['name' => 'Beef Noodle', 'recipe_id' => '2', 'price' => '12', 'item_description' => 'Vietnamese style Beef noodle', 'type' => 'food', 'tags' => 'Vietnamese'],
        ['name' => 'Spring Roll', 'recipe_id' => '3', 'price' => '12', 'item_description' => 'Shrimp and pork deep fried spring roll', 'type' => 'food', 'tags' => 'Vietnamese'],
        ['name' => 'Fish and Chips', 'recipe_id' => '4', 'price' => '12', 'item_description' => 'Western style cod fish and chips', 'type' => 'food', 'tags' => 'Western, Seafood'],
        ['name' => 'Vietnamese Fried Rice', 'recipe_id' => '5', 'price' => '12', 'item_description' => 'Vietnamese style fried rice with choice of chicken or seafood', 'type' => 'food', 'tags' => 'Vietnamese, Seafood'],
        ['name' => 'Wonton Soup', 'recipe_id' => '6', 'price' => '12', 'item_description' => 'Chinese style Wonton soup', 'type' => 'food', 'tags' => 'Chinese'],
      ];

      $drinks = [
        ['name' => 'Coke', 'price' => '3', 'type' => 'drink', 'tags' => 'drink'],
        ['name' => 'Sprite', 'price' => '3', 'type' => 'drink', 'tags' => 'drink'],
      ];

      DB::table('menu_items')->insert($menu_items);
      DB::table('menu_items')->insert($drinks);
    }
}
