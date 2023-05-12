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
                    <a href="/users/owner-profile"><i class="fa fa-th-large"></i> <span class="nav-label">My Profile</span> </a>
                </li>
                <li>
                    <a href="/projects/requested-project-list"><i class="fa fa-users"></i> <span class="nav-label">Requested Project List</span> </a>
                </li>
                <li>
                    <a href="/projects/request-new-project"><i class="fa fa-user "></i> <span class="nav-label">Request New Project</span></a>
                </li>
                <li>
                    <a href="/users/logout"><i class="fa fa-sign-out opacity-10"></i> <span class="nav-label">Logout</span></a>
                </li>
            </ul>

        </div>
    </nav>