<?php
require_once('../admin/views/common/include.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../admin/vendor/autoload.php';

// if (isset($_POST['submit'])) {
function mailto($name, $email, $location, $apply_type, $message, $tempfile, $filename, $smtp_server, $mailaddress, $mail_password, $smtp_port, $send_name, $applicant_subject, $applicant_mail_body, $signature, $company_subject, $company_mail_body)
{
	// メール本文に入れるフォーム内容
	$mailbody = "-----------------------------------" . " \r\n";
	$mailbody .= "【氏名】" . $name . " \r\n";
	$mailbody .= "【メールアドレス】" . $email . " \r\n";
	$mailbody .= "【希望勤務地】" . $location . " \r\n";
	$mailbody .= "【応募種別】" . $apply_type . " \r\n";
	$mailbody .= "【履歴書】" . $filename . " \r\n";
	$mailbody .= "【質問／メッセージ】" . $message . " \r\n";
	$mailbody .= "-----------------------------------" . " \r\n";

	try {
		/****************  応募者用  ****************/
		$applicant_mail = new PHPMailer(true); // インスタンスを生成（true指定で例外を有効化）
		$applicant_mail->CharSet = 'utf-8'; // 文字エンコードを指定

		// デバッグ設定
		// $applicant_mail->SMTPDebug = 2; // デバッグ出力を有効化（レベルを指定）
		// $applicant_mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

		// SMTPサーバの設定
		$applicant_mail->isSMTP();   // SMTPの使用宣言
		$applicant_mail->Host       = $smtp_server;	// SMTPサーバーを指定
		$applicant_mail->SMTPAuth   = true;			// SMTP authenticationを有効化
		$applicant_mail->Username   = $mailaddress;   // SMTPサーバーのユーザ名
		$applicant_mail->Password   = $mail_password;	// SMTPサーバーのパスワード
		$applicant_mail->SMTPSecure = 'tls';	// 暗号化を有効（tls or ssl）無効の場合はfalse
		$applicant_mail->Port       = $smtp_port;		// TCPポートを指定（tlsの場合は465や587）

		// 送受信先設定
		$applicant_mail->setFrom($mailaddress, $send_name);	// 送信者
		$applicant_mail->addAddress($email, $name);			// 宛先
		// $applicant_mail->addReplyTo($mailaddress, 'お問い合わせ'); // 返信先
		$applicant_mail->Sender = $mailaddress; // Return-path

		// 送信内容設定
		$applicant_mail->Subject = $applicant_subject;
		$applicant_mail->addAttachment($tempfile, $filename);
		$applicant_mail->Body    = $applicant_mail_body . "\n" . $mailbody . "\n" . $signature;

		/****************  自社用  ****************/
		$company_mail = new PHPMailer(true);
		$company_mail->CharSet = 'utf-8';

		// SMTPサーバの設定
		$company_mail->isSMTP();
		$company_mail->Host       = $smtp_server;
		$company_mail->SMTPAuth   = true;
		$company_mail->Username   = $mailaddress;
		$company_mail->Password   = $mail_password;
		$company_mail->SMTPSecure = 'tls';
		$company_mail->Port       = $smtp_port;

		// 送受信先設定
		$company_mail->setFrom($mailaddress, $send_name);
		$company_mail->addAddress($mailaddress, $send_name);
		$company_mail->Sender = $mailaddress;

		// 送信内容設定
		$company_mail->Subject = $company_subject;
		$company_mail->addAttachment($tempfile, $filename);
		$company_mail->Body    = $company_mail_body . "\n" . $mailbody . "\n" . $signature;


		/****************  送信  ****************/
		$applicant_mail->send();
		$company_mail->send();

		// echo "name: ".$name."<br>";
		// echo "email: ".$email."<br>";
		// echo $location."<br>";
		// echo $resume."<br>";
		// echo $tempfile."<br>";
		// echo $filename."<br>";
		// echo $message;
	} catch (Exception $e) { // エラーの場合
		echo "メッセージを送信できませんでした。メールエラー:{$applicant_mail->ErrorInfo}";
		// echo "Message could not be sent. Mailer Error: {$company_mail->ErrorInfo}";
	}
}
