<?php

// アカウント情報確認[POST]
function findByEmail($pdo) {
	try {
		$sql = "SELECT * FROM recruit_accounts WHERE email=:email";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
		$stmh->execute();
	} catch(PDOException $Exception) {
		print "error : " . $Exception->getMessage();
	}
	return $stmh;
}


// パスワード再設定[POST]
function resetPass($pdo, $email, $password) {
	try {
		$pdo->beginTransaction();
		$sql = "UPDATE recruit_accounts SET password=:password WHERE email=:email";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
		$stmh->bindValue(':email', $email);
		$stmh->execute();
		$pdo->commit();
	} catch(PDOException $Exception) {
		$pdo->rollBack();
		print "error : " . $Exception->getMessage();
	}
}

// アカウントが存在するか確認[COUNT]
function accCount($pdo) {
	try {
		$sql = "SELECT * FROM recruit_accounts";
		$stmh = $pdo->query($sql);
		$count = $stmh -> rowCount();
	} catch(PDOException $Exception) {
		print "error : " . $Exception->getMessage();
	}
	return $count;
}

// アカウント作成[POST]
function create($pdo, $email, $password) {
	try {
		$pdo->beginTransaction();
		$sql = "INSERT INTO recruit_accounts(email, password) VALUE(:email, :password)";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':email', $email);
		$stmh->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
		$stmh->execute();
		$pdo->commit();
	} catch(PDOException $Exception) {
		$pdo->rollBack();
		print "error : " . $Exception->getMessage();
	}
}