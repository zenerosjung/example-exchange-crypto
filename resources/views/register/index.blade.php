@include('head')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-12 align-self-center">
            <div class="row">
                <div class="col-12">
                    <h1>Register</h1>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <form method="post" action="{{ route('register.register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="inputName">Name *</label>
                            <input type="text" class="form-control" id="inputName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email address *</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password *</label>
                            <input type="password" class="form-control" id="inputPassword" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordVerify">Password Confirmation *</label>
                            <input type="password" class="form-control" id="inputPasswordVerify" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')
