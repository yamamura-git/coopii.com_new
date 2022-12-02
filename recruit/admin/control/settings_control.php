<?php

// 表示カウント数変更
function countChange($pdo) {
	try {
		$pdo->beginTransaction();
		$sql = "UPDATE recruit_settings SET news_count=:count WHERE id=1";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':count', $_POST['count'], PDO::PARAM_INT);
		
		$stmh->execute();
		$pdo->commit();
	} catch(PDOException $Exception) {
		$pdo->rollBack();
		print "error : " . $Exception->getMessage();
	}
}

