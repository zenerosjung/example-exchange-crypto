<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $crypto_list = Cryptocurrency::all();
        $order_list = [];
        $action = $request->get('action', 'buy');
        $crypto_id = $request->get('crypto', $crypto_list[0]->id);
        $crypto_name = null;

        switch ($action) {
            case 'buy':
                $order_list = Order::where('type', Order::TYPE_BUY)
                    ->where('cryptocurrency_id', $crypto_id)
                    ->where('available', '>', 0)
                    ->orderBy('price')
                    ->get();
                break;
            case 'sell':
                $order_list = Order::where('type', Order::TYPE_SELL)
                    ->where('cryptocurrency_id', $crypto_id)
                    ->where('available', '>', 0)
                    ->orderByDesc('price')
                    ->get();
                break;
        }

        foreach ($crypto_list as $crypto) {
            if ($crypto->id == $crypto_id) {
                $crypto_name = $crypto->name;
            }
        }

        return $this->view('index', [
            'crypto_list' => $crypto_list,
            'action' => $action,
            'crypto_id' => $crypto_id,
            'crypto_name' => $crypto_name,
            'order_list' => $order_list
        ]);
    }
}
