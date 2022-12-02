<div class="card mb-4">
	<div class="card-body">
		<form action="<?php echo $admin_url ?>/news/" method="post">
			<div class="mb-3">
				<select class="form-select" id="selbox" name="selected" onchange="change();">
					<option selected>選択してください</option>
					<option value="1">リンク</option>
					<option value="2">ブログ</option>
				</select>
			</div>
			<div class="mb-3">
				<label for="title" class="form-label">タイトル</label>
				<input type="text" class="form-control" id="title" name="title" required>
				<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
			</div>
			<div class="mb-3 hide" id="selected_link">
				<label for="link" class="form-label">リンク先</label>
				<input type="text" class="form-control" id="link" name="link">
				<input type="hidden" id="link_target" name="link_target" value="0">
				<input class="form-check-input" type="checkbox" id="link_target" name="link_target" value="1" checked>
				<label class="form-check-label" for="link_target">新規ウィンドウ</label>
			</div>
			<div class="mb-3 hide" id="selected_blog">
				<label for="body" class="form-label">本文</label><textarea name="body"> </textarea>
			</div>
			<button type="submit" name="create" class="btn btn-primary" onclick="buttonClick()">登録</button>
		</form>
	</div>
</div>

<script src="../views/js/tinymce/tinymce.min.js"></script>
<script src="../views/js/richtext.js"></script>
<script>
	const element = document.getElementsByClassName('hide');
	for (var i = 0; i < element.length; i++) {
		element[i].style.display = "none";
	}

	function change() {
		let selected = '';
		if (document.getElementById("selbox")) {
			selboxValue = document.getElementById("selbox").value;
			switch (selboxValue) {
				case '1':
					selected = 'selected_link'
					break;
				case '2':
					selected = 'selected_blog';
					break;
			}
		}
		for (var i = 0; i < element.length; i++) {
			element[i].style.display = "none";
		}
		document.getElementById(selected).style.display = "block";
	}
</script>