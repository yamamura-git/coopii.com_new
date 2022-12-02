<form action="./mailto.php" method="post">
	<div class="mb-3 row">
		<label for="name" class="col-sm-2 col-form-label">氏名</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="name" id="name">
		</div>
	</div>
	<!-- <div class="mb-3 row">
		<label for="read_name" class="col-sm-2 col-form-label">よみがな</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="read_name">
		</div>
	</div> -->
	<div class="mb-3 row">
		<label for="email" class="col-sm-2 col-form-label">メールアドレス</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" name="email" id="email">
		</div>
	</div>
	<!-- <div class="mb-3 row">
		<div class="col-sm-2">性別</div>
		<div class="col-sm-10">
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
	<div class="mb-3 row">
		<label for="birthdate" class="col-sm-2 col-form-label">生年月日</label>
		<div class="col-sm-5">
			<input type="date" class="form-control" id="birthdate">
		</div>
	</div>
	<div class="mb-3 row">
		<label for="post_code" class="col-sm-2 col-form-label">郵便番号</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="post_code">
		</div>
	</div>
	<div class="mb-3 row">
		<label for="address" class="col-sm-2 col-form-label">住所　（住所／建物名）</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="address">
		</div>
	</div>
	<div class="mb-3 row">
		<label for="tel_number" class="col-sm-2 col-form-label">電話番号</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tel_number">
		</div>
	</div> -->
	<div class="mb-3 row">
		<div class="col-sm-2">希望勤務地</div>
		<div class="col-sm-10">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="location" id="oosaka" value="大阪本社">
				<label class="form-check-label" for="oosaka">大阪本社</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="location" id="takamatsu" value="高松サテライト（香川県・愛媛県）">
				<label class="form-check-label" for="takamatsu">高松サテライト（香川県・愛媛県）</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="location" id="other" value="不問">
				<label class="form-check-label" for="other">不問</label>
			</div>
		</div>
	</div>
	<div class="mb-3 row">
		<label for="resume" class="col-sm-2 col-form-label">履歴書</label>
		<div class="col-sm-10">
			<input type="file" name="resume" class="form-control" id="resume">
		</div>
	</div>
	<!-- <div class="mb-3 row">
		<div class="col-sm-2">応募種別</div>
		<div class="col-sm-10">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="location" id="new_graduate" value="new_graduate">
				<label class="form-check-label" for="new_graduate">新卒</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="location" id="inexperienced" value="inexperienced">
				<label class="form-check-label" for="inexperienced">未経験</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="location" id="career_recruitment" value="career_recruitment">
				<label class="form-check-label" for="career_recruitment">キャリア採用</label>
			</div>
		</div>
	</div> -->

	<!-- 新卒 -->
	<!-- <div class="mb-3 row">
		<div class="col-sm-2">学校種別</div>
		<div class="col-sm-10">
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
	<div class="mb-3 row">
		<label for="read_name" class="col-sm-2 col-form-label">卒業見込み年度</label>
		<div class="col-sm-5">
			<input type="date" class="form-control" id="graduation_year">
		</div>
	</div> -->
	<!-- 新卒 end -->

	<!-- 未経験 -->
	<!-- <div class="mb-3 row">
		<label for="career_overview1" class="col-sm-2 col-form-label">経歴概略</label>
		<div class="col-sm-10">
			<textarea class="form-control" id="career_overview1" rows="3"></textarea>
			<p>就業経験（アルバイト含む）など、ご経歴の概略をお書きください</p>
		</div>
	</div> -->
	<!-- 未経験 end -->

	<!-- キャリア採用 -->
	<!-- <div class="mb-3 row">
		<label for="career_overview2" class="col-sm-2 col-form-label">経歴概略</label>
		<div class="col-sm-10">
			<textarea class="form-control" id="career_overview2" rows="3"></textarea>
			<p>職務経歴の概略をお書きください</p>
		</div>
	</div> -->
	<!-- キャリア採用 end -->

	<div class="mb-3 row">
		<label for="message" class="col-sm-2 col-form-label">質問／メッセージ</label>
		<div class="col-sm-10">
			<textarea class="form-control" id="message" name="message" rows="3"></textarea>
		</div>
	</div>
	<div class="row justify-content-center">
		<input type="hidden" name="submit">
		<button type="submit" class="btn btn-primary col-2">送信</button>
	</div>
</form>