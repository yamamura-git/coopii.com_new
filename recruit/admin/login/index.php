<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();
require_once('../views/common/include.php');
require_once('../control/account_control.php');

$err = [];

// login[POST]
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = filter_input(INPUT_POST, 'email');
	$password = filter_input(INPUT_POST, 'password');

	if ($email === '') {
		$err['email'] = 'メールアドレスは入力必須です。';
	}
	if ($password === '') {
		$err['password'] = 'パスワードは入力必須です。';
	}

	if (count($err) === 0) {
		$pdo = db_connect();
		$stmh = findByEmail($pdo, $email);

		$rows = $stmh->fetchAll();

		foreach ($rows as $row) {
			$password_hash = $row['password'];

			if (password_verify($password, $password_hash)) {
				session_regenerate_id(true);
				$_SESSION['user'] = $row;
				header('Location: ' . $admin_url);
				return;
			}
		}
		$err['login'] = 'ログインに失敗しました。';
	}
}

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
							<div class="card-body">
								<form action="<?= $admin_url ?>/login/" method="post">
									<h1>Login</h1>
									<p class="text-medium-emphasis">Sign In to your account</p>
									<?php if (isset($err['email'])) : ?><p class="text-danger mb-0"><small><?= h($err['email']); ?></small></p><?php endif; ?>
									<div class="input-group mb-3"><span class="input-group-text">
											<svg class="icon">
												<use xlink:href="../views/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
											</svg></span>
										<input class="form-control" name="email" type="text" placeholder="email">
									</div>
									<?php if (isset($err['password'])) : ?><p class="text-danger mb-0"><small><?= h($err['password']); ?></small></p><?php endif; ?>
									<div class="input-group mb-4"><span class="input-group-text">
											<svg class="icon">
												<use xlink:href="../views/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
											</svg></span>
										<input class="form-control" name="password" type="password" placeholder="Password">
									</div>
									<?php if (isset($err['login'])) : ?><p class="text-danger"><small><?= h($err['login']); ?></small></p><?php endif; ?>
									<div class="row">
										<div class="col-6">
											<button class="btn btn-primary px-4" type="submit">Login</button>
										</div>
										<div class="col-6 text-end">
											<a class="btn btn-link px-0" href="<?= $admin_url ?>/register/"><small>パスワードを忘れた</small></a>
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
	<!-- CoreUI and necessary plugins-->
	<script src="../views/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
	<script src="../views/vendors/simplebar/js/simplebar.min.js"></script>
	<script>
	</script>

</body>

</html>