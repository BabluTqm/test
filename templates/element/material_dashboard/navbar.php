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
                    <?php
                    if ($result->own_status == 0) {
                        echo '<span class="m-r-sm text-muted welcome-message">Unavailable for Lead</span>';
                    } else {
                        echo '<span class="m-r-sm text-muted welcome-message">Available for accept Lead</span>';
                    } ?>
                </li>
                <li>
                    <input type="hidden" value="<?= $result->id; ?>" id="idd">
                    <input type="hidden" value="<?= $result->own_status; ?>" id="own-id">
                    <?php

                    if ($result->own_status == 0) {
                    ?>
                        <a href="javascript:void(0)" id="toggle-enable"><i class="fa fa-toggle-off" style="font-size:26px;"></i></a>
                    <?php } else if ($result->own_status == 1 && $result->user_type == 4) { ?>
                        <a href="javascript:void(0)" id="toggle-enable"><i class="fa fa-toggle-on" style="font-size:26px;color:#28bf27;"></i></a>
                    <?php } ?>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i> <span class="label label-primary">9</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">

                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> No message here
                                </div>
                            </a>
                        </li>

                        <li>
                        </li>
                        <li class="divider"></li>
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
    <div class="sk-spinner sk-spinner-wave hide-spin">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#toggle-enable').on('click', function() {
                id = $('#idd').val();
                own_status = $('#own-id').val();
                swal({
                    title: "Are you sure?",
                    text: "You want to change your Account status!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $(".hide-spin").show();
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            url: "/materialProvider/mpStatus/" + id + "/ " + own_status,
                            data: {
                                id: id,
                                own_status: own_status
                            },
                            type: "JSON",
                            method: "post",
                            success: function(response) {
                                var data = JSON.parse(response);
                                if (data["status"] == 0) {
                                    // alert(data["message"]);
                                    swal("Error!", "Account status not updated!", "error");
                                } else {
                                    $(".hide-spin").show();
                                    swal(
                                        "Updated!",
                                        "Account status Has been changed!",
                                        "success"
                                    ).then(function() {
                                        window.location.href =
                                            "/materialProvider/assignedProjectList";
                                    });
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>