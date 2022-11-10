<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;

class HomeController extends BaseController
{
    public function index()
    {
        $crypto_list = Cryptocurrency::all();

        return $this->view('index', ['crypto_list' => $crypto_list]);
    }
}
