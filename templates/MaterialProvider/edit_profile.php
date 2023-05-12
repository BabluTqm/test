<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Material Provider Profile Information</h5>
          <div class="ibox-tools">
            <input type="hidden" name="" id="mpjj" value="<?php echo $auth->user_type ?>">
          </div>
        </div>
        <div class="ibox-content">
          <?php echo $this->Form->create($users, ['id' => 'material']) ?>
          <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <label>First Name<span class="err">*</span></label>
                  <?php echo $this->Form->control('user_profile.first_name', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                  <?php echo $this->Form->input('id', ['required' => false, 'class' => 'form-control', 'label' => false, 'id' => 'mp_id', 'type' => 'hidden']) ?>
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
                <div class="col-md-12">
                  <label class="mt-3">Products<span class="err">*</span></label>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-bordered">
                        <tr>
                          <td>
                            <?php
                            foreach ($products as $product) {
                            ?>

                              <?php if (!empty($product->user_product)) { ?>
                                <input type="hidden" id="user_id" value="<?php echo $result->id; ?>">
                                <input class="mp" type="checkbox" name="user_product[][product_id]" value="<?php echo $product->id ?>" checked>
                                <label for="" style="margin-left:1px;"> <?php echo $product->product_name ?></label>

                              <?php } else { ?>
                                <input type="hidden" id="user_id" value="<?php echo $result->id; ?>">
                                <input class="mp" type="checkbox" name="user_product[][product_id]" value="<?php echo $product->id ?>">
                                <label for="" style="margin-left:1px;"> <?php echo $product->product_name ?></label>
                            <?php }
                            } ?>
                          </td>
                        </tr>
                      </table>
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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<!-- <script>
  $(document).ready(function() {

    if ($('#mp').val() == 2) {
      $(".allcheck").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
      });
    }
    if ($('#mp').val() == 3) {
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
</script>  -->