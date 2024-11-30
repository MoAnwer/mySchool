
        <!-- Sidebar -->
        <ul class="navbar-nav p-0 bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
                <div class="sidebar-brand-icon">
                    <img src="http://myschool.great-site.net/assets/images/rome.svg" alt="" width="30">
                </div>
                <div class="sidebar-brand-text mx-2"><?=Session::get('app')?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item mb-0">
                <a class="nav-link pb-2" href="http://myschool.great-site.net/views/admin/student">
                    <i class="bi bi-person-plus-fill text-success"></i>
                    <span>اضافة تلميذ</span>
                </a>
            </li>

             <!-- Nav Item -->
            <li class="nav-item mb-1">
                <a class="nav-link" href="http://myschool.great-site.net/views/admin/reports">
                    <i class="i bi-newspaper text-info"></i>
                    <span>التقارير</span>
                </a>
            </li>
    
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                تقارير الرياض
            </div>

            <li class="nav-item mb-0">
                <a class="nav-link pb-2" href="http://myschool.great-site.net/views/admin/student-information">
                    <i class="bi bi-people text-info"></i>
                    <span>قائمة تلاميذ الرياض</span></a>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#money"
                    aria-expanded="true" aria-controls="money">
                    <i class="bi bi-coin text-success ml-1"></i>
                    <span>حسابات</span>
                </a>
                <div id="money" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="accounts">حسابات عامة</a>
                        <a class="collapse-item" href="accounts-details">حسابات مفصلة</a>
                        <a class="collapse-item" href="installments-remanent">حسابات متبقي أقساط </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#resultInstallments"
                    aria-expanded="true" aria-controls="resultInstallments">
                    <i class="bi bi-cash-coin text-warning"></i>
                    <span>متبقي أقساط</span>
                </a>
                <div id="resultInstallments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="installment-remanent?i=1">القسط الأول</a>
                        <a class="collapse-item" href="installment-remanent?i=2">القسط الثاني</a>
                        <a class="collapse-item" href="installment-remanent?i=3">القسط الثالث</a>
                        <a class="collapse-item" href="installment-remanent?i=4">القسط الرابع</a>
                        <a class="collapse-item" href="installment-remanent?i=5">القسط الخامس</a>
                        <a class="collapse-item" href="installment-remanent?i=6">القسط السادس</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#installments"
                    aria-expanded="true" aria-controls="installments">
                     <i class="bi bi-patch-minus-fill text-danger ml-1"></i>
                    <span>متأخرات اقساط</span>
                </a>
                <div id="installments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="installment-arrears?i=1">القسط الأول</a>
                        <a class="collapse-item" href="installment-arrears?i=2">القسط الثاني</a>
                        <a class="collapse-item" href="installment-arrears?i=3">القسط الثالث</a>
                        <a class="collapse-item" href="installment-arrears?i=4">القسط الرابع</a>
                        <a class="collapse-item" href="installment-arrears?i=5">القسط الخامس</a>
                        <a class="collapse-item" href="installment-arrears?i=6">القسط السادس</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block mb-3">


            <!------------  Base Reports  -------------->

            <!-- Heading -->
            <div class="sidebar-heading">
                تقارير الابتدائي
            </div>

            <li class="nav-item mb-0">
                <a class="nav-link pb-2" href="http://myschool.great-site.net/views/admin/student-information?s=2">
                    <i class="bi bi-people text-info"></i>
                    <span>قائمة تلاميذ الابتدائي</span></a>
                </a>
            </li>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#basemoney"
                    aria-expanded="true" aria-controls="basemoney">
                    <i class="bi bi-coin text-success ml-1"></i>
                    <span>حسابات</span>
                </a>
                <div id="basemoney" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="accounts?s=2">حسابات عامة</a>
                        <a class="collapse-item" href="accounts-details?s=2">حسابات مفصلة</a>
                        <a class="collapse-item" href="installments-remanent?s=2">حسابات متبقي أقساط </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#baseresultInstallments"
                    aria-expanded="true" aria-controls="baseresultInstallments">
                    <i class="bi bi-cash-coin text-warning ml-1"></i>
                    <span>متبقي أقساط</span>
                </a>
                <div id="baseresultInstallments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="installment-remanent?s=2&i=1">القسط الأول</a>
                        <a class="collapse-item" href="installment-remanent?s=2&i=2">القسط الثاني</a>
                        <a class="collapse-item" href="installment-remanent?s=2&i=3">القسط الثالث</a>
                        <a class="collapse-item" href="installment-remanent?s=2&i=4">القسط الرابع</a>
                        <a class="collapse-item" href="installment-remanent?s=2&i=5">القسط الخامس</a>
                        <a class="collapse-item" href="installment-remanent?s=2&i=6">القسط السادس</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#baseinstallments"
                    aria-expanded="true" aria-controls="baseinstallments">
                     <i class="bi bi-patch-minus-fill text-danger ml-1"></i>
                    <span>متأخرات اقساط</span>
                </a>
                <div id="baseinstallments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="installment-arrears?s=2&i=1">القسط الأول</a>
                        <a class="collapse-item" href="installment-arrears?s=2&i=2">القسط الثاني</a>
                        <a class="collapse-item" href="installment-arrears?s=2&i=3">القسط الثالث</a>
                        <a class="collapse-item" href="installment-arrears?s=2&i=4">القسط الرابع</a>
                        <a class="collapse-item" href="installment-arrears?s=2&i=5">القسط الخامس</a>
                        <a class="collapse-item" href="installment-arrears?s=2&i=6">القسط السادس</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block mb-3">

            <!------------  Base Reports  -------------->




            <!------------  Middle Reports  -------------->

            <!-- Heading -->
            <div class="sidebar-heading">
                تقارير المتوسط
            </div>

            <li class="nav-item mb-0">
                <a class="nav-link pb-2" href="http://myschool.great-site.net/views/admin/student-information?s=3">
                    <i class="bi bi-people text-info text"></i>
                    <span>قائمة تلاميذ المتوسط</span></a>
                </a>
            </li>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#middlemoney"
                    aria-expanded="true" aria-controls="middlemoney">
                    <i class="bi bi-coin text-success ml-1"></i>
                    <span>حسابات</span>
                </a>
                <div id="middlemoney" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="accounts?s=3">حسابات عامة</a>
                        <a class="collapse-item" href="accounts-details?s=3">حسابات مفصلة</a>
                        <a class="collapse-item" href="installments-remanent?s=3">حسابات متبقي أقساط </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#middleresultInstallments"
                    aria-expanded="true" aria-controls="middleresultInstallments">
                    <i class="bi bi-cash-coin text-warning ml-1"></i>
                    <span>متبقي أقساط</span>
                </a>
                <div id="middleresultInstallments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="installment-remanent?s=3&i=1">القسط الأول</a>
                        <a class="collapse-item" href="installment-remanent?s=3&i=2">القسط الثاني</a>
                        <a class="collapse-item" href="installment-remanent?s=3&i=3">القسط الثالث</a>
                        <a class="collapse-item" href="installment-remanent?s=3&i=4">القسط الرابع</a>
                        <a class="collapse-item" href="installment-remanent?s=3&i=5">القسط الخامس</a>
                        <a class="collapse-item" href="installment-remanent?s=3&i=6">القسط السادس</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#middleinstallments"
                    aria-expanded="true" aria-controls="middleinstallments">
                     <i class="bi bi-patch-minus-fill text-danger ml-1"></i>
                    <span>متأخرات اقساط</span>
                </a>
                <div id="middleinstallments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="installment-arrears?s=3&i=1">القسط الأول</a>
                        <a class="collapse-item" href="installment-arrears?s=3&i=2">القسط الثاني</a>
                        <a class="collapse-item" href="installment-arrears?s=3&i=3">القسط الثالث</a>
                        <a class="collapse-item" href="installment-arrears?s=3&i=4">القسط الرابع</a>
                        <a class="collapse-item" href="installment-arrears?s=3&i=5">القسط الخامس</a>
                        <a class="collapse-item" href="installment-arrears?s=3&i=6">القسط السادس</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block mb-3">
            
            
            <!------------  Secondry Reports  -------------->

            <!-- Heading -->
            <div class="sidebar-heading">
                تقارير الثانوي
            </div>

            <li class="nav-item mb-0">
                <a class="nav-link pb-2" href="http://myschool.great-site.net/views/admin/student-information?s=4">
                    <i class="bi bi-people text-info"></i>
                    <span>قائمة تلاميذ الثانوي</span></a>
                </a>
            </li>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#secondarymoney"
                    aria-expanded="true" aria-controls="secondarymoney">
                    <i class="bi bi-coin text-success ml-1"></i>
                    <span>حسابات</span>
                </a>
                <div id="secondarymoney" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="accounts?s=4">حسابات عامة</a>
                        <a class="collapse-item" href="accounts-details?s=4">حسابات مفصلة</a>
                        <a class="collapse-item" href="installments-remanent?s=4">حسابات متبقي أقساط </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#secondaryresultInstallments"
                    aria-expanded="true" aria-controls="secondaryresultInstallments">
                    <i class="bi bi-cash-coin text-warning ml-1"></i>
                    <span>متبقي أقساط</span>
                </a>
                <div id="secondaryresultInstallments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="installment-remanent?s=4&i=1">القسط الأول</a>
                        <a class="collapse-item" href="installment-remanent?s=4&i=2">القسط الثاني</a>
                        <a class="collapse-item" href="installment-remanent?s=4&i=3">القسط الثالث</a>
                        <a class="collapse-item" href="installment-remanent?s=4&i=4">القسط الرابع</a>
                        <a class="collapse-item" href="installment-remanent?s=4&i=5">القسط الخامس</a>
                        <a class="collapse-item" href="installment-remanent?s=4&i=6">القسط السادس</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#secondaryinstallments"
                    aria-expanded="true" aria-controls="secondaryinstallments">
                    <i class="bi bi-patch-minus-fill text-danger ml-1"></i>
                    <span>متأخرات اقساط</span>
                </a>
                <div id="secondaryinstallments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="installment-arrears?s=4&i=1">القسط الأول</a>
                        <a class="collapse-item" href="installment-arrears?s=4&i=2">القسط الثاني</a>
                        <a class="collapse-item" href="installment-arrears?s=4&i=3">القسط الثالث</a>
                        <a class="collapse-item" href="installment-arrears?s=4&i=4">القسط الرابع</a>
                        <a class="collapse-item" href="installment-arrears?s=4&i=5">القسط الخامس</a>
                        <a class="collapse-item" href="installment-arrears?s=4&i=6">القسط السادس</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block mb-0">


            <!-- Nav Item - Utilities Collapse Menu -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#middleinvoices"
                    aria-expanded="true" aria-controls="middleinvoices">
                    <i class="bi bi-files-alt text-success mx-1"></i>
                    <span>ايصالات و فواتير</span>
                </a>
                <div id="middleinvoices" class="collapse" aria-labelledby="ايصالات"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="invoices">قائمة الايصالات</a>
                        <a class="collapse-item" href="create-invoice">استخراج ايصال</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block mb-0">
            <!------------  Secondry Reports  -------------->
        
            <?php if(Session::has('superadmin')) :?>
            <!-- Nav Item -->
            <li class="nav-item mb-1">
                <a class="nav-link" href="http://myschool.great-site.net/views/admin/settings">
                    <i class="bi bi-gear-wide-connected text-light mx-1"></i>
                    <span>اعدادات البرنامج</span></a>
                </a>
            </li>
            <?php endif;?>


            <!-- Divider -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-3">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->