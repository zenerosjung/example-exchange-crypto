<?php

namespace App\Http\Controllers;

use App\Models\FundingWalletCryptocurrency;
use App\Models\FiatWalletCryptocurrency;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function index(Request $request, $action, $id)
    {
        $order = Order::find($id);

        return $this->view('order.index', ['action' => $action, 'order' => $order]);
    }

    /**
     * @param Request $request
     * @param $action
     * @param $id
     * @return RedirectResponse
     */
    public function transaction(Request $request, $action, $id): RedirectResponse
    {
        $rule = [
            'total' => 'required',
            'receive' => 'required'
        ];

        if ($action == 'sell') {
            $rule['payment_method'] = 'required';
        }

        $request->validate($rule);

        $user = Auth::user();
        $success = false;

        try {
            $order = Order::where('id', $id)->where('available', '>', 0)->first();
            if (empty($order)) {
                return redirect()->back()->with('error', 'Order not found.');
            }

            switch ($action) {
                case 'buy': // 1
                    // Validate
                    if ($request->get('total') < $order->limit_min) {
                        return redirect()->back()->with('error', 'The minimum order amount is '.number_format($order->limit_min, 2).' '.strtoupper($order->currency->name).'.');
                    }
                    if ($request->get('total') > $order->limit_max) {
                        return redirect()->back()->with('error', 'The maximum order amount is '.number_format($order->limit_max, 2).' '.strtoupper($order->currency->name).'.');
                    }
                    if ($request->get('receive') < 0 || $request->get('receive') > $order->available) {
                        return redirect()->back()->with('error', 'Available order amount is not match.');
                    }

                    $order->available -= $request->get('total');

                    // Prepare Model Data
                    $buyerFundingCryptocurrency = FundingWalletCryptocurrency::where('funding_wallet_id', $user->fundingWallet->id)
                        ->where('cryptocurrency_id', $order->cryptocurrency_id)
                        ->first();
                    if (empty($buyerFundingCryptocurrency)) {
                        $buyerFundingCryptocurrency = new FiatWalletCryptocurrency();
                        $buyerFundingCryptocurrency->fiat_wallet_id = $user->fundingWallet->id;
                        $buyerFundingCryptocurrency->cryptocurrency_id = $order->cryptocurrency_id;
                        $buyerFundingCryptocurrency->available = 0;
                    }

                    $buyerFundingCryptocurrency->available += $request->get('total');
                    $buyerFundingCryptocurrency->total = $buyerFundingCryptocurrency->available;

                    // Save Transaction
                    $transaction_data = [
                        'user_id' => $user->id,
                        'order_id' => $order->id,
                        'total' => $request->get('total'),
                        'receive' => $request->get('receive')
                    ];

                    $transaction = new Transaction($transaction_data);

                    DB::transaction(function () use ($transaction, $buyerFundingCryptocurrency, $order) {
                        $transaction->save();
                        $buyerFundingCryptocurrency->save();
                        $order->save();
                    });

                    DB::commit();
                    $success = true;

                    break;
                case 'sell': // 2
                    // Validate
                    if ($request->get('total') < 0 || $request->get('total') > $order->available) {
                        return redirect()->back()->with('error', 'Available order amount is not match.');
                    }
                    if ($request->get('receive') < $order->limit_min) {
                        return redirect()->back()->with('error', 'The minimum order amount is '.number_format($order->limit_min, 2).' '.strtoupper($order->currency->name).'.');
                    }
                    if ($request->get('receive') > $order->limit_max) {
                        return redirect()->back()->with('error', 'The maximum order amount is '.number_format($order->limit_max, 2).' '.strtoupper($order->currency->name).'.');
                    }

                    $payment_method = PaymentType::find($request->get('payment_method'));
                    if (empty($payment_method)) {
                        return redirect()->back()->with('error', 'Payment Method not found.');
                    }

//                    $sellerFundingCryptocurrency = FundingWalletCryptocurrency::where('funding_wallet_id', $order->user->fundingWallet->id)
//                        ->where('cryptocurrency_id', $order->cryptocurrency_id)
//                        ->first();
//                    if (!empty($sellerFundingCryptocurrency) &&
//                        ($sellerFundingCryptocurrency->available - $request->get('total')) < 0
//                    ) {
//                        return redirect()->back()->with('error', 'Available Cryptocurrency amount is not enough.');
//                    }

                    // Prepare Model Data
                    $buyerFiatCryptocurrency = FiatWalletCryptocurrency::where('fiat_wallet_id', $user->fiatWallet->id)
                        ->where('cryptocurrency_id', $order->cryptocurrency_id)
                        ->first();
                    if (empty($buyerFiatCryptocurrency)) {
                        $buyerFiatCryptocurrency = new FiatWalletCryptocurrency();
                        $buyerFiatCryptocurrency->fiat_wallet_id = $user->fiatWallet->id;
                        $buyerFiatCryptocurrency->cryptocurrency_id = $order->cryptocurrency_id;
                        $buyerFiatCryptocurrency->available = 0;
                    }

                    $buyerFiatCryptocurrency->available += $request->get('total');
                    $buyerFiatCryptocurrency->total = $buyerFiatCryptocurrency->available;

//                    $sellerFundingCryptocurrency->available -= $request->get('total');
//                    $sellerFundingCryptocurrency->total = $sellerFundingCryptocurrency->available;

                    $order->available -= $request->get('total');

                    // Save Transaction
                    $transaction_data = [
                        'user_id' => $user->id,
                        'order_id' => $order->id,
                        'total' => $request->get('total'),
                        'receive' => $request->get('receive'),
                        'payment_type_id' => $payment_method->id
                    ];

                    $transaction = new Transaction($transaction_data);

                    DB::transaction(function () use ($transaction, $buyerFiatCryptocurrency, $order) {
                        $transaction->save();
                        $buyerFiatCryptocurrency->save();
                        $order->save();
                    });

                    DB::commit();
                    $success = true;

                    break;
            }

            if ($success) {
                return redirect()->back()->with('success', 'Transaction successfully.');
            }
            return redirect()->back()->with('error', 'Error create Transaction.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error.');
        }
    }
}
