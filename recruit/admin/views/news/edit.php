<div class="card mb-4">
	<div class="card-body">
		<form action="<?php echo $admin_url ?>/news/" method="post">
			<div class="mb-3">
				<label for="title" class="form-label">タイトル</label>
				<input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>" required>
			</div>
			<?php if ($row['selected'] == 1) : ?>
				<div class="mb-3" id="selected_link">
					<label for="link" class="form-label">リンク先</label>
					<input type="text" class="form-control" id="link" name="link" value="<?= htmlspecialchars($row['link'], ENT_QUOTES) ?>" required>
					<input type="hidden" id="link_target" name="link_target" value="0">
					<?php if($row['link_target'] == 1) : ?>
						<input class="form-check-input" type="checkbox" id="link_target" name="link_target" value="1" checked>
					<?php else : ?>
						<input class="form-check-input" type="checkbox" id="link_target" name="link_target" value="1">
					<?php endif; ?>
					<label class="form-check-label" for="link_target">新規ウィンドウ</label>
				</div>
			<?php else : ?>
				<div class="mb-3" id="selected_blog">
					<label for="body" class="form-label">本文</label><textarea name="body" required><?= htmlspecialchars($row['body'], ENT_QUOTES) ?></textarea>
				</div>
			<?php endif; ?>
			<input type="hidden" name="id" value="<?= $row['id'] ?>">
			<input type="hidden" name="selected" value="<?= $row['selected'] ?>">
			<button type="submit" name="update" class="btn btn-primary">登録</button>
		</form>
	</div>
</div>

<script src="../views/js/tinymce/tinymce.min.js"></script>
<script src="../views/js/richtext.js"></script>