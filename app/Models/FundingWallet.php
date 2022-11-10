<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FundingWallet extends Model
{
    protected $table = 'funding_wallet';

    protected $fillable = [
        'user_id',
        'estimated_balance'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function fundingWalletCryptocurrency(): HasMany
    {
        return $this->hasMany(FundingWalletCryptocurrency::class);
    }
}
