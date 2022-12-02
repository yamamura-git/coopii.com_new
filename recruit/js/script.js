// ua
let ut = navigator.userAgent;

if (ut.indexOf('iPad') > 0 || ut.indexOf('iPhone') > 0 || ut.indexOf('iPod') > 0 || ut.indexOf('Android') > 0 && ut.indexOf('Mobile') > 0) { // Mobile
	// ハンバーガーメニュータグ生成
	document.body.insertAdjacentHTML('afterbegin', "<div id='m_overWrap'></div><button type='button' id='burger_btn' class='burger_btn js-btn'><span id='btn_line' class='btn-line'></span></button>");

	// バーガーボタンクリックイベント
	let flag = false;
	document.getElementById('burger_btn').addEventListener('click', function () {
		flag = !flag;
		if (flag) {
			document.getElementById('mNav').classList.add('open');
			document.getElementById('btn_line').classList.add('open');
			document.getElementById('m_overWrap').style.display ="block";
		} else {
			document.getElementById('mNav').classList.remove('open');
			document.getElementById('btn_line').classList.remove('open');
			document.getElementById('m_overWrap').style.display ="none";
		}
	});
	document.getElementById('m_overWrap').addEventListener('click', function () {
		document.getElementById('mNav').classList.remove('open');
		document.getElementById('btn_line').classList.remove('open');
		document.getElementById('m_overWrap').style.display ="none";
		flag = false;
	});
} else { // PC
}

// トップに戻る
const pagetop_btn = document.querySelector(".pagetop");
pagetop_btn.addEventListener("click", scroll_top);

function scroll_top() { // ページ上部へスムーズに移動
	window.scroll({
		top: 0,
		behavior: "smooth"
	});
}
window.addEventListener("scroll", scroll_event);

function scroll_event() {
	if (window.pageYOffset > 100) {
		pagetop_btn.style.display = "flex";
	} else if (window.pageYOffset < 100) {
		pagetop_btn.style.display = "none";
	}
}


