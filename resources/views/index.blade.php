@include('head')

<div class="container">
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link @if($action == 'buy') active @endif"
                   href="{{ route('index', ['action' => 'buy', 'crypto' => $crypto_id]) }}">Buy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($action == 'sell') active @endif"
                   href="{{ route('index', ['action' => 'sell', 'crypto' => $crypto_id]) }}">Sell</a>
            </li>
        </ul>
        <nav class="nav navbar-crypto-list">
            @foreach($crypto_list as $crypto)
            <a class="nav-link @if($crypto->id == $crypto_id) active @endif"
               href="{{ route('index', ['action' => $action, 'crypto' => $crypto->id]) }}">{{ $crypto->name }}</a>
            @endforeach
        </nav>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Advertisers</th>
                    <th scope="col">Price</th>
                    <th scope="col">Limit/Available</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Trade</th>
                </tr>
            </thead>
            <tbody>
            @foreach($table_list as $row)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button type="button" class="btn btn-info">{{ ucwords($action) }} {{ $crypto_name }}</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('footer')
