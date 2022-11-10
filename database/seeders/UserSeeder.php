<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'name' => 'john',
            'email' => 'john@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $crypto_list = [
            'USDT', 'BTC', 'BUSD', 'BNB', 'ETH', 'ADA', 'SHIB', 'DOGE'
        ];
        foreach ($crypto_list as $crypto) {
            DB::table('cryptocurrency')->insert([
                'name' => $crypto
            ]);
        }

        DB::table('currency')->insert([
            'name' => 'THB'
        ]);
    }
}
