<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $crypto_list = Cryptocurrency::all();

        return $this->view('index', ['crypto_list' => $crypto_list]);
    }
}
