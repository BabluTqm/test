<div class="row wrapper border-bottom white-bg page-heading main-head">
  <div class="col-lg-10">
    <h2>Create Password</h2>
  </div>
  <div class="col-lg-2">

  </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Enter details to set password</h5>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-md-4"></div>

            <div class="col-md-4">
              <?php echo $this->Form->create(null, ['id' => 'form']) ?>
              <h4>Password* </h4>
              <?php echo $this->Form->control('password', ['required' => false, 'class' => 'form-control mb-3', 'label' => false]) ?>
              <br>
              <h4> Confirm Password* </h4>
              <?php echo $this->Form->control('confirm_password', ['type' => 'password', 'required' => false, 'class' => 'form-control mb-3', 'label' => false]) ?>
              <br>
              <?= $this->Form->button(__('Create Password'), ['class' => 'btn btn-primary']) ?>
              <?php echo $this->Form->end() ?>
            </div>

            <div class="col-md-4"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>