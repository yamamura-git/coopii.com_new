<?php
require_once("./control/news_control.php");
require_once("./control/settings_control.php");
require_once("./views/common/include.php");

session_start();
session_regenerate_id(true);
if (!(isset($_SESSION['user']))) {
	header('Location: ' . $admin_url . '/login');
	return;
}

$pdo = db_connect();
$count = countNum($pdo);
if (isset($_POST['change'])) { // 新着情報表示数変更
	countChange($pdo);
	header('Location: ' . $admin_url);
}
if (isset($_GET['logout'])) { // ログアウト処理
	session_destroy();
	header('Location: ' . $admin_url . '/login');
	return;
}
$stmh = index($pdo);

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
<!-- Breadcrumb-->
<html lang="ja">
<?php include './views/common/head.php' ?>

<body>
	<?php include './views/common/sidebar.php' ?>

	<div class="wrapper d-flex flex-column min-vh-100 bg-light">
		<?php include './views/common/header.php' ?>
		<div class="header-divider"></div>
		<div class="container-fluid">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb my-0 ms-2">
					<li class="breadcrumb-item">
						<!-- if breadcrumb is single--><span>Home</span>
					</li>
				</ol>
			</nav>
		</div>
		</header>

		<div class="body flex-grow-1 px-3">
			<div class="container-lg">
				<!-- 共通 -->

				<div class="card mb-4">
					<div class="card-header"><strong>新着情報</strong><span class="small ms-1">一覧</span></div>
					<div class="card-body">
						<div class="tab-content rounded-bottom">
							<div class="tab-pane p-3 active preview" role="tabpanel" id="preview-387">
								<form action="<?php echo $admin_url ?>/" method="post">
									<div class="row align-items-center mb-5">
										<div class="col-auto">
											<label for="count" class="col-form-label">表示数</label>
										</div>
										<div class="col-2">
											<input type="number" id="count" name="count" class="form-control text-end" value="<?= $count['news_count'] ?>">
										</div>
										<div class="col-auto">
											<button type="submit" name="change" class="btn btn-info link-light">変更</button>
										</div>
									</div>
								</form>
								<table class="table">
									<thead>
										<tr>
											<th class="col-3">日付</th>
											<th class="col-6">タイトル</th>
											<th class="col-2 text-center">編集</th>
										</tr>
									</thead>
									<tbody>
										<?php while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
											$rdate = date('Y年m月d日 H:d', strtotime($row['update_at'])) ?>
											<tr>
												<td class="align-middle"><?= $rdate ?></td>
												<td class="align-middle"><?= htmlspecialchars($row['title'], ENT_QUOTES) ?></td>
												<td class="text-center"><a class="btn btn-warning link-light fw-bold" href="<?php echo $admin_url; ?>/news/?id=<?= $row['id'] ?>">編集</a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div><!-- end 共通 -->
		</div>

		<?php include './views/common/footer.php' ?>

</body>

</html>