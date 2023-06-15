<?php
if (isset($_POST['sbm'])) {
	$fullname = $_POST['fullname'];
	$mail = $_POST['mail'];
	$pass = $_POST['pass'];

	// user_level=2=thành viên.
	$sql = "INSERT INTO  user(user_full,user_mail,user_pass,user_level) VALUES ('$fullname','$mail','$pass',2)";
	$query = mysqli_query($conn, $sql);

	// get use vua insert.
	$sql2 = "SELECT * FROM user WHERE user_mail = '$mail' AND user_pass = '$pass' AND user_level = 2";
	$query2 = mysqli_query($conn, $sql2);
	$data = mysqli_fetch_row($query2);
	$num_row = mysqli_num_rows($query2);

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
			<div class="panel-heading">Đăng ký</div>
			<div class="panel-body">
				<!-- errorr -->
				<?php if (isset($err)) {
					echo $err;
				} ?>
				<form role="form" method="post">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="Full Name" name="fullname" type="text" autofocus required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="E-mail" name="mail" type="email" required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" required>
						</div>
						<button name="sbm" type="submit" class="btn btn-primary">Đăng nhập</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div><!-- /.col-->
</div><!-- /.row -->