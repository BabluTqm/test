<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>
            <?php
            if ($auth->user_type == 2) {
              echo "General Contractor Profile Information";
            } else {
              echo "Sub Contractor Profile Information";
            }
            ?>
          </h5>
          <div class="ibox-tools">
            <input type="hidden" name="" id="gcsc" value="<?php echo $auth->user_type ?>">
          </div>
        </div>
        <div class="ibox-content">
          <?php echo $this->Form->create($users, ['id' => 'gcsc-form']) ?>
          <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <label>First Name<span class="err">*</span></label>
                  <?php echo $this->Form->control('user_profile.first_name', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                  <?php echo $this->Form->input('id', ['required' => false, 'class' => 'form-control', 'label' => false, 'id' => 'idd', 'type' => 'hidden']) ?>
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
                <div class="col-md-6">
                  <label class="mt-3">Company Name<span class="err">*</span></label>
                  <?php echo $this->Form->control('user_profile.company_name', ['type' => 'text', 'required' => false, 'class' => 'form-control', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <label class="mt-3">Services<span class="err">*</span></label>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <?php if ($auth->user_type == 2) { ?>
                        <input class="allcheck" type="checkbox" value="">
                        <label for="">All</label>
                      <?php } ?>
                    </div>
                    <div class="col-md-12">
                      <?php
                      foreach ($services as $service) { 
                        ?>

                        <?php if (!empty($service->user_services)) { ?>
                          <input type="hidden" name="" id="user_id" value="<?php echo $result->id; ?>">
                          <input class="contractor" type="checkbox" name="user_services[][service_id]" value="<?php echo $service->id ?>" checked>
                          <label for="" style="margin-left:1px;"> <?php echo $service->service ?></label>
                        <?php } else { ?>
                          <input type="hidden" name="" id="user_id" value="<?php echo $result->id; ?>">
                          <input class="contractor" type="checkbox" name="user_services[][service_id]" value="<?php echo $service->id ?>">
                          <label for="" style="margin-left:1px;"> <?php echo $service->service ?></label>
                      <?php }
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12 text-center">
                  <?= $this->Form->button(__('Update'), ['class' => 'btn btn-primary']) ?>
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

    if ($('#gcsc').val() == 2) {
      $(".allcheck").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
      });
    }
    if ($('#gcsc').val() == 3) {
      $("input[type='checkbox']").change(function() {
        var maxAllowed = 5;
        var cnt = $("input[type='checkbox']:checked").length;
        if (cnt > maxAllowed) {
          this.checked = false;
          alert('Select maximum ' + maxAllowed + ' Levels!');
        }

      });

    }
  });
</script>