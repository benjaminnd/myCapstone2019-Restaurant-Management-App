<?php

use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $recipes = [
        ['name' => 'Chicken Sharwarma and Rice',  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget mauris posuere, mattis nisl eget, facilisis tortor. Sed at fringilla nisl, et faucibus magna. Pellentesque in dapibus nulla. Etiam neque arcu, congue sit amet tincidunt vitae, semper at lectus. Duis id mauris vitae ex vestibulum ullamcorper. Vivamus eleifend massa ac aliquet tincidunt.'],
        ['name' => 'Beef Noodle',  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget mauris posuere, mattis nisl eget, facilisis tortor. Sed at fringilla nisl, et faucibus magna. Pellentesque in dapibus nulla. Etiam neque arcu, congue sit amet tincidunt vitae, semper at lectus. Duis id mauris vitae ex vestibulum ullamcorper. Vivamus eleifend massa ac aliquet tincidunt.'],
        ['name' => 'Spring Roll',  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget mauris posuere, mattis nisl eget, facilisis tortor. Sed at fringilla nisl, et faucibus magna. Pellentesque in dapibus nulla. Etiam neque arcu, congue sit amet tincidunt vitae, semper at lectus. Duis id mauris vitae ex vestibulum ullamcorper. Vivamus eleifend massa ac aliquet tincidunt.'],
        ['name' => 'Fish and Chips',  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget mauris posuere, mattis nisl eget, facilisis tortor. Sed at fringilla nisl, et faucibus magna. Pellentesque in dapibus nulla. Etiam neque arcu, congue sit amet tincidunt vitae, semper at lectus. Duis id mauris vitae ex vestibulum ullamcorper. Vivamus eleifend massa ac aliquet tincidunt.'],
        ['name' => 'Vietnamese Fried Rice',  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget mauris posuere, mattis nisl eget, facilisis tortor. Sed at fringilla nisl, et faucibus magna. Pellentesque in dapibus nulla. Etiam neque arcu, congue sit amet tincidunt vitae, semper at lectus. Duis id mauris vitae ex vestibulum ullamcorper. Vivamus eleifend massa ac aliquet tincidunt.'],
        ['name' => 'Wonton Soup',  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget mauris posuere, mattis nisl eget, facilisis tortor. Sed at fringilla nisl, et faucibus magna. Pellentesque in dapibus nulla. Etiam neque arcu, congue sit amet tincidunt vitae, semper at lectus. Duis id mauris vitae ex vestibulum ullamcorper. Vivamus eleifend massa ac aliquet tincidunt.'],
      ];

      DB::table('recipes')->insert($recipes);
    }
}
