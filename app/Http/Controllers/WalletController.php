<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;

class WalletController extends BaseController
{
    public function fiat()
    {
        $crypto_list = Cryptocurrency::all();
        return $this->view('wallet.fiat', ['crypto_list' => $crypto_list]);
    }

    public function funding()
    {
        $crypto_list = Cryptocurrency::all();
        return $this->view('wallet.funding', ['crypto_list' => $crypto_list]);
    }

    public function history()
    {
        return $this->view('wallet.history');
    }
}
