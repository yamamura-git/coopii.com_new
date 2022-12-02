<?php
require "../admin/vendor/autoload.php";

use eftec\bladeone\BladeOne;

$page_name = "新着情報 | ";
$css = "index";
$top_page = false;
$entry_page = false;

require_once('../admin/views/common/include.php');
require_once('../admin/control/news_control.php');
$pdo = db_connect();
$stmh = detail($pdo);
$pdo = null;
?>
<!DOCTYPE html>
<html lang="ja">
<?php  include '../views/head.php'; ?>

<body>
	<?php include '../views/header.php' ?>

	<!-- メインコンテンツ -->
	<main class="container">

		<div class="news_detail inner_content">
			<h3>新着情報</h3>
			<?php while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
				$rdate = date('Y.m.d', strtotime($row['update_at'])) ?>
				<dl>
					<dt class="date"><?= $rdate ?></dt>
					<dd class="title"><?= htmlspecialchars($row['title'], ENT_QUOTES) ?></dd>
					<dd class="body"><?= $row['body'] ?></dd>
				</dl>
			<?php } ?>
		</div>

	</main>

	<?php include '../views/footer.php' ?>
	<!-- TOPに戻る -->
	<div class="pagetop"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
			<path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
		</svg></div>
	<!-- TOPに戻る end -->
	<script src="<?php echo $host_url ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo $host_url ?>/js/script.js"></script>
</body>

</html>