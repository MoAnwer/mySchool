<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <form
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-5">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ml-2 d-none d-lg-inline text-gray-600 small">
                    <?= Session::get('username')?>
                </span>
                <img class="img-profile rounded-circle"
                    src="http://myschool.great-site.net/assets/images/undraw_profile_2.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right animated--grow-in" style="right: -20px;"
                aria-labelledby="userDropdown">
                <a class="dropdown-item pr-0 py-2" href="profile">
                    <i class="bi bi-person-circle mx-2 text-gray-400"></i>
                    الملف الشخصي
                </a>
                <?php if (Session::has('superadmin')) : ?>
                        <a class="dropdown-item pr-0 py-2" href="settings">
                            <i class="bi bi-gear-fill mx-2 text-gray-400"></i>
                            الاعدادات
                        </a>
                        <div class="dropdown-divider my-1"></div>
                <?php endif;?>
                <a class="dropdown-item pr-0 py-2" href="http://myschool.great-site.net/logout">
                    <i class="bi bi-door-open-fill mx-2 text-gray-400"></i>
                    خروج
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

