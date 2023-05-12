<div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        <?php
                        if ($auth->user_type == 2) {
                            echo "<div id = 'gc'>General Contractor Profile Information<div>";
                        } else {
                            echo "<div id = 'sc'>Sub-Contractor Profile Information <div>";
                        }
                        ?>
                    </h5>
                    <div class="ibox-tools">
                        <?php echo $this->Html->link(__(''), ['controller' => 'contractors', 'action' => 'editProfile', $gcsc->id], ['class' => 'btn btn-primary fa fa-edit']) ?>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php echo $this->Form->create($gcsc, ['id' => 'gcsc-form']) ?>
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
                                    <label>Company Name<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.company_name', ['required' => false, 'class' => 'form-control ', 'label' => false, 'disabled' => 'true']) ?>
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
                                    <h4>Services </h4>
                                </div>
                                <div class="col-md-6">
                                    <?php $count = 0;
                                    foreach ($userservices as $service) : ?>
                                        <label for="" style="margin-left:1px;"> <?php echo ++$count . "." . $service->service->service ?></label>
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

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $(".allcheck").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>