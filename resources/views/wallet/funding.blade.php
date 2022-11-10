@include('head')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h1>Funding</h1>
        </div>
    </div>
    <div class="row wallet-balance">
        <div class="col-12">
            <div class="row">
                <div class="col-12">Estimated Balance</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>{{ print_balance($user->fundingWallet->estimated_balance) }} {{ \App\Models\Cryptocurrency::DEFAULT_CURRENCY }}</h4>
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
                $fundingWalletCryptocurrency = $user->getFundingWalletCryptocurrencyByCryptoId($crypto->id);
                ?>
                    <tr>
                        <th scope="row">{{$crypto->name}}</th>
                        <td>@if(empty($fundingWalletCryptocurrency)) 0.00000000 @else {{ print_balance($fundingWalletCryptocurrency->total) }} @endif</td>
                        <td>@if(empty($fundingWalletCryptocurrency)) 0.00000000 @else {{ print_balance($fundingWalletCryptocurrency->available) }} @endif</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('footer')
