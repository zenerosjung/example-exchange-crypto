<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Models\User;
use App\Models\FiatWallet;
use App\Models\FundingWallet;
use App\Models\UserPaymentBankTransfer;
use App\Models\UserPaymentTrueMoney;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{
    public function index()
    {
        return $this->view('register.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:user,email',
            'password' => 'required|confirmed'
        ]);

        try {
            $payment_types = PaymentType::all();
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);

            $user = new User($data);
            $user->save();

            $fiatWallet = new FiatWallet([
                'user_id' => $user->id
            ]);
            $fiatWallet->save();

            $fundingWallet = new FundingWallet([
                'user_id' => $user->id
            ]);
            $fundingWallet->save();

            $payment_bank = new UserPaymentBankTransfer([
                'user_id' => $user->id,
                'payment_type_id' => $payment_types[0]->id,
                'bank_account' => '1111 2222 3333 4444',
                'bank_name' => 'SCB',
                'bank_branch' => ''
            ]);
            $payment_bank->save();

            $payment_true = new UserPaymentTrueMoney([
                'user_id' => $user->id,
                'payment_type_id' => $payment_types[1]->id,
                'phone' => '0888888888',
                'username' => $data['name'],
                'qr_code' => ''
            ]);
            $payment_true->save();

            return redirect()->back()
                ->with('success', 'User register successfully.');
        } catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Error.');
        }
    }
}
