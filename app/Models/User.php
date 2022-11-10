<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function fiatWallet(): HasOne
    {
        return $this->hasOne(FiatWallet::class);
    }

    /**
     * @return HasOne
     */
    public function fundingWallet(): HasOne
    {
        return $this->hasOne(FundingWallet::class);
    }

    /**
     * @param int $crypto_id
     * @return mixed|null
     */
    public function getFiatWalletCryptocurrencyByCryptoId(int $crypto_id)
    {
        $return = null;
        foreach ($this->fiatWallet->fiatWalletCryptocurrency as $fiatWalletCryptocurrency) {
            if ($fiatWalletCryptocurrency->cryptocurrency_id == $crypto_id) {
                $return = $fiatWalletCryptocurrency;
                break;
            }
        }

        return $return;
    }

    /**
     * @param int $crypto_id
     * @return mixed|null
     */
    public function getFundingWalletCryptocurrencyByCryptoId(int $crypto_id)
    {
        $return = null;
        foreach ($this->fundingWallet->fundingWalletCryptocurrency as $fundingWalletCryptocurrency) {
            if ($fundingWalletCryptocurrency->cryptocurrency_id == $crypto_id) {
                $return = $fundingWalletCryptocurrency;
                break;
            }
        }

        return $return;
    }
}
