<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="<?php echo $view_url; ?>/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
        </button><a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="<?php echo $view_url; ?>/assets/brand/coreui.svg#full"></use>
            </svg></a>
        <!-- <ul class="header-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                        <use xlink:href="<?php echo $view_url; ?>/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg></a></li>
        </ul> -->
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <!-- <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/8.jpg" alt="user@email.com"></div> -->
                    <div class="avatar bg-primary text-white">CUI</div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <a class="dropdown-item" href="<?php echo $admin_url ?>/?logout">
                    <svg class="icon me-2">
                        <use xlink:href="<?php echo $view_url; ?>/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                    </svg> Logout</a>
                </div>
            </li>
        </ul>
    </div>
    