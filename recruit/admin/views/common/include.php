<?php
// URL
$domain = 'http://192.168.1.23/coopii.com_new';
$host_url = $domain . '/recruit';
$admin_url = $host_url . '/admin';
$view_url = $admin_url . '/views';

// mysql接続
function db_connect()
{
	$host = "localhost";
	$dbname = "recruit";
	$user = "yamamura";
	$pass = "";
	$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

	try {
		$pdo = new PDO($dsn, $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} catch (PDOException $Exception) {
		die('error : ' . $Exception->getMessage());
	}
	return $pdo;
}

function h($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

/**
 *  メール送信
 */
$smtp_server = "ssl://smtp.lolipop.jp";	// SMTPサーバー
$smtp_port = 465;	// SMTPポート番号
$mailaddress = "yamamura@coopii.com";	// SMTPサーバーのユーザ名
$mail_password = "vai07UCvxev-M";		// SMTPサーバーのパスワード

$send_name = "株式会社クーピー 採用担当";	// 送信者
$applicant_subject = "応募しました";		// 応募者件名
$company_subject = "求人サイトより応募がありました";	// 自社件名
// $reply_title = "お問い合わせ";	// 返信先

// 応募者返信本文
$applicant_mail_body = "
この度は弊社のエントリーシートにご応募いただきまして、
誠にありがとうございます。

3営業日以内にご連絡いたします。
ご不明点などがございましたら、お気軽にお問い合わせください。

よろしくお願いいたします。
";

// 自社返信本文
$company_mail_body = "
エントリーシートに応募がありました。

以下の内容をご確認の上、応募者へのご連絡をお願いいたします。
";

 // シグネチャ
$signature = "
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
株式会社クーピー
　採用担当

【大阪本社】
　　〒550-0014　大阪市西区北堀江2-2-7 北堀江ゲイトビル7F
　　TEL：06-6586-9435　FAX：06-6586-9436
　　URL：http://coopii.com
　　労働者派遣事業許可 (派 27-304486)
【高松サテライト】
　　〒760-0019　香川県高松市サンポート2番1号
　　高松シンボルタワー　タワー棟4・5階 情報通信交流館内
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
";