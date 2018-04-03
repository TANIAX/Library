<?php ob_start(); ?>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" method="post" role="form" style="display: block;">
									<div class="form-group">
                    <!-- TEST -->
                    <div class="alert alert-error">
                      <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Login or Password!
                    </div>
                    <!-- TEST -->
										<input type="text" name="login" id="login" tabindex="1" class="form-control" placeholder="Login" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" method="post" role="form" style="display: none;">
									<div class="form-group">
                     <!-- TEST-->
                    <div class="alert alert-error">
                      <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Login or Password!
                    </div>
                     <!-- TEST-->
										<input type="text" name="login_register" id="login_register" tabindex="1" class="form-control" placeholder="Login" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email_register" id="email_register" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password_register" id="password_register" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password_register" id="confirm-password_register" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
  $title = "Login";
  $content = ob_get_clean();
  include 'includes/layout.php';?>
