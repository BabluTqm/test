<div class="row wrapper border-bottom white-bg page-heading main-head">
  <div class="col-lg-10">
    <h2>Set Credits</h2>
  </div>
  <div class="col-lg-2">

  </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Enter details to set credit</h5>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-md-4"></div>

            <div class="col-md-4">
              <div class="sk-spinner sk-spinner-wave hide-spin">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
              </div>
              <?php echo $this->Form->create($credit, ['id' => 'credit-form']) ?>
              <input type="hidden" id="idd" value="<?php echo $admin->id ?>">
              <h4>Enter minimum credit value for lead assign GC/SC </h4>
              <?php echo $this->Form->control('credit', ['required' => false, 'class' => 'form-control ', 'label' => false, 'type' => 'text']) ?>
              <br>
              <h4>Enter minimum credit value for lead assign MP</h4>
              <?php echo $this->Form->control('mp_credit', ['required' => false, 'class' => 'form-control ', 'label' => false, 'type' => 'text']) ?>
              <br>
              <h4>Set credit minimum Limit for GC/SC/MP</h4>
              <?php echo $this->Form->control('min_credit', ['required' => false, 'class' => 'form-control ', 'label' => false, 'type' => 'text']) ?>
              <br>
              
              <?= $this->Form->button(__('Set Credit'), ['class' => 'btn btn-primary w-50 ms-4 mt-4 mb-0 set-credit']) ?>
              <?php echo $this->Form->end() ?>
            </div>

            <div class="col-md-4"></div>
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

    jQuery.validator.addMethod("noSpace",
      function(value, element) {
        return value == "" || value.trim().length != 0;
      },
      "**No space please fill the Character"
    );
    jQuery.validator.addMethod("lettersonly",
      function(value, element) {
        return this.optional(element) || /^[a-z]/i.test(value);
      }, "**Please Letters only Not fill Space");


    $("#credit-form").validate({

      rules: {
        credit: {
          required: true,
        }
      },

      messages: {
        credit: {
          required: "Please enter the credit value",
        }
      },

      errorPlacement: function(error, element) {
        if (element.is(":radio")) {
          error.appendTo(".pr");
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        var formData = $(form).serialize();
        var id = $("#idd").val();
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": csrfToken,
          },
          url: "/admin/contractor_credit/setCredit/" + id,
          type: "JSON",
          method: "POST",
          data: formData,
          success: function(response) {
            var data = JSON.parse(response);
            if (data["status"] == 0) {
              // alert(data["message"]);
              swal("Error!", "Credits not updated!", "error");
            } else {
              $(".hide-spin").show();
              swal(
                "Updated!",
                "Credits Has been updated Successfully!",
                "success"
              ).then(function() {
                window.location.href =
                  "/admin/contractor_credit/setCredit/" + id;
              });
            }
          },
        });
        return false;
      },


    });

  });
</script>