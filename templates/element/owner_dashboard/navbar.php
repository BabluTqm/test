<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <form role="search" class="navbar-form-custom" action="search_results.html">
                    <div class="form-group">
                        <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                    </div>
                </form>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Construction Management And Lead Management</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i> <span class="label label-primary"><?php echo $notifications1->count();  ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts owner-notify">
                        <?php
                        if ($notifications1->count() == 0) {
                        ?>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> No message here
                                    </div>
                                </a>
                            </li>
                        <?php
                        }
                        foreach ($notifications1 as $notify) :
                        ?>
                            <li>
                                <a href="/users/readNotification/<?= $notify->id ?>" class="read" data-id="<?= $notify->id ?>">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> <?= $notify->message; ?>
                                        <?php

                                        $timestamp = strtotime($notify->created_date);

                                        $strTime = array("second", "minute", "hour", "day", "month");
                                        $length = array("60", "60", "24", "30", "12");

                                        $currentTime = time();
                                        if ($currentTime >= $timestamp) {
                                            $diff     = time() - $timestamp;
                                            for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                                                $diff = $diff / $length[$i];
                                            }

                                            $diff = round($diff);
                                            $time = $diff . " " . $strTime[$i] . "(s) ago ";
                                        }

                                        ?>
                                        <span class="pull-right text-success small msg"><?= $time ?></span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                        <?php
                        endforeach; ?>
                    </ul>
                </li>
                <!-- <li>
                    <a href="/users/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li> -->
            </ul>

        </nav>
    </div>