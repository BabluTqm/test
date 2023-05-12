<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Update General Contractor Details </h5>
          <div class="ibox-tools">
            <?php echo $this->Html->link(__('Back'), ['controller' => 'Contractor', 'prefix' => 'Admin', 'action' => 'generalListing'], ['class' => 'btn btn-success', 'style' => 'margin-left: 1136px;']); ?>
          </div>
        </div>
        <div class="ibox-content">
          <?php echo $this->Form->create($user, ['id' => 'gc-form']); ?>
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
                  <?php echo  $this->Form->control('user_profile.first_name', ['class' => 'text-form', 'label' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Last Name</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.last_name', ['class' => 'text-form', 'label' => false]); ?>
                  <?php echo  $this->Form->input('id', ['class' => 'text-form', 'type' => 'hidden', 'id' => 'idd', 'label' => false, 'readonly' => true]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Email</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('email', ['class' => 'text-form', 'label' => false, 'readonly' => true]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Phone no</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.phone', ['type' => 'phone', 'class' => 'text-form', 'label' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Address 1</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.address1', ['class' => 'text-form', 'label' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Address 2</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.address2', ['class' => 'text-form', 'label' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">State</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.state', ['class' => 'text-form', 'label' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">City</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.city', ['class' => 'text-form', 'label' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Pincode</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.pincode', ['class' => 'text-form', 'label' => false, 'type' => 'text']); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Company Name</div>
                <div class="col-md-6">
                  <?php echo  $this->Form->control('user_profile.company_name', ['class' => 'text-form', 'label' => false]); ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <h4>Provided Services</h4>
                </div>
                <div class="col-md-6">
                  <?php $count = 1;
                  foreach ($services as $service) { ?>
                    <?php if (!empty($service->user_services)) { ?>
                      <input type="hidden" name="" id="user" value="<?php echo $user->id; ?>">
                      <input class="checkit" type="checkbox" name="user_services[][service_id]" value="<?php echo $service->id ?>" checked>
                      <label for="" style="margin-left:1px;"> <?php echo $service->service ?></label>
                    <?php } else { ?>
                      <input class="checkit" type="checkbox" name="user_services[][service_id]" value="<?php echo $service->id ?>">
                      <label for="" style="margin-left:1px;"> <?php echo $service->service ?></label>
                  <?php }
                  } ?>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function() {
    if ($('#gc').val() == 2) {
      $(".allcheck").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
      });
    }
  });
</script>