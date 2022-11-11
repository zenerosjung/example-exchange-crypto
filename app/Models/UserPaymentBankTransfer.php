<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPaymentBankTransfer extends Model
{
    protected $table = 'user_payment_bank_transfer';

    protected $fillable = [
        'user_id',
        'payment_type_id',
        'bank_account',
        'bank_name',
        'bank_branch',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }
}
