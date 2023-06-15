<?php
if (isset($_POST['sbm'])) {
	$mail = $_POST['mail'];
	$pass = $_POST['pass'];
	// user_level=2=thành viên.
	$sql = "SELECT * FROM user WHERE user_mail = '$mail' AND user_pass = '$pass' AND user_level = 2";
	$query = mysqli_query($conn, $sql);
	$data = mysqli_fetch_row($query);
	$num_row = mysqli_num_rows($query);

	if ($num_row > 0) {
		$_SESSION['mail'] = $mail;
		$_SESSION['pass'] = $pass;
		$_SESSION['client_logged_in'] = $data;
		header("location: index.php");
	} else {
		$err = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
	}
} ?>

<div class="row">
	<div class="col-6">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">Đăng nhập</div>
			<div class="panel-body">
				<!-- errorr -->
				<?php if (isset($err)) {
					echo $err;
				} ?>
				<form role="form" method="post">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
						</div>
						<div class="checkbox">
							<label>
								<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
							</label>
						</div>
						<button name="sbm" type="submit" class="btn btn-primary">Đăng nhập</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div><!-- /.col-->
</div><!-- /.row -->