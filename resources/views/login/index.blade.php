@include('head')
@include('nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12 align-self-center">
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
@include('footer')
