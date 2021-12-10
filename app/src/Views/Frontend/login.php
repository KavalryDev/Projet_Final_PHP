
<div class="header">
    <h2>Login</h2>
</div>

<form method="POST" action="/loginAction/">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="Email" placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="Password" placeholder="Password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <input type="submit" class="btn btn-primary" value="Login" name="Login">
        </div>
    </div>
</form>
<br>
<p>
    Already a member? <a href="/signup/">Sign up</a>
</p>