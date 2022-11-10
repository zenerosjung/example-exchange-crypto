<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiatWallet extends Model
{
    protected $table = 'fiat_wallet';

    protected $fillable = [
        'user_id',
        'estimated_balance',
        'fait_balance',
        'spot_balance'
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
    public function fiatWalletCryptocurrency(): HasMany
    {
        return $this->hasMany(FiatWalletCryptocurrency::class);
    }
}
