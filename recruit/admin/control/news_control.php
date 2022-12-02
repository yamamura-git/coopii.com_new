<?php

// 表示カウント数取得
function countNum($pdo) {
	$sql = "SELECT news_count FROM recruit_settings WHERE id = 1";
	$stmh = $pdo->prepare($sql);
	$stmh->execute();
	$count = $stmh->fetch(PDO::FETCH_ASSOC);
	return $count;
}

// ダッシュボード用新着情報[GET]
function index($pdo) {
	try {
		$count = countNum($pdo);
		// 新着情報取得
		$sql = "SELECT id, title, selected, link, link_target, update_at FROM recruit_news WHERE is_hidden IS NULL ORDER BY update_at DESC LIMIT :count";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':count', $count['news_count']);
		$stmh->execute();
	} catch(PDOException $Exception) {
		print "error : " . $Exception->getMessage();
	}
	return $stmh;
}

// 新着情報一覧[GET]
function newsList($pdo, $page) {
	try {
		$start = 10 * ($page - 1);
		$sql = "SELECT id, title, link, link_target, update_at, is_hidden FROM recruit_news ORDER BY update_at DESC LIMIT :start,10";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':start', $start);
		$stmh->execute();
	} catch(PDOException $Exception) {
		print "error : " . $Exception->getMessage();
	}
	return $stmh;
}

// ページ数取得
function pageCount() {
	$pdo = db_connect();
	$sql = "SELECT COUNT(*) AS cnt FROM recruit_news";
	$counts = $pdo->prepare($sql);
	$counts->execute();
	return $counts;
}

// 新着情報登録[POST]
function create($pdo) {
	try {
		$pdo->beginTransaction();
		// if($_POST['selected'] == 1) {
		// } else {
		// 	$sql = "INSERT INTO recruit_news(title, selected, body, create_at, update_at) VALUES(:title, :selected, :body, now(), now())";
		// }
		$sql = "INSERT INTO recruit_news(title, selected, link, link_target, body, create_at, update_at) VALUES(:title, :selected, :link, :link_target, :body, now(), now())";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
		$stmh->bindValue(':selected', filter_input(INPUT_POST, 'selected'));
		$stmh->bindValue(':link', filter_input(INPUT_POST, 'link'));
		$stmh->bindValue(':link_target', filter_input(INPUT_POST, 'link_target'));
		$stmh->bindValue(':body', filter_input(INPUT_POST, 'body'));
		$stmh->execute();
		$pdo->commit();
	} catch(PDOException $Exception) {
		$pdo->rollBack();
		print "error : " . $Exception->getMessage();
	}
}

// 詳細[GET?id]
function detail($pdo) {
	try {
		$sql = "SELECT id, title, selected, body, link, link_target, update_at, is_hidden FROM recruit_news WHERE id=:id";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
		$stmh->execute();
	} catch(PDOException $Exception) {
		print "error : " . $Exception->getMessage();
	}
	return $stmh;
}

// 編集[POST]
function update($pdo) {
	try {
		$pdo->beginTransaction();
		if($_POST['selected'] == 1) {
			$sql = "UPDATE recruit_news SET title=:title, link=:link, link_target=:link_target, update_at=now() WHERE id=:id";
			$stmh = $pdo->prepare($sql);
			$stmh->bindValue(':link', $_POST['link'], PDO::PARAM_STR);
			$stmh->bindValue(':link_target', $_POST['link_target'], PDO::PARAM_INT);
		} else {
			$sql = "UPDATE recruit_news SET title=:title, body=:body, update_at=now() WHERE id=:id";
			$stmh = $pdo->prepare($sql);
			$stmh->bindValue(':body', $_POST['body'], PDO::PARAM_STR);
		}
		$stmh->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
		$stmh->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
		$stmh->execute();
		$pdo->commit();
	} catch(PDOException $Exception) {
		$pdo->rollBack();
		print "error : " . $Exception->getMessage();
	}
}

// 公開 or 非公開
function isHidden($pdo, $isPublic) {
	try {
		if($isPublic) {
			$sql = "UPDATE recruit_news SET is_hidden=null WHERE id=:id";
		} else {
			$sql = "UPDATE recruit_news SET is_hidden=true WHERE id=:id";
		}
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
		$stmh->execute();
	} catch(PDOException $Exception) {
		print "error : " . $Exception->getMessage();
	}
}

// 削除[POST]
function delete($pdo) {
	try {
		$sql = "DELETE FROM recruit_news WHERE id=:id";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
		$stmh->execute();
	} catch(PDOException $Exception) {
		print "error : " . $Exception->getMessage();
	}
}
