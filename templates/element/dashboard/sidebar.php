<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/img/profile_small.jpg" />
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        <?php echo $admin->user_profile->first_name . ' ' . $admin->user_profile->last_name; ?>
                                    </strong>
                                </span>
                                <span class="text-muted text-xs block">
                                    <?php
                                    if ($admin->user_type == 0) {
                                        echo 'Admin';
                                    } else if ($admin->user_type == 1) {
                                        echo 'Owner';
                                    } else if ($admin->user_type == 2) {
                                        echo 'General Manager';
                                    } else {
                                        echo 'Sub Manager';
                                    }
                                    ?>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li>
                    <a href="/admin/users/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
                </li>
                <li>
                    <a href="/admin/users/ownerManagement"><i class="fa fa-users"></i> <span class="nav-label">Owner Management</span> </a>
                </li>
                <li>
                    <a href="/admin/contractor/generalListing"><i class="fa fa-user "></i> <span class="nav-label">GC Management</span></a>
                </li>
                <li>
                    <a href="/admin/contractor/subListing"><i class="fa fa-user opacity-10"></i> <span class="nav-label">SC Management</span></a>
                </li>
                <li>
                    <a href="/admin/contractor/mpListing"><i class="fa fa-user opacity-10"></i> <span class="nav-label">MP Management</span></a>
                </li>
                <li>
                    <a href="/admin/services/serviceManagment"><i class="fa fa-wrench opacity-10"></i> <span class="nav-label">Services Managment</span></a>
                </li>
                <li>
                    <a href="/admin/products/productManagement"><i class="fa fa-product-hunt"></i> <span class="nav-label">Products Managment</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-server"></i> <span class="nav-label">Projects Management</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="/admin/projects/assignProject"><i class="fa fa-check"></i> <span class="nav-label">Assign Projects</span></a>
                        </li>
                        <li>
                            <a href="/admin/projects/unAssignProject"><i class="fa fa-square"></i> <span class="nav-label">Unassign Projects</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bank"></i> <span class="nav-label">Credits Management</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="/admin/contractor_credit/setCredit"><i class="fa fa-dollar"></i> <span class="nav-label">Set Credits</span></a>
                        </li>
                        <li>
                            <a href="/admin/contractor_credit/assignCredit"><i class="fa fa-balance-scale"></i> <span class="nav-label">Assign Credits</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="/admin/users/logout"><i class="fa fa-sign-out opacity-10"></i> <span class="nav-label">Logout</span></a>
                </li>
            </ul>

        </div>
    </nav>