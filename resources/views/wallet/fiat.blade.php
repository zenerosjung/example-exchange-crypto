@include('head')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Fiat and Spot</h1>
        </div>
    </div>
    <div class="row wallet-balance">
        <div class="col-12">
            <div class="row">
                <div class="col-12">Estimated Balance</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>{{ print_balance($user->fiatWallet->estimated_balance) }} {{ \App\Models\Cryptocurrency::DEFAULT_CURRENCY }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row wallet-balance">
        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    Spot balance
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>{{ print_balance($user->fiatWallet->spot_balance) }} {{ \App\Models\Cryptocurrency::DEFAULT_CURRENCY }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    Fiat balance
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>{{ print_balance($user->fiatWallet->fait_balance) }} {{ \App\Models\Cryptocurrency::DEFAULT_CURRENCY }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Coin</th>
                    <th scope="col">Total</th>
                    <th scope="col">Available</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($crypto_list as $crypto)
                <?php
                    $fiatWalletCryptocurrency = $user->getFiatWalletCryptocurrencyByCryptoId($crypto->id);
                ?>
                <tr>
                    <th scope="row">{{$crypto->name}}</th>
                    <td>@if(empty($fiatWalletCryptocurrency)) 0.00000000 @else {{ print_balance($fiatWalletCryptocurrency->total) }} @endif</td>
                    <td>@if(empty($fiatWalletCryptocurrency)) 0.00000000 @else {{ print_balance($fiatWalletCryptocurrency->available) }} @endif</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('footer')
