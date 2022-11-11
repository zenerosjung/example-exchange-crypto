@include('head')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Transaction History</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Time</th>
                        <th scope="col">Type</th>
                        <th scope="col">Asset</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($transaction_list as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ \App\Models\Order::TYPE_LIST[$transaction->order->type] }}</td>
                        <td>{{ $transaction->order->cryptocurrency->name }}</td>
                        <td>{{ $transaction->receive }}</td>
                        <td>{{ $transaction->order->user->name }}</td>
                        <td>Complete</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if(ceil($total / $limit) > 0)
    <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item @if($page <= 1) disabled @endif">
                        <a href="{{ route('wallet.history', ['limit' => $limit, 'page' => $page - 1]) }}"
                           class="page-link">Previous</a>
                    </li>
                    @for($i = 1; $i <= ceil($total / $limit); $i++)
                    <li class="page-item">
                        <a href="{{ route('wallet.history', ['limit' => $limit, 'page' => $i]) }}"
                           class="page-link">{{ $i }}</a>
                    </li>
                    @endfor
                    <li class="page-item @if($page >= ceil($total / $limit)) disabled @endif">
                        <a href="{{ route('wallet.history', ['limit' => $limit, 'page' => $page + 1]) }}"
                           class="page-link">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    @endif
</div>
@include('footer')
