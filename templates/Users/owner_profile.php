<?php
if (empty($owner->user_profile->phone && $owner->user_profile->address1 && $owner->user_profile->state && $owner->user_profile->city && $owner->user_profile->pincode) || $owner->complete_status == 0) {
?>

    <div class="wrapper wrapper-content">

        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Update Profile Information </h5>
                        <div class="ibox-tools">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create($owner, ['id' => 'owner-update']) ?>
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.first_name', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3">Last Name<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.last_name', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mt-3">Email<span class="err">*</span></label>
                                        <?php echo $this->Form->control('email', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3">Phone<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.phone', ['required' => false, 'class' => 'form-control ', 'label' => false]) ?>
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
                                    <div class="col-md-6">
                                        <label class="mt-3">Address 1<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.address1', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Address2</label>
                                        <?php echo $this->Form->control('user_profile.address2', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mt-3">City<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.city', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3">State<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.state', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mt-3">Pincode<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.pincode', ['type' => 'text', 'required' => false, 'class' => 'form-control', 'label' => false]) ?>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?= $this->Form->button(__('Save'), ['action' => 'edit', 'class' => 'btn btn-primary']) ?>
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


    </div>

<?php } else { ?>

    <div class="wrapper wrapper-content">

        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile Information </h5>
                        <div class="ibox-tools">
                            <?php echo $this->Html->link(__(''), ['controller' => 'users', 'action' => 'edit-profile', $owner->id], ['class' => 'btn btn-primary fa fa-edit']) ?>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create($owner) ?>
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.first_name', ['required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.last_name', ['required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email<span class="err">*</span></label>
                                        <?php echo $this->Form->control('email', ['required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.phone', ['required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Address 1<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.address1', ['required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Address2</label>
                                        <?php echo $this->Form->control('user_profile.address2', ['required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>City<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.city', ['required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>State<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.state', ['required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Pincode<span class="err">*</span></label>
                                        <?php echo $this->Form->control('user_profile.pincode', ['type' => 'text', 'required' => false, 'class' => 'form-control mb-3', 'label' => false, 'disabled' => true]) ?>
                                    </div>
                                    <div class="col-md-6">

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


    </div>
<?php } ?>