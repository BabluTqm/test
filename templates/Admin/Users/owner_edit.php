<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins update-owner">
        <div class="ibox-title">
          <h5>Update Owner Details </h5>
          <div class="ibox-tools">
            <?php echo $this->Html->link(__('Back'), ['controller' => 'Users', 'prefix' => 'Admin', 'action' => 'ownerManagement'], ['class' => 'btn btn-success text-white']); ?>
          </div>
        </div>
        <div class="ibox-content">
          <?php echo $this->Form->create($user, ['id' => 'admin-form']); ?>
          <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
              <div class="sk-spinner sk-spinner-wave hide-spin">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
              </div>
              <div class="row">
                <div class="col-md-6">First Name</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.first_name', ['class' => 'text-form', 'label' => false, 'required' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Last Name</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.last_name', ['class' => 'text-form', 'label' => false, 'required' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Email</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('email', ['class' => 'text-form', 'label' => false, 'readonly' => true]); ?>
                  <?php echo  $this->Form->input('id', ['class' => 'text-form', 'type' => 'hidden', 'id' => 'idd', 'label' => false, 'readonly' => true]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Phone no</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.phone', ['type' => 'phone', 'class' => 'text-form', 'label' => false, 'required' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Address 1</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.address1', ['class' => 'text-form', 'label' => false, 'required' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Address 2</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.address2', ['class' => 'text-form', 'label' => false, 'required' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">State</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.state', ['class' => 'text-form', 'label' => false, 'required' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">City</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.city', ['class' => 'text-form', 'label' => false, 'required' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Pincode</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.pincode', ['class' => 'text-form', 'label' => false, 'type' => 'text', 'required' => false]); ?>
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


</div>