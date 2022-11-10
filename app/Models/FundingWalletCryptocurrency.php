<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FundingWalletCryptocurrency extends Model
{
    protected $table = 'funding_wallet_cryptocurrency';

    protected $fillable = [
        'funding_wallet_id',
        'cryptocurrency_id',
        'total',
        'available',
    ];

    /**
     * @return BelongsTo
     */
    public function fundingWallet(): BelongsTo
    {
        return $this->belongsTo(FundingWallet::class);
    }
}
