<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'type',
        'user_id',
        'price',
        'price_currency_id',
        'cryptocurrency_id',
        'total',
        'available',
        'limit_min',
        'limit_max',
    ];

    const TYPE_BUY = 1;
    const TYPE_SELL = 2;

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
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return HasMany
     */
    public function orderPayment(): HasMany
    {
        return $this->hasMany(OrderPayment::class);
    }
}
