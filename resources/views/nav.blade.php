<nav class="navbar navbar-dark bg-dark">
    <a class="nav-link" href="{{ route('index') }}"><span class="navbar-brand mb-0 h1">Exchange</span></a>
    <ul class="nav">
        @if(isset($user) && !empty($user))
            <li class="nav-item">
                <span class="navbar-brand mb-0 h1">{{ $user->name }}</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('wallet.fiat') }}">Fiat and Spot</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('wallet.funding') }}">Funding</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login.logout') }}">Logout</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login.view') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register.view') }}">Register</a>
            </li>
        @endif
    </ul>
</nav>
