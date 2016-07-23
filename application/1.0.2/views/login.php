	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b><i>E - </i></b>Payment</a>
			</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<?=notif()?>
			<form action="<?=current_url()?>" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="Username" name="user_name">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Password" name="user_pass">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox icheck">
							<label>
							<input type="checkbox" class="minimal"><?=APP_NAME?>
							</label>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>	

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->