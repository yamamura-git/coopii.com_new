<!-- header -->
<header>
	<div class="container">
		<div class="row align-items-center">
			<div class="logo_wrap"><a href="<?php echo $host_url ?>/" class="logo"><img src="<?php echo $host_url ?>/img/coopii_logo.gif" alt="CooPii System development"></a></div>
			<div class="text_wrap">
				<p class="mb-0 fst-italic logo_text">Recruiting Information<br><span class="ib">新卒・未経験・</span><span class="ib">キャリア採用サイト</span></p>
			</div>
			<div class="nav_wrap hNav" id="mNav">
				<nav>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link<?=$top_page ? ' active" aria-current="page':''?>" href="<?php echo $host_url ?>/">TOP</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $host_url ?>/company.html">会社概要</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $host_url ?>/business.html">事業を知る</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $host_url ?>/keyword.html">気になるキーワード</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $host_url ?>/recruit.html">募集要項</a>
						</li>
						<li class="nav-item">
							<a class="nav-link<?=$entry_page ? ' active" aria-current="page':''?>" href="<?php echo $host_url ?>/entry.html">エントリー</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>
<!-- header end -->