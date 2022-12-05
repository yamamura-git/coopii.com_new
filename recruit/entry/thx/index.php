<?php
session_start();
require_once('../../admin/views/common/include.php');

$page_name = "エントリーシート | ";
$css = "entry";
$top_page = false;
$entry_page = true;


// セッション削除
unset($_SESSION['token']);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include '../../views/head.php'; ?>

<body>
	<?php include '../../views/header.php'; ?>

	<!-- メインコンテンツ -->
	<main class="container">

		<div class="thx_box inner_content">
			<h3>エントリーシート</h3>
			<div class="thx_inner">
				<h4>応募が完了しました</h4>
				<p>求人にご応募いただきありがとうございました。<br>
					エントリーを受け付けました。</p>
				<p>折り返し担当者よりご連絡いたしますので、恐れ入りますがしばらくお待ちください。</p>
				<p>なお、ご入力いただいたメールアドレス宛に受付完了メールを配信しております。<br>
					完了メールが届かない場合、処理が正常に行われていない可能性があります。<br>
					大変お手数ですが、再度お問い合わせの手続きをお願い致します。</p>
			</div>
		</div>

	</main>

	<?php include '../../views/footer.php'; ?>

	<!-- TOPに戻る -->
	<div class="pagetop"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
		<path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
	</svg></div>
	<!-- TOPに戻る end -->
	<script src="<?php echo $host_url ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo $host_url ?>/js/script.js"></script>
</body>

</html>