<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $crypto_list = Cryptocurrency::all();
        $table_list = [];
        $action = $request->get('action', 'buy');
        $crypto_id = $request->get('crypto', $crypto_list[0]->id);
        $crypto_name = null;

        switch ($action) {
            case 'buy':

                break;
            case 'sell':

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
            'table_list' => $table_list
        ]);
    }
}
