<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();

require_once('../views/common/include.php');
require_once('../control/account_control.php');

$err = [];
$title = "パスワード再設定";
$view = "password.php";
$pdo = db_connect();
$name = "reset_password";

// アカウントの存在確認
$count = accCount($pdo);
if ($count === 0) {
	$title = "アカウント登録";
	$view = "create.php";
	$name = "create";
	// $_SESSION['_csrf_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDAM)); // php5
	// $_SESSION['_csrf_token'] = bin2hex(random_bytes(32)); // php7
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = filter_input(INPUT_POST, 'email');
	// $password = filter_input(INPUT_POST, 'password');
	$password = filter_input(INPUT_POST, 'password');
	$password_conf = filter_input(INPUT_POST, 'password_conf');

	if ($email === '') {
		$err['email'] = 'メールアドレスは入力必須です。';
	}
	if ($password === '') {
		$err['password'] = 'パスワードは入力必須です。';
	}
	if ($password != $password_conf) {
		$err['password_conf'] = 'パスワードが一致しません。';
	}

	if (count($err) === 0) {
		if (isset($_POST['password'])) { // パスワード登録時
			resetPass($pdo, $email, $password);
			header('Location: ' . $admin_url);
		}
		if (isset($_POST['create'])) { // アカウント作成時
			create($pdo, $email, $password);
			header('Location: ' . $admin_url);
		}
	}
}


$pdo = null;
?>

<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.1
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="ja">
<?php include '../views/common/head.php' ?>

<body>
	<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div class="card-group d-block d-md-flex row">
						<div class="card col-md-6 p-4 mb-0">
							<div class="card-body p-4">
								<h1>Register</h1>
								<p class="text-medium-emphasis"><?php echo $title ?></p>
								<form action="<?php echo $admin_url ?>/register/" method="post">
									<?php if (isset($err['email'])) : ?><p class="text-danger mb-0"><small><?php echo h($err['email']); ?></small></p><?php endif; ?>
									<div class="input-group mb-3"><span class="input-group-text">
											<svg class="icon">
												<use xlink:href="../views/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
											</svg></span>
										<input class="form-control" name="email" type="text" placeholder="Email">
									</div>
									<?php if (isset($err['password'])) : ?><p class="text-danger mb-0"><small><?php echo h($err['password']); ?></small></p><?php endif; ?>
									<div class="input-group mb-3"><span class="input-group-text">
											<svg class="icon">
												<use xlink:href="../views/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
											</svg></span>
										<input class="form-control" name="password" type="password" placeholder="Password">
									</div>
									<?php if (isset($err['password_conf'])) : ?><p class="text-danger mb-0"><small><?php echo h($err['password_conf']); ?></small></p><?php endif; ?>
									<div class="input-group mb-4"><span class="input-group-text">
											<svg class="icon">
												<use xlink:href="../views/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
											</svg></span>
										<input class="form-control" name="password_conf" type="password" placeholder="Repeat password">
									</div>
									<button class="btn btn-block btn-success text-white" type="submit" name="<?php echo $name ?>">更新</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- CoreUI and necessary plugins-->
	<script src="../views/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
	<script src="../views/vendors/simplebar/js/simplebar.min.js"></script>
	<script>
	</script>

</body>

</html>