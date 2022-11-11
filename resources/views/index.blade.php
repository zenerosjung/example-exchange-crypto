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
                    <th scope="col">Limit</th>
                    <th scope="col">Available</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Trade</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order_list as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td><strong>{{ number_format($order->price, 2) }}</strong> {{ $order->currency->name }}</td>
                    <td>{{ $order->available }}</td>
                    <td>{{ number_format($order->limit_min, 2) }} - {{ number_format($order->limit_max, 2) }}</td>
                    <td>
                        @foreach($order->orderPayment as $a => $orderPayment)
                            <span class="badge badge-pill badge-warning">{{ $orderPayment->paymentType->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if(!empty($user) && $user->id == $order->user_id)
                            <a href="#" class="btn btn-danger">Cancel {{ ucwords($action) }}</a>
                        @else
                            <a href="@if(empty($user)){{ route('login.view') }}@else{{ route('order.view', ['id' => $order->id, 'action' => $action]) }}@endif"
                               class="btn btn-info">{{ ucwords($action) }} {{ $crypto_name }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('footer')
