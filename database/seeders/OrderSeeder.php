<?php

namespace Database\Seeders;

use App\Models\Cryptocurrency;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_type')->insert([
            'name' => 'Bank Transfer'
        ]);
        DB::table('payment_type')->insert([
            'name' => 'True Money'
        ]);

        $users = User::all();
        $currencies = Currency::all();
        $payment_types = PaymentType::all();

        DB::table('user_payment_bank_transfer')->insert([
            'user_id' => $users[0]->id,
            'payment_type_id' => $payment_types[0]->id,
            'bank_account' => '1111 2222 3333 4444',
            'bank_name' => 'SCB',
            'bank_branch' => ''
        ]);
        DB::table('user_payment_true_money')->insert([
            'user_id' => $users[0]->id,
            'payment_type_id' => $payment_types[1]->id,
            'phone' => '0888888888',
            'username' => 'john',
            'qr_code' => ''
        ]);
        $this->createBuyOrder($users[0]->id, $currencies[0]->id);
        $this->createSellOrder($users[0]->id, $currencies[0]->id);
    }

    private function createBuyOrder($user_id, $currency_id)
    {
        $cryptocurrency_list = Cryptocurrency::all();
        $payment_type = PaymentType::all()->first();
        $order_list = [];

        // USDT
        $order_list[] = [
            'price' => 36.73,
            'cryptocurrency_id' => $cryptocurrency_list[0]->id,
            'total' => 50000.00,
            'available' => 14341.01,
            'limit_min' => 50000.00,
            'limit_max' => 526745.34
        ];
        $order_list[] = [
            'price' => 36.77,
            'cryptocurrency_id' => $cryptocurrency_list[0]->id,
            'total' => 800.00,
            'available' => 557.98,
            'limit_min' => 50000.00,
            'limit_max' => 526745.34
        ];
        $order_list[] = [
            'price' => 36.76,
            'cryptocurrency_id' => $cryptocurrency_list[0]->id,
            'total' => 500.00,
            'available' => 340.89,
            'limit_min' => 2000.00,
            'limit_max' => 12527.86
        ];

        // BTC
        $order_list[] = [
            'price' => 630710.57,
            'cryptocurrency_id' => $cryptocurrency_list[1]->id,
            'total' => 0.500000000,
            'available' => 0.48412122,
            'limit_min' => 1000.00,
            'limit_max' => 305340.37
        ];
        $order_list[] = [
            'price' => 630710.51,
            'cryptocurrency_id' => $cryptocurrency_list[1]->id,
            'total' => 0.70000000,
            'available' => 0.65204984,
            'limit_min' => 2000.00,
            'limit_max' => 411254.68
        ];
        $order_list[] = [
            'price' => 631125.30,
            'cryptocurrency_id' => $cryptocurrency_list[1]->id,
            'total' => 0.04000000,
            'available' => 0.03698302,
            'limit_min' => 5000.00,
            'limit_max' => 23340.91
        ];
        // BUSD
        $order_list[] = [
            'price' => 36.36,
            'cryptocurrency_id' => $cryptocurrency_list[2]->id,
            'total' => 4000.00000000,
            'available' => 3567.89643216,
            'limit_min' => 1000.00,
            'limit_max' => 129728.71
        ];
        $order_list[] = [
            'price' => 36.35,
            'cryptocurrency_id' => $cryptocurrency_list[2]->id,
            'total' => 30.00000000,
            'available' => 26.24278089,
            'limit_min' => 500.00,
            'limit_max' => 953.92
        ];
        $order_list[] = [
            'price' => 36.33,
            'cryptocurrency_id' => $cryptocurrency_list[2]->id,
            'total' => 120.00000000,
            'available' => 103.04885663,
            'limit_min' => 1000.00,
            'limit_max' => 3743.76
        ];
        // BNB
        $order_list[] = [
            'price' => 10837.75,
            'cryptocurrency_id' => $cryptocurrency_list[3]->id,
            'total' => 10.00000000,
            'available' => 10.00000000,
            'limit_min' => 1000.00,
            'limit_max' => 108377.50
        ];
        $order_list[] = [
            'price' => 12254.91,
            'cryptocurrency_id' => $cryptocurrency_list[3]->id,
            'total' => 0.40000000,
            'available' => 0.23185850,
            'limit_min' => 50.00,
            'limit_max' => 2841.40
        ];
        $order_list[] = [
            'price' => 11321.35,
            'cryptocurrency_id' => $cryptocurrency_list[3]->id,
            'total' => 0.15000000,
            'available' => 0.10838005,
            'limit_min' => 50.00,
            'limit_max' => 1227.00
        ];
        // ETH
        $order_list[] = [
            'price' => 47443.05,
            'cryptocurrency_id' => $cryptocurrency_list[4]->id,
            'total' => 0.55000000,
            'available' => 0.53948017,
            'limit_min' => 500.00,
            'limit_max' => 5000.00
        ];
        $order_list[] = [
            'price' => 47443.05,
            'cryptocurrency_id' => $cryptocurrency_list[4]->id,
            'total' => 4.00000000,
            'available' => 2.22463308,
            'limit_min' => 3000.00,
            'limit_max' => 105543.37
        ];
        $order_list[] = [
            'price' => 46520.48,
            'cryptocurrency_id' => $cryptocurrency_list[4]->id,
            'total' => 0.30000000,
            'available' => 0.22511400,
            'limit_min' => 500.00,
            'limit_max' => 10472.41
        ];
        // ADA
        $order_list[] = [
            'price' => 15.55,
            'cryptocurrency_id' => $cryptocurrency_list[5]->id,
            'total' => 2000.00,
            'available' => 702.03,
            'limit_min' => 600.00,
            'limit_max' => 10000.00
        ];
        $order_list[] = [
            'price' => 17.18,
            'cryptocurrency_id' => $cryptocurrency_list[5]->id,
            'total' => 90.00,
            'available' => 76.74,
            'limit_min' => 50.00,
            'limit_max' => 1318.39
        ];
        $order_list[] = [
            'price' => 13.32,
            'cryptocurrency_id' => $cryptocurrency_list[5]->id,
            'total' => 1000.00,
            'available' => 801.87,
            'limit_min' => 500.00,
            'limit_max' => 10680.90
        ];
        // SHIP
        $order_list[] = [
            'price' => 0.000430,
            'cryptocurrency_id' => $cryptocurrency_list[6]->id,
            'total' => 30000000.00,
            'available' => 24334994.28,
            'limit_min' => 600.00,
            'limit_max' => 5000.00
        ];
        $order_list[] = [
            'price' => 0.000437,
            'cryptocurrency_id' => $cryptocurrency_list[6]->id,
            'total' => 6000000.00,
            'available' => 5661604.21,
            'limit_min' => 1000.00,
            'limit_max' => 2474.12
        ];
        $order_list[] = [
            'price' => 0.000477,
            'cryptocurrency_id' => $cryptocurrency_list[6]->id,
            'total' => 20000000.00,
            'available' => 19039069.52,
            'limit_min' => 50.00,
            'limit_max' => 9018.63
        ];
        // DOGE
        $order_list[] = [
            'price' => 3.78,
            'cryptocurrency_id' => $cryptocurrency_list[7]->id,
            'total' => 200.00000000,
            'available' => 190.73247002,
            'limit_min' => 100.00,
            'limit_max' => 720.96
        ];
        $order_list[] = [
            'price' => 4.16,
            'cryptocurrency_id' => $cryptocurrency_list[7]->id,
            'total' => 135.00,
            'available' => 106.84076019,
            'limit_min' => 50.00,
            'limit_max' => 444.45
        ];
        $order_list[] = [
            'price' => 3.46,
            'cryptocurrency_id' => $cryptocurrency_list[7]->id,
            'total' => 1000.00,
            'available' => 998.82100726,
            'limit_min' => 500.00,
            'limit_max' => 3455.92
        ];

        foreach ($order_list as $order) {
            $order = new Order([
                'type' => Order::TYPE_BUY,
                'user_id' => $user_id,
                'price' => $order['price'],
                'price_currency_id' => $currency_id,
                'cryptocurrency_id' => $order['cryptocurrency_id'],
                'total' => $order['total'],
                'available' => $order['available'],
                'limit_min' => $order['limit_min'],
                'limit_max' => $order['limit_max']
            ]);
            $order->save();

            DB::table('order_payment')->insert([
                'order_id' => $order->id,
                'payment_type_id' => $payment_type->id
            ]);
        }
    }

    private function createSellOrder($user_id, $currency_id)
    {
        $cryptocurrency_list = Cryptocurrency::all();
        $payment_type = PaymentType::all()->first();
        $order_list = [];

        // USDT
        $order_list[] = [
            'price' => 36.15,
            'cryptocurrency_id' => $cryptocurrency_list[0]->id,
            'total' => 5.00,
            'available' => 3.26,
            'limit_min' => 50.00,
            'limit_max' => 117.84
        ];
        $order_list[] = [
            'price' => 36.09,
            'cryptocurrency_id' => $cryptocurrency_list[0]->id,
            'total' => 50000.00,
            'available' => 50000.00,
            'limit_min' => 10000.00,
            'limit_max' => 50000.00
        ];
        $order_list[] = [
            'price' => 36.10,
            'cryptocurrency_id' => $cryptocurrency_list[0]->id,
            'total' => 50000.00,
            'available' => 13988.94,
            'limit_min' => 10000.00,
            'limit_max' => 50000.00
        ];

        // BTC
        $order_list[] = [
            'price' => 626135.27,
            'cryptocurrency_id' => $cryptocurrency_list[1]->id,
            'total' => 0.900000000,
            'available' => 0.76165606,
            'limit_min' => 5000.00,
            'limit_max' => 250000.00
        ];
        $order_list[] = [
            'price' => 626135.26,
            'cryptocurrency_id' => $cryptocurrency_list[1]->id,
            'total' => 0.18000000,
            'available' => 0.13734747,
            'limit_min' => 5000.00,
            'limit_max' => 85998.09
        ];
        $order_list[] = [
            'price' => 626135.25,
            'cryptocurrency_id' => $cryptocurrency_list[1]->id,
            'total' => 1.20000000,
            'available' => 0.63729641,
            'limit_min' => 20000.00,
            'limit_max' => 210000.00
        ];
        // BUSD
        $order_list[] = [
            'price' => 36.15,
            'cryptocurrency_id' => $cryptocurrency_list[2]->id,
            'total' => 1200.00000000,
            'available' => 1200.00000000,
            'limit_min' => 5000.00,
            'limit_max' => 43380.00
        ];
        $order_list[] = [
            'price' => 36.14,
            'cryptocurrency_id' => $cryptocurrency_list[2]->id,
            'total' => 2700.00000000,
            'available' => 1747.72431680,
            'limit_min' => 3000.00,
            'limit_max' => 953.92
        ];
        $order_list[] = [
            'price' => 36.11,
            'cryptocurrency_id' => $cryptocurrency_list[2]->id,
            'total' => 7600.00000000,
            'available' => 7600.00000000,
            'limit_min' => 30000.00,
            'limit_max' => 274436.00
        ];
        // BNB
        $order_list[] = [
            'price' => 10732.21,
            'cryptocurrency_id' => $cryptocurrency_list[3]->id,
            'total' => 55000.00000000,
            'available' => 45.92278754,
            'limit_min' => 5000.00,
            'limit_max' => 250000.00
        ];
        $order_list[] = [
            'price' => 10732.21,
            'cryptocurrency_id' => $cryptocurrency_list[3]->id,
            'total' => 50000.00000000,
            'available' => 23.61518577,
            'limit_min' => 5000.00,
            'limit_max' => 200000.40
        ];
        $order_list[] = [
            'price' => 10732.22,
            'cryptocurrency_id' => $cryptocurrency_list[3]->id,
            'total' => 50000.00000000,
            'available' => 49865.51070090,
            'limit_min' => 4999.00,
            'limit_max' => 210000.00
        ];
        // ETH
        $order_list[] = [
            'price' => 45968.98,
            'cryptocurrency_id' => $cryptocurrency_list[4]->id,
            'total' => 7.00000000,
            'available' => 6.55253231,
            'limit_min' => 4999.00,
            'limit_max' => 210000.00
        ];
        $order_list[] = [
            'price' => 45981.48,
            'cryptocurrency_id' => $cryptocurrency_list[4]->id,
            'total' => 100.00000000,
            'available' => 99.65096325,
            'limit_min' => 50.00,
            'limit_max' => 1000000.00
        ];
        $order_list[] = [
            'price' => 45981.53,
            'cryptocurrency_id' => $cryptocurrency_list[4]->id,
            'total' => 7.00000000,
            'available' => 6.55253231,
            'limit_min' => 5000.00,
            'limit_max' => 200000.00
        ];
        // ADA
        $order_list[] = [
            'price' => 13.02,
            'cryptocurrency_id' => $cryptocurrency_list[5]->id,
            'total' => 200000.00,
            'available' => 494449.08,
            'limit_min' => 500.00,
            'limit_max' => 2000000.00
        ];
        $order_list[] = [
            'price' => 12.85,
            'cryptocurrency_id' => $cryptocurrency_list[5]->id,
            'total' => 900000.00,
            'available' => 391450.97,
            'limit_min' => 1000.00,
            'limit_max' => 1000000.00
        ];
        $order_list[] = [
            'price' => 12.81,
            'cryptocurrency_id' => $cryptocurrency_list[5]->id,
            'total' => 900000.00,
            'available' => 196419.52,
            'limit_min' => 50.00,
            'limit_max' => 1000000.00
        ];
        // SHIP
        $order_list[] = [
            'price' => 0.000363,
            'cryptocurrency_id' => $cryptocurrency_list[6]->id,
            'total' => 30000000.00,
            'available' => 28307440.09,
            'limit_min' => 600.00,
            'limit_max' => 5000.00
        ];
        $order_list[] = [
            'price' => 0.000362,
            'cryptocurrency_id' => $cryptocurrency_list[6]->id,
            'total' => 30000000.00,
            'available' => 29410993.32,
            'limit_min' => 50.00,
            'limit_max' => 108386.77
        ];
        $order_list[] = [
            'price' => 0.000362,
            'cryptocurrency_id' => $cryptocurrency_list[6]->id,
            'total' => 30000000.00,
            'available' => 30000000.00,
            'limit_min' => 4999.00,
            'limit_max' => 108600.00
        ];
        // DOGE
        $order_list[] = [
            'price' => 3.13,
            'cryptocurrency_id' => $cryptocurrency_list[7]->id,
            'total' => 1000000.00000000,
            'available' => 9993462.07853296,
            'limit_min' => 4999.00,
            'limit_max' => 210000.00
        ];
        $order_list[] = [
            'price' => 3.11,
            'cryptocurrency_id' => $cryptocurrency_list[7]->id,
            'total' => 200000.00000000,
            'available' => 95708.49626763,
            'limit_min' => 3000.00,
            'limit_max' => 297653.42
        ];
        $order_list[] = [
            'price' => 3.09,
            'cryptocurrency_id' => $cryptocurrency_list[7]->id,
            'total' => 1000000.00000000,
            'available' => 9997139.86018514,
            'limit_min' => 500.00,
            'limit_max' => 2000000.00
        ];

        foreach ($order_list as $order) {
            $order = new Order([
                'type' => Order::TYPE_SELL,
                'user_id' => $user_id,
                'price' => $order['price'],
                'price_currency_id' => $currency_id,
                'cryptocurrency_id' => $order['cryptocurrency_id'],
                'total' => $order['total'],
                'available' => $order['available'],
                'limit_min' => $order['limit_min'],
                'limit_max' => $order['limit_max']
            ]);
            $order->save();

            DB::table('order_payment')->insert([
                'order_id' => $order->id,
                'payment_type_id' => $payment_type->id
            ]);
        }
    }
}
