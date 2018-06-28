<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert(
            array(
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'role'=>0
            ));


        DB::table('suppliers')->insert(array(
            'name' => 'Hvac',
            'account_id' => 'E151029136',
            'cnic' => '12345-1234567-2',
            'city' => 'rawalpindi',
            'address' => 'address 2',
            'phone' => '0515566000',
            'mobile' => '+923335000333',
            'email' => 'suppliers1@gmail.com',
            'contact_person' => 'Zahid mansoor',

        ));
        DB::table('suppliers')->insert(array(
            'name' => 'Dell',
            'account_id' => 'E15102913600',
            'cnic' => '12345-1234567-5',
            'city' => 'Colombo',
            'address' => 'Sirilanka address 1',
            'phone' => '0515566116',
            'mobile' => '+423335888333',
            'email' => 'mahelajayawardene@yahoo.com',
            'contact_person' => 'Mahela Jayawardene',

        ));
        DB::table('suppliers')->insert(array(
            'name' => 'HP',
            'account_id' => 'E15102913611',
            'cnic' => '12345-1234567-4',
            'city' => 'Islamabad',
            'address' => 'address 3',
            'phone' => '0515566111',
            'mobile' => '+923335111333',
            'email' => 'younuskhan@gmail.com',
            'contact_person' => 'Younus khan',

        ));

        DB::table('brands')->insert(
            array(
                'name' => 'Brand 1',
                'description' => 'for test',
            )
        );
        DB::table('brands')->insert(
            array(
                'name' => 'Brand 2',
                'description' => 'for test',
            )
        );


        DB::table('categories')->insert(
            array(
                'name' => 'Cat 1',
                'description' => 'for test',
            )
        );
        DB::table('categories')->insert(
            array(
                'name' => 'Cat 2',
                'description' => 'for test',
            )
        );


        DB::table('customers')->insert(array(
            'name' => 'Default',
            'account_id' => '00000000',
            'cnic' => 'xxxxx-xxxxxxx-x',
            'city' => 'city',
            'address' => 'address',
            'phone' => '051000000',
            'mobile' => '+923330000000',
            'email' => 'customer@default.com',
            'contact_person' => 'Default',

        ));
        DB::table('customers')->insert(array(
            'name' => 'Ali Group Of Company',
            'account_id' => 'E1510291',
            'cnic' => '12345-1234567-1',
            'city' => 'rawalpindi',
            'address' => 'address 1',
            'phone' => '0515566995',
            'mobile' => '+923335000000',
            'email' => 'customers1@gmail.com',
            'contact_person' => 'Ali Mahmood',

        ));


        DB::table('items')->insert(
            array(
                'item_name' => 'Item 1',
                'description' => 'for test',
                'item_number' => '-0000123456789',
                'brand'=>1,
                'category'=>1,
                'quantity_in_stock'=>0,
            )
        );
        DB::table('items')->insert(
            array(
                'item_name' => 'Item 2',
                'description' => 'for test',
                'item_number' => '-0000123456780',
                'brand'=>1,
                'category'=>1,
                'quantity_in_stock'=>0,
            )

        );
        DB::table('items')->insert(
            array(
                'item_name' => 'Item 3',
                'description' => 'for test',
                'item_number' => '-0000123456781',
                'brand'=>1,
                'category'=>1,
                'quantity_in_stock'=>0,
            )
        );

    }
}
