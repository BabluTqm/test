<!-- modal for contractor services -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Provided Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Service Name</th>
                        </tr>
                    </thead>
                    <tbody id="show">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div id="table-hide ">
        <div class="row approve-request">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Project View</h5>
                        <div class="ibox-tools card-header ">
                            <?php if ($project->accept_status == 1) { ?>
                                <?php echo $this->Html->link(__('Accepted'), ['controller' => 'Projects', 'prefix' => 'Admin', 'action' => 'accectOwnerProject', $project->id], ['class' => 'float-end accept btn btn-success me-5']) ?>
                            <?php } else { ?>
                                <a href="javascript:void(0)" class="btn btn-success me-5 accept-request" data-id="<?= $project->id ?>">Accept Project</a>
                            <?php } ?>
                            <?php echo $this->Html->link(__('Back'), ['controller' => 'projects', 'prefix' => 'Admin', 'action' => 'unAssignProject'], ['class' => 'btn btn-success']); ?>

                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create($project, ['id' => 'update-unassign-project']); ?>
                        <?php echo  $this->Form->input('id', ['class' => 'text-form', 'type' => 'hidden', 'id' => 'idd', 'label' => false, 'readonly' => true]); ?>
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">Project Name</div>
                                    <div class="col-md-6">
                                        <?php echo  $this->Form->control('project_name', ['class' => 'text-form', 'label' => false]); ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">First Name</div>
                                    <div class="col-md-6">
                                        <?php echo  $this->Form->control('user_profile.first_name', ['class' => 'text-form', 'label' => false]); ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">State</div>
                                    <div class="col-md-6">
                                        <?php echo  $this->Form->control('state', ['type' => 'phone', 'class' => 'text-form', 'label' => false]); ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">City</div>
                                    <div class="col-md-6">
                                        <?php echo  $this->Form->control('city', ['class' => 'text-form', 'label' => false]); ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Project Address 1</div>
                                    <div class="col-md-6">
                                        <?php echo  $this->Form->control('project_address1', ['class' => 'text-form', 'label' => false]); ?>
                                    </div>
                                </div>
                                <div class="sk-spinner sk-spinner-wave hide-spin">
                                    <div class="sk-rect1"></div>
                                    <div class="sk-rect2"></div>
                                    <div class="sk-rect3"></div>
                                    <div class="sk-rect4"></div>
                                    <div class="sk-rect5"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Project Address 2</div>
                                    <div class="col-md-6">
                                        <?php echo  $this->Form->control('project_address2', ['class' => 'text-form', 'label' => false]); ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Pincode</div>
                                    <div class="col-md-6">
                                        <?php echo  $this->Form->control('pincode', ['class' => 'text-form', 'type' => 'text', 'label' => false]); ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">Property Type *</div>
                                    <div class="col-md-6">
                                        <select name="property_type" id="" class="form-control m-b" style="width:48%">
                                            <option value="" selected disabled>Select one</option>
                                            <?php if ($project->property_type == 1) { ?>
                                                <option value="1" selected>New Construction</option>
                                                <option value="2">Addition</option>
                                            <?php } else if ($project->property_type == 2) { ?>
                                                <option value="1">New Construction</option>
                                                <option value="2" selected>Addition</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php echo $this->Form->submit(__('Update'), ['class' => 'btn btn-primary']); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3"></div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Services Required By Owner</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <?php $count = 0; ?>
                                        <?php foreach ($owner_services as $service) : ?>
                                            <td><?php echo '<b>' . ++$count . '</b>' . "." . $service->service->service ?></td>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12 approve-sc">
                <div class="ibox float-e-margins">
                    <?php echo $this->Form->create(null, ['id' => 'assigned-form']) ?>
                    <div class="ibox-title">
                        <h5>
                            Asked
                            <?php if ($project->contractor == 2) {
                                echo "General Contractor";
                            } else {
                                echo "Sub-Contractor";
                            }  ?>
                            By Owner
                        </h5>
                        <div class="ibox-tools">

                            <input type="hidden" name="owner_user_id" id="owner_user_id" value="<?php echo $project->user_id ?>">
                            <input type="hidden" name="project_id" id="project_id" value="<?php echo $project->id ?>">
                            <input type="hidden" name="owner_email" id="owner_email" value="<?php echo $project->user->email ?>">
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th class="text-uppercase">Sr No</th>
                                        <th class="text-uppercase">Assign</th>
                                        <th class="text-uppercase">Name </th>
                                        <th class="text-uppercase">Email </th>
                                        <th class="text-uppercase">Contact </th>
                                        <th class="text-uppercase">Address </th>
                                        <th class="text-uppercase">Company</th>
                                        <th class="text-uppercase">View</th>
                                        <th class="text-uppercase">Debit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    if (count($users) != 0) {
                                        foreach ($users as $user) {
                                            if ($user->user->own_status == 0) {
                                                continue;
                                            }
                                            if (!in_array($user['user_id'], $already_assigned_users)) {
                                    ?>
                                                <tr id="<?php echo $user->user_id ?>" class="ctr">
                                                    <td><?php echo ++$count; ?></td>
                                                    <td>
                                                        <input id="checkid" class="checkid" type="checkbox" name="user_id[]" value="<?php echo $user->user_id ?>">
                                                    </td>
                                                    <td><?php echo $user->user->user_profile->first_name . " " . $user->user->user_profile->last_name; ?> </td>
                                                    <td><?php echo $user->user->email; ?></td>
                                                    <td><?php echo $user->user->user_profile->phone; ?></td>
                                                    <td><?php echo $user->user->user_profile->address1; ?></td>
                                                    <td><?php echo $user->user->user_profile->company_name; ?></td>
                                                    <td>
                                                        <?php echo $this->Html->link(__(''), [], ['class' => 'fa fa-eye  mx-3 view', 'data-id' => $user->user->id]); ?>
                                                    </td>
                                                    <td>
                                                        <input id="" class="credit" type="text" name="credit[]" value="<?php echo $credit->credit ?>">
                                                    </td>
                                                </tr>

                                        <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <tr class="text-center">
                                            <td colspan="9">
                                                <h4>No Results To Show</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-12">
                            <?php
                            if ($project->accept_status == 1) {
                                echo $this->Form->submit(__('Assign'), ['class' => 'btn btn-primary']);
                            } ?>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>

        <!---Material Side--->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <?php echo $this->Form->create(null, ['id' => 'assigned-form']) ?>
                    <div class="ibox-title">
                        <h5>Material Provider</h5>
                        <div class="ibox-tools">
                            <input type="hidden" name="owner_user_id" id="owner_user_id" value="<?php echo $project->user_id ?>">
                            <input type="hidden" name="project_id" id="project_id" value="<?php echo $project->id ?>">
                            <input type="hidden" name="owner_email" id="owner_email" value="<?php echo $project->user->email ?>">
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th class="text-uppercase">Sr No</th>
                                        <th class="text-uppercase">Assign</th>
                                        <th class="text-uppercase">Name </th>
                                        <th class="text-uppercase">Email </th>
                                        <th class="text-uppercase">Contact </th>
                                        <th class="text-uppercase">Address </th>
                                        <th class="text-uppercase">Company</th>
                                        <th class="text-uppercase">View</th>
                                        <th class="text-uppercase">Debit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    if (count($mp) != 0) {
                                        foreach ($mp as $user) {
                                            if ($user->user->own_status == 0) {
                                                continue;
                                            }
                                            if (!in_array($user['user_id'], $already_assigned_users)) {
                                    ?>
                                                <tr id="<?php echo $user->user_id ?>" class="ctr">
                                                    <td><?php echo ++$count; ?></td>
                                                    <td>
                                                        <input id="checkid" class="checkid" type="checkbox" name="user_id[]" value="<?php echo $user->user_id ?>">
                                                    </td>
                                                    <td><?php echo $user->user->user_profile->first_name . " " . $user->user->user_profile->last_name; ?> </td>
                                                    <td><?php echo $user->user->email; ?></td>
                                                    <td><?php echo $user->user->user_profile->phone; ?></td>
                                                    <td><?php echo $user->user->user_profile->address1; ?></td>
                                                    <td><?php echo $user->user->user_profile->company_name; ?></td>
                                                    <td>
                                                        <?php echo $this->Html->link(__(''), [], ['class' => 'fa fa-eye  mx-3 product-view', 'data-id' => $user->user->id]); ?>
                                                    </td>
                                                    <td>
                                                        <input id="" class="credit" type="text" name="credit[]" value="<?php echo $credit->mp_credit ?>">
                                                    </td>
                                                </tr>

                                        <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <tr class="text-center">
                                            <td colspan="9">
                                                <h4>No Results To Show</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <?php
                            if ($project->accept_status == 1) {
                                echo $this->Form->submit(__('Assign'), ['class' => 'btn btn-primary']);
                            } ?>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <!---End Material Side--->

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        <h5>
                            Already Assigned
                            <?php
                            if ($project->contractor == 2) {
                                echo "General Contractors";
                            } else {
                                echo "Sub-Contractors";
                            }
                            ?>
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create(null, ['id' => 'assigned-form']) ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase">Sr No</th>
                                        <th class="text-uppercase">First Name </th>
                                        <th class="text-uppercase">Last Name </th>
                                        <th class="text-uppercase">Email </th>
                                        <th class="text-uppercase">Contact </th>
                                        <th class="text-uppercase">Address</th>
                                        <th class="text-uppercase">Company</th>
                                        <th class="text-uppercase">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 0; ?>
                                    <?php
                                    if (count($assignuser) != 0) {
                                        foreach ($assignuser as $assign) {

                                            foreach ($allusers as $alluser) {

                                                if ($assign->user_id == $alluser->id) { ?>
                                                    <tr>
                                                        <td><?php echo ++$count; ?></td>
                                                        <td><?php echo $alluser->user_profile->first_name; ?> </td>
                                                        <td><?php echo $alluser->user_profile->last_name; ?></td>
                                                        <td><?php echo $alluser->email ?></td>
                                                        <td><?php echo $alluser->user_profile->phone; ?></td>
                                                        <td><?php echo $alluser->user_profile->address1; ?></td>
                                                        <td><?php echo $alluser->user_profile->company_name; ?></td>
                                                        <td>
                                                            <?php echo $this->Html->link(__(''), [], ['class' => 'fa fa-eye  mx-3 view', 'data-id' => $alluser->id]); ?>
                                                        </td>
                                                    </tr>

                                        <?php
                                                }
                                            }
                                        }
                                    } else {
                                        ?>
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h4>No Results To Show</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="loader_assign"></div>
</div>

<!--Modal For Product View--->
<div class="modal fade" id="mp">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Provided Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                        </tr>
                    </thead>
                    <tbody id="proshow">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!---End Modal Product-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {

        $('.accept').on('click', function(e) {
            e.preventDefault();
            $('#load').on('click', function() {
                $('#loader').css({
                    'position': 'fixed',
                    'left': '0px',
                    'top': '0px',
                    'opacity': '0.6',
                    'width': '100%',
                    'height': '100%',
                    'z-index': '9999',
                    'background': 'url("https://media.tenor.com/d0LM2F1ze8kAAAAC/smartparcel-mail.gif") 50% 50% no-repeat rgb(249,249,249)'
                });
            });

            function load() {
                $('#loader').css({
                    'position': 'fixed',
                    'left': '0px',
                    'top': '0px',
                    'opacity': '0.6',
                    'width': '100%',
                    'height': '100%',
                    'z-index': '9999',
                    'background': 'url("https://media.tenor.com/d0LM2F1ze8kAAAAC/smartparcel-mail.gif") 50% 50% no-repeat rgb(249,249,249)'
                });
            }
        })
    });
</script>