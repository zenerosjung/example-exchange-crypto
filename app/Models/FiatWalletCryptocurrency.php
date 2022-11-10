<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FiatWalletCryptocurrency extends Model
{
    protected $table = 'fiat_wallet_cryptocurrency';

    protected $fillable = [
        'fiat_wallet_id',
        'cryptocurrency_id',
        'total',
        'available',
    ];

    /**
     * @return BelongsTo
     */
    public function fiatWallet(): BelongsTo
    {
        return $this->belongsTo(FiatWallet::class);
    }
}
