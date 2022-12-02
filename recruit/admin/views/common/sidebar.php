<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
	<div class="sidebar-brand d-none d-md-flex">株式会社 CooPii</div>
	<ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
		<li class="nav-item"><a class="nav-link" href="<?php echo $admin_url; ?>">
			<svg class="nav-icon">
				<use xlink:href="<?php echo $view_url; ?>/vendors/@coreui/icons/svg/free.svg#cil-paper-plane"></use>
			</svg> ダッシュボード<!-- <span class="badge badge-sm bg-info ms-auto">NEW</span> --></a></li>
		<li class="nav-title">新着情報</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo $admin_url; ?>/news?new" method="post">
			<svg class="nav-icon">
				<use xlink:href="<?php echo $view_url; ?>/vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
			</svg> 新規作成</a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo $admin_url; ?>/news/">
			<svg class="nav-icon">
				<use xlink:href="<?php echo $view_url; ?>/vendors/@coreui/icons/svg/free.svg#cil-book"></use>
			</svg> 一覧確認</a></li>
		<!-- <li class="nav-title">アカウント管理</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo $admin_url; ?>/acount/">
			<svg class="nav-icon">
				<use xlink:href="<?php echo $admin_url; ?>/vendors/@coreui/icons/svg/free.svg#cil-people"></use>
			</svg> 一覧確認</a></li> -->
		<li class="nav-divider"></li>
	</ul>
	<!-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button> -->
</div>