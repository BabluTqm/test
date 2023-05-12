<!-- modal open  -->
<div class="modal fade" id="add-credit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Credit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">
                <h5 class=''>Total: <span><b id='total-credit'>hghghg</b> $</span></h5>
                <?php echo $this->Form->create(null, ['id' => 'modal-form']) ?>
                <fieldset>
                    <?php
                    //echo $this->Form->input('id', ['type'=>'text','id' => 'credit-id', 'class' => '']);
                    echo $this->Form->input('user_id', ['type' => 'hidden', 'id' => 'user-id', 'class' => '']);
                    echo $this->Form->input('total_credit', ['id' => 'credit', 'class' => 'form-control p-2', 'style' => 'border:1px solid black']);
                    ?>
                    <span class="credit-error" id="credit-error"></span>
                </fieldset>
                <br>
                <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary mt-3 mb-0 add_credits']) ?>
                <?php echo $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->


<div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Assign Credits </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content tabbedPanels">
                    <div class="row">
                        <div class="col-sm-9 m-b-xs">
                            <ul class="tabs change-panel" style="list-style-type: none;">
                                <li><a class="p1 btn btn-primary" href="#panel1">General Contractor Credit</a></li>
                                <li><a class="p2 btn btn-primary" href="#panel2">Sub Contractor Credit</a></li>&nbsp;
                                <li><a class="p3 btn btn-primary" href="#panel3">Material Provider</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                        </div>
                    </div>
                    <div class="panelContainer">
                        <div id="panel1" class="panel">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>SR NO.</th>
                                            <th>NAME </th>
                                            <th>EMAIL </th>
                                            <th>CONTACT </th>
                                            <th>ADDRESS </th>
                                            <th>COMPANY </th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        <?php

                                        foreach ($gc_credit as $gc_user) {

                                        ?>
                                            <tr id="<?php echo $gc_user->user_id ?>">
                                                <td><?php echo ++$count; ?></td>
                                                <td><?php echo $gc_user->user->user_profile->first_name . ' ' . $gc_user->user->user_profile->last_name; ?> </td>
                                                <td><?php echo $gc_user->user->email; ?></td>
                                                <td><?php echo $gc_user->user->user_profile->phone; ?></td>
                                                <td><?php echo $gc_user->user->user_profile->address1; ?></td>
                                                <td><?php echo $gc_user->user->user_profile->company_name; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary gc-credit" data-toggle="modal" data-target="#add-credit" data-id="<?php echo $gc_user->user_id ?>">
                                                        Add credit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="panel2" class="panel">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table2">
                                    <thead>
                                        <tr>
                                            <th>SR NO.</th>
                                            <th>NAME </th>
                                            <th>EMAIL </th>
                                            <th>CONTACT </th>
                                            <th>ADDRESS </th>
                                            <th>COMPANY </th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        <?php
                                        foreach ($sc_credit as $sc_user) {
                                        ?>
                                            <tr id="<?php echo $sc_user->user_id ?>">
                                                <td><?php echo ++$count; ?></td>
                                                <td><?php echo $sc_user->user->user_profile->first_name . ' ' . $sc_user->user->user_profile->last_name; ?> </td>
                                                <td><?php echo $sc_user->user->email; ?></td>
                                                <td><?php echo $sc_user->user->user_profile->phone; ?></td>
                                                <td><?php echo $sc_user->user->user_profile->address1; ?></td>
                                                <td><?php echo $sc_user->user->user_profile->company_name; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary gc-credit" data-toggle="modal" data-target="#add-credit" data-id="<?php echo $sc_user->user_id ?>">
                                                        Add Credit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--Mp Panel-->
                        <div id="panel3" class="panel">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table3">
                                    <thead>
                                        <tr>
                                            <th>SR NO.</th>
                                            <th>NAME </th>
                                            <th>EMAIL </th>
                                            <th>CONTACT </th>
                                            <th>ADDRESS </th>
                                            <th>COMPANY </th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        <?php

                                        foreach ($mp_credit as $mp_user) {

                                        ?>
                                            <tr id="<?php echo $mp_user->user_id ?>">
                                                <td><?php echo ++$count; ?></td>
                                                <td><?php echo $mp_user->user->user_profile->first_name . ' ' . $mp_user->user->user_profile->last_name; ?> </td>
                                                <td><?php echo $mp_user->user->email; ?></td>
                                                <td><?php echo $mp_user->user->user_profile->phone; ?></td>
                                                <td><?php echo $mp_user->user->user_profile->address1; ?></td>
                                                <td><?php echo $mp_user->user->user_profile->company_name; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary gc-credit" data-toggle="modal" data-target="#add-credit" data-id="<?php echo $mp_user->user_id ?>">
                                                        Add credit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--End Mp Panel-->
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var csrfToken = $('meta[name="csrfToken"]').attr('content');
    $('.gc-credit').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/ContractorCredit/getGcCredit',
            type: 'JSON',
            method: 'get',
            data: {
                'id': id
            },
            success: function(response) {
                var data = JSON.parse(response);
                // console.log(data);
                // return false;
                if (data['status'] == 1) {

                    $('#add-credit').modal('show');
                    //    $('#credit-id').val(data['data']['id']);
                    $('#user-id').val(data['data']['user_id']);
                    $('#total-credit').text(data['data']['total_credit']);
                    $('#table-hide').load('/admin/services/serviceManagment #table-hide');
                } else {
                    $('#add-credit').modal('show');
                    $('#user-id').val(data['data']);
                    $('#total-credit').text(0);
                }

            }
        })
        return false;
    });
    $('.add_credits').on('click', function(e) {
        e.preventDefault();
        var data = $('#modal-form').serialize();
        // alert(data);return false;
        var credit = $('#credit').val();
        if (credit != '') {
            if (!$.trim(credit)) {
                $('#credit-error').text('space not allowed').css('color', 'red');
            } else {
                // alert(data);return false;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: '/admin/ContractorCredit/addCredits',
                    type: 'JSON',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if (response == 1) {
                            $('#modal-form').modal('hide');
                            swal(
                                "credit assigned successfully!",
                                "success!",
                                "success"
                            ).then(function() {

                                window.location.href = "/admin/ContractorCredit/assignCredit";
                            });
                        }

                    }
                });
            }
        } else {
            $('#credit-error').text('Please Credit field requiret').css('color', 'red');
        }
        return false;
    });
</script>


<script>
    //TWO TABLE SHOW
    $('.tabs a').click(function() {
        $('.panel').hide();
        $('.tabs a .p1 .active').removeClass('active');
        $('.tabs a .p1').addClass('active');

        var panel = $(this).attr('href');
        $(panel).fadeIn(1000);

        return false;
    });
    $('.tabs li:first a').click();
</script>