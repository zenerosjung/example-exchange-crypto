<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentType extends Model
{
    protected $table = 'payment_type';

    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function userPaymentBankTransfer(): HasMany
    {
        return $this->hasMany(UserPaymentBankTransfer::class);
    }

    /**
     * @return HasMany
     */
    public function userPaymentTrueMoney(): HasMany
    {
        return $this->hasMany(UserPaymentTrueMoney::class);
    }

    /**
     * @return HasMany
     */
    public function orderPayment(): HasMany
    {
        return $this->hasMany(OrderPayment::class);
    }

    /**
     * @return HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
