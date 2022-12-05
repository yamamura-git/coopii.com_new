<?php
session_start();
require_once('../admin/views/common/include.php');

use \Volnix\CSRF\CSRF;

require '../admin/vendor/autoload.php';
require './mailto.php';


$page_name = "エントリーシート | ";
$css = "entry";
$top_page = false;
$entry_page = true;

$views = "form.php";

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//エラーメッセージを保存する配列の初期化
	$error = array();

	// POSTされたデータを変数に格納
	//（値の初期化とデータの整形：前後にあるホワイトスペースを削除）
	$name = trim(filter_input(INPUT_POST, 'name'));
	$email = trim(filter_input(INPUT_POST, 'email'));
	$location = trim(filter_input(INPUT_POST, 'location'));
	$apply_type = trim(filter_input(INPUT_POST, 'apply_type'));
	$resume = trim(filter_input(INPUT_POST, 'resume'));
	$message = trim(filter_input(INPUT_POST, 'message'));
	$tempfile = $_FILES['resume']['tmp_name'];
	$filename = $_FILES['resume']['name'];
	if ($name == "") {
		$error['name'] = '*氏名は必須項目です。';
	}
	if ($email == "") {
		$error['email'] = "*メールアドレスは必須項目です。";
	} else { //メールアドレスを正規表現でチェック
		$pattern = '/\A([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}\z/uiD';
		if (!preg_match($pattern, $email)) {
			$error['email'] = '*メールアドレスの形式が正しくありません。';
		}
	}
	if ($location == "") {
		$error['location'] = "*希望勤務地は必須項目です。";
	}
	if ($apply_type == "") {
		$error['apply_type'] = "*応募種別は必須項目です。";
	}
	if ($filename == "") {
		$error['resume'] = '*履歴書は必須項目です。';
	}


	if (empty($error)) {
		if (CSRF::validate($_POST)) {// トークンを確認
			mailto($name, $email, $location, $apply_type, $message, $tempfile, $filename, $smtp_server, $mailaddress, $mail_password, $smtp_port, $send_name, $applicant_subject, $applicant_mail_body, $signature, $company_subject, $company_mail_body);
			session_destroy();
			header('Location: ' . $host_url . '/entry/thx');
			// header('Location: '. $host_url . '/entry/mailto.php');
		} else {
			echo "不正アクセスの可能性があります";
			echo CSRF::validate($_POST);
			exit();
		}
	}
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include '../views/head.php'; ?>

<body>
	<?php include '../views/header.php'; ?>

	<!-- メインコンテンツ -->
	<main class="container">

		<div class="entry_box inner_content">
			<h3>エントリーシート</h3>
			<form action="./" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?= CSRF::TOKEN_NAME ?>" value="<?= CSRF::getToken() ?>" />
				<div class="mb-4 row">
					<label for="name" class="col-sm-3 col-form-label required">氏名</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="name" id="name" aria-describedby="err_name" required>
						<?php if (isset($error['name'])) echo'<div id="err_name" class="invalid-feedback d-block">'. h($error['name']) .'</div>'?>
					</div>
				</div>
				<!-- <div class="mb-4 row">
					<label for="read_name" class="col-sm-3 col-form-label">よみがな</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="read_name">
					</div>
				</div> -->
				<div class="mb-4 row">
					<label for="email" class="col-sm-3 col-form-label required">メールアドレス</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" name="email" id="email" required>
						<?php if (isset($error['email'])) echo '<div id="err_email" class="invalid-feedback d-block">' . h($error['email']) . '</div>' ?>
					</div>
				</div>
				<!-- <div class="mb-4 row">
					<div class="col-sm-3">性別</div>
					<div class="col-sm-9">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" id="male" value="male">
							<label class="form-check-label" for="male">男</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" id="female" value="female">
							<label class="form-check-label" for="female">女</label>
						</div>
					</div>
				</div>
				<div class="mb-4 row">
					<label for="birthdate" class="col-sm-3 col-form-label">生年月日</label>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="birthdate">
					</div>
				</div>
				<div class="mb-4 row">
					<label for="post_code" class="col-sm-3 col-form-label">郵便番号</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="post_code">
					</div>
				</div>
				<div class="mb-4 row">
					<label for="address" class="col-sm-3 col-form-label">住所　（住所／建物名）</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="address">
					</div>
				</div>
				<div class="mb-4 row">
					<label for="tel_number" class="col-sm-3 col-form-label">電話番号</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="tel_number">
					</div>
				</div> -->
				<div class="mb-4 row">
					<div class="col-sm-3 required">希望勤務地</div>
					<div class="col-sm-9">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="location" id="oosaka" value="大阪本社" required>
							<label class="form-check-label" for="oosaka">大阪本社</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="location" id="takamatsu" value="高松サテライト（香川県・愛媛県）" required>
							<label class="form-check-label" for="takamatsu">高松サテライト（香川県・愛媛県）</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="location" id="other" value="不問" required>
							<label class="form-check-label" for="other">不問</label>
						</div>
						<?php if (isset($error['location'])) echo'<div id="err_location" class="invalid-feedback d-block">'. h($error['location']) .'</div>'?>
					</div>
				</div>
				<div class="mb-4 row">
					<div class="col-sm-3 required">応募種別</div>
					<div class="col-sm-9">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="apply_type" id="new_graduate" value="新卒" required>
							<label class="form-check-label" for="new_graduate">新卒</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="apply_type" id="inexperienced" value="未経験" required>
							<label class="form-check-label" for="inexperienced">未経験</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="apply_type" id="career_recruitment" value="キャリア採用" required>
							<label class="form-check-label" for="career_recruitment">キャリア採用</label>
						</div>
						<?php if (isset($error['apply_type'])) echo'<div id="err_apply_type" class="invalid-feedback d-block">'. h($error['apply_type']) .'</div>'?>
					</div>
				</div>
				<div class="mb-4 row">
					<label for="resume" class="col-sm-3 col-form-label required">履歴書</label>
					<div class="col-sm-9">
						<input type="file" name="resume" class="form-control" id="resume" accept=".pdf,.xlsx,.docx" required>
						<?php if (isset($error['resume'])) echo '<div id="err_resume" class="invalid-feedback d-block">' . h($error['resume']) . '</div>' ?>
					</div>
				</div>

				<!-- 新卒 -->
				<!-- <div class="mb-4 row">
					<div class="col-sm-3">学校種別</div>
					<div class="col-sm-9">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="school_type" id="grad" value="grad">
							<label class="form-check-label" for="grad">大学院</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="school_type" id="university" value="university">
							<label class="form-check-label" for="university">大学</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="school_type" id="college" value="college">
							<label class="form-check-label" for="college">高等専門学校</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="school_type" id="junior_college" value="junior_college">
							<label class="form-check-label" for="junior_college">短期大学</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="school_type" id="Vocational" value="Vocational">
							<label class="form-check-label" for="Vocational">専門学校</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="school_type" id="high_school" value="high_school">
							<label class="form-check-label" for="high_school">高等学校</label>
						</div>
					</div>
				</div>
				<div class="mb-4 row">
					<label for="read_name" class="col-sm-3 col-form-label">卒業見込み年度</label>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="graduation_year">
					</div>
				</div> -->
				<!-- 新卒 end -->

				<!-- 未経験 -->
				<!-- <div class="mb-4 row">
					<label for="career_overview1" class="col-sm-3 col-form-label">経歴概略</label>
					<div class="col-sm-9">
						<textarea class="form-control" id="career_overview1" rows="3"></textarea>
						<p>就業経験（アルバイト含む）など、ご経歴の概略をお書きください</p>
					</div>
				</div> -->
				<!-- 未経験 end -->

				<!-- キャリア採用 -->
				<!-- <div class="mb-4 row">
					<label for="career_overview2" class="col-sm-3 col-form-label">経歴概略</label>
					<div class="col-sm-9">
						<textarea class="form-control" id="career_overview2" rows="3"></textarea>
						<p>職務経歴の概略をお書きください</p>
					</div>
				</div> -->
				<!-- キャリア採用 end -->

				<div class="mb-4 row">
					<label for="message" class="col-sm-3 col-form-label">質問／メッセージ</label>
					<div class="col-sm-9">
						<textarea class="form-control" id="message" name="message" rows="3"></textarea>
					</div>
				</div>
				<div class="row justify-content-center">
					<button type="submit" class="btn btn-primary col-2">送信</button>
				</div>
			</form>
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