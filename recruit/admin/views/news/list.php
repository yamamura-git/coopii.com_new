<div class="card mb-4">
	<div class="card-body">
		<div class="tab-content rounded-bottom">
			<div class="tab-pane p-3 active preview" role="tabpanel" id="preview-387">
				<div class="mb-3">
					<a class="btn btn-info link-light fw-bold" href="<?php echo $admin_url; ?>/news?new">新規作成</a>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th class="col-3">日付</th>
							<th class="col-5">タイトル</th>
							<th class="col text-center">編集</th>
							<th class="col text-center">公開</th>
							<th class="col text-center">削除</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
							$rdate = date('Y/m/d H:d', strtotime($row['update_at'])) ?>
							<tr>
								<td class="align-middle"><?= $rdate ?></td>
								<td class="align-middle"><?= htmlspecialchars($row['title'], ENT_QUOTES) ?></td>
								<td class="text-center">
									<a class="btn btn-warning link-light fw-bold" href="<?php echo $admin_url; ?>/news/?id=<?= $row['id'] ?>">編集</a>
								</td>
								<td class="text-center">
									<form action="<?php echo $admin_url; ?>/news/" method="post">
										<input type="hidden" name="id" value="<?= $row['id'] ?>">
										<input type="hidden" name="is_hidden" value="<?= $row["is_hidden"] ?>">
										<?php
										if ($row['is_hidden'] == null) {
											echo '<button class="btn btn-secondary link-light fw-bold" type="submit">非公開</button>';
										} else {
											echo '<button class="btn btn-success link-light fw-bold" type="submit">公開</button>';
										}
										?>
									</form>
								</td>
								<td class="text-center">
									<form action="<?php echo $admin_url; ?>/news/" method="post">
										<input type="hidden" name="id" value="<?= $row['id'] ?>">
										<button class="btn btn-primary fw-bold" type="submit" name="delete" onclick='return confirm("本当に削除しますか？");'>削除</button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
$counts = pageCount();
$count = $counts->fetch();
$max_page = ceil($count['cnt'] / 10);
if ($count['cnt'] > 0) : ?>
	<div class="row row-cols-auto justify-content-md-center">
		<!-- ページング -->
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<?php if ($page > 1) : ?>
					<li class="page-item">
						<a class="page-link" href="<?php echo $admin_url; ?>/news/?page=<?php echo $page - 1; ?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
				<?php endif; ?>
				<?php
				for ($i = 1; $i <= $max_page; $i++) {
					// if ($i == $now) {
					// 	echo '<li class="page-item"><a class="page-link active" href="' . $admin_url . '/news/?page=' . $i . '">'.$i.'</a></li>';
					// } else {
						echo '<li class="page-item"><a class="page-link" href="' . $admin_url . '/news/?page=' . $i . '">'.$i.'</a></li>';
					// }
				} 
				?>
				<?php
				if ($page < $max_page) : ?>
					<li class="page-item">
						<a class="page-link" href="<?php echo $admin_url; ?>/news/?page=<?php echo $page + 1; ?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</nav>
	</div>
<?php endif; ?>