<div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Assign Project </h5>
                    <div class="ibox-tools">
                        <?php echo $this->Html->link(__('Back'), ['controller' => 'projects', 'prefix' => 'Admin', 'action' => 'assignProject'], ['class' => 'btn btn-success']); ?>

                    </div>
                </div>
                <div class="ibox-content">
                    <?php echo $this->Form->create($project, ['id' => 'assign-form']); ?>
                    <div class="row">
                        <div class="col-md-3"></div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">Project Name</div>
                                <div class="col-md-6">
                                    <?php echo  $this->Form->control('project_name', ['class' => 'text-form', 'label' => false]); ?>
                                    <?php echo  $this->Form->input('id', ['class' => 'text-form', 'type' => 'hidden', 'id' => 'idd', 'label' => false, 'readonly' => true]); ?>
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

    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Assigned Contractor </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>

                                    <th class="text-uppercase">Contractor Name</th>
                                    <th class="text-uppercase">Contractor Email </th>
                                    <th class="text-uppercase">Contractor Address </th>
                                    <th class="text-uppercase">Contractor Phone </th>
                                    <th class="text-uppercase">Contractor Type </th>
                                    <th class="text-uppercase">Contractor Company</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($assignuser as $assign) { ?>
                                    <tr>
                                        <td><?php echo $assign->user->user_profile->first_name; ?></td>
                                        <td><?php echo $assign->user->email; ?> </td>
                                        <td><?php echo $assign->user->user_profile->address1; ?></td>
                                        <td><?php echo $assign->user->user_profile->phone; ?></td>
                                        <td>
                                            <?php
                                            if ($assign->user->user_type == 2) {
                                                echo "General Contractor";
                                            } else {
                                                echo "Sub-Contractor";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $assign->user->user_profile->company_name; ?> </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>


</div>