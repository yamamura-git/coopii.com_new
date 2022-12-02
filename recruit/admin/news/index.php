<?php
require_once("../control/news_control.php");
require_once("../views/common/include.php");

session_start();
session_regenerate_id(true);
if(!(isset($_SESSION['user']))) {
	header('Location: '.$admin_url.'/login');
	return;
}

$pdo = db_connect();
$views = "list.php";
$title = "一覧確認";
$comment = null;
$page = 1;
// $test = 0;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if(isset($_GET['new'])) { // 新規作成ページ表示時
		$views = "create.php";
		$title = "新規作成";
		$stmh = newsList($pdo, $page);
	}
	if(isset($_GET['id'])) { // 編集画面表示時
		$stmh = detail($pdo);
		$row = $stmh->fetch(PDO::FETCH_ASSOC);
		$views = "edit.php";
		$title = "編集";
	}
	if(isset($_GET['page']) && is_numeric($_GET['page'])) { // 一覧画面表示時
		$page = $_GET['page'];
		$stmh = newsList($pdo, $page);
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(isset($_POST['create'])) { // 新規作成フォームPOST時
		create($pdo);
		$alert = "success";
		$comment = "新着情報「".$_POST['title']."」を登録いたしました。";
		$stmh = newsList($pdo, $page);
	}
	if(isset($_POST['update'])) { // 編集フォームPOST時
		update($pdo);
		$alert = "warning";
		$comment = "1件の新着情報を更新いたしました。";
		$stmh = newsList($pdo, $page);
	}
	if(isset($_POST['delete'])) { // 削除時
		delete($pdo);
		$alert = "danger";
		$comment = "1件の新着情報を削除いたしました。";
		$stmh = newsList($pdo, $page);
	}
	if(isset($_POST['is_hidden'])) { // 公開/非公開切り替え時
		$alert = "info";
		$isPublic;
		if($_POST['is_hidden']==1) {
			$comment = "1件の新着情報を非公開に変更しました。";
			$isPublic = true;
		} else {
			$comment = "1件の新着情報を公開に変更しました。";
			$isPublic = false;
		}
		isHidden($pdo, $isPublic);
		$stmh = newsList($pdo, $page);
	}
	if (isset($_GET['logout'])) { // ログアウト処理
		session_destroy();
		header('Location: ' . $admin_url . '/login');
		return;
	}
}

$stmh = newsList($pdo, $page);

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
<?php include '../views/common/head.php' ?>

<body>
	<?php include '../views/common/sidebar.php' ?>

	<div class="wrapper d-flex flex-column min-vh-100 bg-light">
		<?php include '../views/common/header.php' ?>
		<div class="header-divider"></div>
		<div class="container-fluid">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb my-0 ms-2">
					<li class="breadcrumb-item">
						<!-- if breadcrumb is single--><span>Home</span>
					</li>
					<li class="breadcrumb-item"><span>新着情報</span></li>
					<li class="breadcrumb-item active"><span><?= $title ?></span></li>
				</ol>
			</nav>
		</div>
		</header>

		<div class="body flex-grow-1 px-3">
			<div class="container-lg">
				<!-- 共通 -->
				<?php 
					if($comment!=null) {
						echo '<div class="alert alert-'.$alert.'" role="alert">';
						echo $comment;
						echo '</div>';
					}
				?>
				<?php include '../views/news/'.$views ?>
			</div><!-- end 共通 -->
		</div>

		<?php include '../views/common/footer.php' ?>

</body>

</html>