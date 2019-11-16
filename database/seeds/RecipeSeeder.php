<?php

use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Database seed for Recipe
     *
     * @return void
     */
    public function run()
    {
      $recipes = [
        ['name' => 'Chicken Sharwarma and Rice',
        'description' => 'First, prepare the chicken. Marinate the chicken cubes in the ingredients preferably overnight or for at least 4 hours. Skewer them and grill until tender. You can dab a bit of oil on the pieces as they grill. Do not over-cook them, they should be ready within 10-15minutes. Make sure you turn the skewers several times if you’re grilling on a bbq grill to ensure all sides are evenly cooked. If baking under an oven grill, set the temperature at 200 C, bake for 10 minutes per side or until slightly charred. Remove from the skewers, chop into smaller chunks and keep warm. Next, prepare the rice.'],
        ['name' => 'Beef Noodle',
        'description' => 'In a large pot, heat oil over medium heat. Sauté garlic, onion and ginger for 5 minutes. Add five-spice powder, broth, hoisin sauce and fish sauce; bring to a boil. Boil for 5 minutes. Add noodles and boil for 5 minutes. Stir in beef and boil until noodles are tender and beef is hot. (Be careful not to overcook noodles or they will become mushy.) Ladle soup into large bowls and sprinkle with green onions, bean sprouts, cilantro and mint. Serve with lime quarters, jalapeño slices (if using) and Sriracha. Tip: Place beef in freezer for 15 minutes before slicing; this makes it easier to slice the meat very thinly.'],
        ['name' => 'Spring Roll',
        'description' => 'In a large skillet heat sesame oil over medium heat and cook pork, garlic, ginger, salt, and sugar for about 8 minutes or until no longer pink inside. Stir in cabbage, carrots, green onions, and soy sauce; cook for about 2 minutes or until softened. Remove from heat and place in large bowl; let cool slightly. Stir in eggs until combined. Place about 1/3 cup of the filling in the centre of the spring roll wrapper. Brush edges of wrapper with water, fold in sides, and roll up to cover filling. Repeat with remaining filling and wrappers. Heat canola oil in a heavy skillet and cook the spring rolls for about 4 minutes, turning once until golden brown on both sides. Remove to rack and repeat with remaining egg rolls.'],
        ['name' => 'Fish and Chips',
        'description' => 'Preheat the oil, setting the deep fryer to 180 °C (350 °F). Place a wire rack on a baking sheet. Preheat the oven to 100 °C (200 °F) to keep the fries warm in the oven while cooking the fish. Dip the potatoes in warm water to remove the starch. Drain and pat the potatoes dry in a clean cloth. Fry the potatoes for about 8 minutes or until tender and lightly browned. Drain the fries and place on the rack. Let cool. In a bowl, combine 250 ml (1 cup) of flour with the cornstarch, salt, and baking powder. Gradually add the beer, whisking until the mixture is smooth. Set aside. Put the potatoes back in the deep fryer and cook for 3 to 4 minutes or until golden brown. Remove from the fryer and drain on the baking sheet. Sprinkle with salt and keep warm. Season the fish pieces with salt and pepper and dredge in the remaining flour. Shake to remove any excess. Dip each piece in the batter and coat well. Drain and fry while shaking the basket for a few seconds to prevent them from sticking to the bottom. Cook for about 5 minutes. Remove the fish and drain on a wire rack.'],
        ['name' => 'Vietnamese Fried Rice',
        'description' => 'Heat the peanut oil in a wok or frying pan. Pour in the beaten eggs. Cook, swirling often, just until set. Scoop out and transfer to a cutting board. Over medium heat, saute the lemongrass, garlic, and shallots until softened and aromatic. Turn up the heat, add the chopped carrot and sweet peas, and stir fry for half a minute. Add the sliced lap cheong and the barbecued pork. Stir fry for about a minute. Add the rice. Pour in about a teaspoonful of fish sauce. Stir fry until the rice is heated through. Turn off the heat. Roll up the egg like a cigar and cut into thin slices. Add to the rice. Toss. Squeeze the lime quarter over the fried rice. Toss a few more times. Serve hot garnished with cilantro, lemon basil or mint, or all three.'],
        ['name' => 'Wonton Soup',
        'description' => 'Dice the green onions, and set aside all but 1 tablespoon. Slice the mushrooms, and set aside all but 1 tablespoon. Finely chop the 1 tablespoon of green onions and 1 tablespoon of sliced mushrooms, and place in a bowl with the ground pork, 1 tablespoon sesame oil, 1 tablespoon soy sauce, egg, bread crumbs, salt, and pepper. Stir to thoroughly mix the pork filling.'],
      ];

      DB::table('recipes')->insert($recipes);
    }
}
