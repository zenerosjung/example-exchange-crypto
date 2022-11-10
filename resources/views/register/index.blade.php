@include('head')
@include('nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-12 align-self-center">
            <div class="row">
                <div class="col-12">
                    <h1>Register</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password *</label>
                            <input type="password" class="form-control" id="inputPassword">
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordVerify">Password Verify *</label>
                            <input type="password" class="form-control" id="inputPasswordVerify">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')
