@include('head')
@include('nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-12 align-self-center">
            <div class="row">
                <div class="col-12">
                    <h1>Login</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="inputPassword">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')
