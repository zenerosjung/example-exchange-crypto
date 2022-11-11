@include('head')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 align-self-center">
            <div class="row">
                <div class="col-12">
                    <h1>{{ ucwords($action) }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row order-form">
        <div class="col-sm-12 col-md-7 col-lg-7">
            <div class="row">
                <div class="col-12">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p>Price <strong style="color: rgb(3, 166, 109);">{{ number_format($order->price, 2) }} {{ $order->currency->name }}</strong></p>
                </div>
                <div class="col-6">
                    <p>Available <strong>{{ $order->available }} {{ strtoupper($order->cryptocurrency->name) }}</strong></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6"><p>Payment Time Limit <strong>30 Minutes</strong></p></div>
                <div class="col-6">
                    <p>
                    @if($action == 'buy') Buyer’s payment method @elseif($action == 'sell') Seller’s payment method @endif
                    <br>
                    @foreach($order->orderPayment as $a => $orderPayment)
                        <span class="badge badge-pill badge-warning">{{ $orderPayment->paymentType->name }}</span>
                    @endforeach
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12"><p>Terms and conditions</p></div>
                <div class="col-12"><p>...</p></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-5">
            <form method="post" action="{{ route('order.transaction', ['action' => $action, 'id' => $order->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="inputTotal">
                        @if($action == 'buy') I want to pay @elseif($action == 'sell') I want to sell @endif
                    </label>
                    <input type="text" class="form-control" id="inputTotal" name="total">
                </div>
                <div class="form-group">
                    <label for="inputReceive">I will receive</label>
                    <input type="text" class="form-control" id="inputReceive" name="receive">
                </div>
                @if($action == 'sell')
                <div class="form-group">
                    <label for="inputPayment">Payment Method</label>
                    <select class="form-control" name="payment_method">
                        @foreach($order->orderPayment as $orderPayment)
                        <option value="{{ $orderPayment->paymentType->id }}">{{ $orderPayment->paymentType->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <button type="submit" class="btn btn-primary">{{ ucwords($action) }}</button>
                <a href="{{ route('index', ['action' => $action, 'crypto' => $order->cryptocurrency->id]) }}"
                   class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@include('footer')
