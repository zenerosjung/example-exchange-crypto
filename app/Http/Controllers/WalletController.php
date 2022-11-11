<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function history(Request $request)
    {
        $user = Auth::user();
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $offset = ($page - 1) * $limit;
        $total = count($user->transaction);

        $transaction_list = Transaction::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->offset($offset)
            ->take($limit)
            ->get();

        return $this->view('wallet.history', [
            'transaction_list' => $transaction_list,
            'page' => $page,
            'total' => $total,
            'limit' => $limit
        ]);
    }
}
