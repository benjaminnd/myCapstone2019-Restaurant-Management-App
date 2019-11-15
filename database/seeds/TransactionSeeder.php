<?php
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $transactions = [
        ['name' => 'John Doe',
         'phone'=>'613-555-0176',
         'address' => '70 West 1st, Hamilton, ON',
         'date' => '11/13/2019',
         'items' => '{"items":[{"name":"Chicken Sharwarma and Rice","quantity":"1"},{"name":"Chicken Sharwarma and Rice","quantity":"1"},{"name":"Wonton Soup","quantity":"1"},{"name":"Sprite","quantity":"2"}]}',
         'payment_option' => 'debit',
         'total' => '30',
         'food' => '3',
         'drink' => '2',
         'food_total' => '36',
         'drink_total' => '6'
        ],
        ['name' => 'Jack',
         'phone'=>'613-555-0140',
         'address' => '720 Montee Sabourin St',
         'date' => '11/13/2019',
         'items' => '{"items":[{"name":"Vietnamese Fried Rice","quantity":"1"},{"name":"Wonton Soup","quantity":"1"},{"name":"Spring Roll","quantity":"1"},{"name":"Coke","quantity":"3"}]}',
         'payment_option' => 'cash',
         'total' => '45',
         'food' => '3',
         'drink' => '3',
         'food_total' => '30',
         'drink_total' => '9'
        ],
        ['name' => 'Joe',
         'phone'=>'613-555-0105',
         'address' => '23 Thornhill ON L3T',
         'date' => '11/12/2019',
         'items' => '{"items":[{"name":"Beef Noodle","quantity":"2"},{"name":"Spring Roll","quantity":"2"},{"name":"Wonton Soup","quantity":"1"},{"name":"Sprite","quantity":"1"}]}',
         'payment_option' => 'credit',
         'total' => '51',
         'food' => '5',
         'drink' => '1',
         'food_total' => '48',
         'drink_total' => '3'
        ],
        ['name' => 'Minh',
         'phone'=>'613-555-0189',
         'address' => '2160 Abbotswood Crt',
         'date' => '11/12/2019',
         'items' => '{"items":[{"name":"Chicken Sharwarma and Rice","quantity":"1"},{"name":"Chicken Sharwarma and Rice","quantity":"1"},{"name":"Wonton Soup","quantity":"1"},{"name":"Sprite","quantity":"1"}]}',
         'payment_option' => 'debit',
         'total' => '39',
         'food' => '3',
         'drink' => '1',
         'food_total' => '36',
         'drink_total' => '3'
        ],
        ['name' => 'Will',
         'phone'=>'613-555-0135',
         'address' => '614 1 St Ave',
         'date' => '11/11/2019',
         'items' => '{"items":[{"name":"Fish and Chips","quantity":"2"},{"name":"Chicken Sharwarma and Rice","quantity":"1"},{"name":"Wonton Soup","quantity":"1"},{"name":"Coke","quantity":"3"}]}',
         'payment_option' => 'debit',
         'total' => '57',
         'food' => '4',
         'drink' => '3',
         'food_total' => '36',
         'drink_total' => '3'
        ],
        ['name' => 'Chris',
         'phone'=>'613-555-0183',
         'address' => '2680 Bainbridge Ave',
         'date' => '11/11/2019',
         'items' => '{"items":[{"name":"Chicken Sharwarma and Rice","quantity":"1"},{"name":"Beef Noodle","quantity":"1"},{"name":"Coke","quantity":"1"}]}',
         'payment_option' => 'debit',
         'total' => '27',
         'food' => '2',
         'drink' => '1',
         'food_total' => '24',
         'drink_total' => '3'
        ],
      ];

      DB::table('transactions')->insert($transactions);
    }
}
