<div id="login">
    <h3 class="text-center text-info">Login form</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-6">
                    <form id="login-form" class="form" action="<?php echo base_url('/user/login_user'); ?>" method="post">
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="SUBMIT">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="<?php echo base_url('/user/register'); ?>" class="text-info">REGISTER NEW ACCOUNT</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>