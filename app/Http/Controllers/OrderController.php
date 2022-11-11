<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function index(Request $request, $action, $id)
    {
        $order = Order::find($id);

        return $this->view('order.index', ['action' => $action, 'order' => $order]);
    }

    public function transaction(Request $request, $action, $id)
    {

    }

    private function buy($order_id)
    {

    }

    private function sell($order_id)
    {

    }
}
