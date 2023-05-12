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
                                        <?php echo $result->user_profile->first_name . ' ' . $result->user_profile->last_name; ?>
                                    </strong>
                                </span>
                                <span class="text-muted text-xs block">
                                    <?php
                                    if ($result->user_type == 0) {
                                        echo 'Admin';
                                    } else if ($result->user_type == 1) {
                                        echo 'Owner';
                                    } else if ($result->user_type == 2) {
                                        echo 'General Contractor';
                                    } else {
                                        echo 'Sub Contractors';
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
                    <a href="/Contractors/assignedProjectList"><i class="fa fa-th-large"></i> <span class="nav-label">Assigned Project List</span> </a>
                </li>
                <li>
                    <a href="/Contractors/purchagedProjectList"><i class="fa fa-users"></i> <span class="nav-label">Purchased Project List</span> </a>
                </li>

                <!--  -->
                <li>
                    <a href="#"><i class="fa fa-dollar"></i> <span class="nav-label">Credit Managment</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="/Contractors/totalCredit"><i class="fa fa-inr"></i> <span class="nav-label">Total Credit</span></a>
                        </li>
                        <li>
                            <a href="/Contractors/purchasedCredit"><i class="fa fa-cc-visa"></i> <span class="nav-label">Purchased credit</span></a>
                        </li>
                    </ul>
                </li>
                <!--  -->
                <li>
                    <a href="/Contractors/gcscProfile"><i class="fa fa-user "></i> <span class="nav-label">Profile</span></a>
                </li>
                <li>
                    <a href="/users/logout"><i class="fa fa-sign-out opacity-10"></i> <span class="nav-label">Logout</span></a>
                </li>
            </ul>

        </div>
    </nav>