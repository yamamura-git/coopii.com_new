<?php
require "./admin/vendor/autoload.php";
Use eftec\bladeone\BladeOne;
$page_name = "";
$css = "index";
$top_page = true;
$entry_page = false;


require_once('./admin/views/common/include.php');
require_once('./admin/control/news_control.php');
$pdo = db_connect();
$stmh = index($pdo);
$pdo = null;
?>
<!DOCTYPE html>
<html lang="ja">

<?php  include './views/head.php'; ?>

<body>
<?php include './views/header.php' ?>

	<!-- メインコンテンツ -->
	<div class="banner_box index">
		<div class="container">
			<h2><span>"HELLO WORLD"</span></h2>
			<p class="subtitle">We are waiting for you</p>
		</div>
	</div>
	<main class="container">

		<div class="news_box inner_content">
			<h3 class="title">新着情報</h3>
			<?php while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
				$rdate = date('Y.m.d', strtotime($row['update_at'])) ?>
				<dl class="mb-1">
					<dt class="align-middle"><?= $rdate ?></dt>
					<?php if($row['selected'] == 1) : ?>
						<?php if($row['link_target'] === 1) : ?>
							<dd class="align-middle"><a href="<?= $row['link'] ?>" target="_blank"><?= htmlspecialchars($row['title'], ENT_QUOTES) ?></a></dd>
						<?php else : ?>
							<dd class="align-middle"><a href="<?= $row['link'] ?>"><?= htmlspecialchars($row['title'], ENT_QUOTES) ?></a></dd>
						<?php endif; ?>
					<?php else : ?>
						<dd class="align-middle"><a href="<?php echo $host_url; ?>/news/?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title'], ENT_QUOTES) ?></a></dd>
					<?php endif ; ?>
				</dl>
			<?php } ?>
		</div>

		<div class="about_box inner_content">
			<h3 class="title fst-italic"><span>About</span></h3>
			<p class="subtext">～私たちについて～</p>
			<div class="fxwb">
				<div class="banner">
					<a href="./company.html">
						<p class="page_name">会社概要</p>
					</a>
				</div>
				<div class="banner">
					<a href="./business.html">
						<p class="page_name">事業を知る</p>
					</a>
				</div>
				<div class="banner">
					<a href="./keyword.html">
						<p class="page_name">気になるキーワード</p>
					</a>
				</div>
				<div class="banner">
					<a href="./recruit.html">
						<p class="page_name">募集要項</p>
					</a>
				</div>
			</div>
		</div>

		<div class="entry_box inner_content">
			<a href="./entry.html">Entry | 応募する</a>
		</div>
	</main>
	<!-- メインコンテンツ end -->

	<?php include './views/footer.php' ?>

	<!-- TOPに戻る -->
	<div class="pagetop"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
			<path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
		</svg></div>
	<!-- TOPに戻る end -->

	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/smoothscroll.min.js"></script>
	<script src="./js/script.js"></script>
</body>

</html>