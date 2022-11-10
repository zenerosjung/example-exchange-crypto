<?php

namespace Database\Seeders;

use App\Models\FiatWallet;
use App\Models\FiatWalletCryptocurrency;
use App\Models\FundingWallet;
use App\Models\FundingWalletCryptocurrency;
use App\Models\User;
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

        $cryptocurrency = DB::select('select * from cryptocurrency where name = \'BTC\'');
        $users = User::all();
        foreach ($users as $user) {
            $fiat_wallet = new FiatWallet(['user_id' => $user->id]);
            $fiat_wallet->save();

            $fiat_wallet_cryptocurrency = new FiatWalletCryptocurrency([
                'fiat_wallet_id' => $fiat_wallet->id,
                'cryptocurrency_id' => $cryptocurrency[0]->id
            ]);
            $fiat_wallet_cryptocurrency->save();

            $funding_wallet = new FundingWallet(['user_id' => $user->id]);
            $funding_wallet->save();

            $funding_wallet_cryptocurrency = new FundingWalletCryptocurrency([
                'funding_wallet_id' => $funding_wallet->id,
                'cryptocurrency_id' => $cryptocurrency[0]->id
            ]);
            $funding_wallet_cryptocurrency->save();
        }
    }
}
