<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Request for New Project </h5>
          <div class="ibox-tools"></div>
        </div>
        <div class="ibox-content">
          <?php echo $this->Form->create($project, ['id' => 'projects_form']) ?>
          <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12 text-center">
                  <h3>Enter details to request a new project</h3>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Project Name*</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('project_name', ['required' => false, 'class' => 'form-control ', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Project Address1**</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('project_address1', ['required' => false, 'class' => 'form-control ', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Project Address2</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('project_address2', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="sk-spinner sk-spinner-wave hide-spin">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
              </div>
              <div class="row">
                <div class="col-md-6">State*</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('state', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">City*</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('city', ['required' => false, 'class' => 'form-control ', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Pincode**</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('pincode', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Property Type*</div>
                <div class="col-md-6">
                  <select name="property_type" id="" class="form-control p-1">
                    <option value="" selected disabled>Select one</option>
                    <option value="1">New Construction</option>
                    <option value="2">Addition</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Type of Contractor you will be require*</div>
                <div class="col-md-6">
                  <input type="radio" name="contractor" value="<?php echo 2 ?>" id="contractor-gc" class="error">
                  <label for="">General Contractor</label>
                  <input type="radio" name="contractor" value="<?php echo 3 ?>" id="contractor-sc" class="error">
                  <label for="">Sub-Contractor</label>
                  <span class="pr"></span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <h4>Provided Services</h4>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <input name="allcheck" class="allcheck" type="checkbox" value="">
                      <label for="" class="alltext">All</label>
                    </div>
                    <div class="col-md-12">
                      <?php foreach ($services as $service) : ?>
                        <input class="check ckeckit" type="checkbox" name="owner_services[][service_id]" value="<?php echo $service->id ?>">
                        <label for=""> <?php echo $service->service ?></label>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12 text-center">
                  <?= $this->Form->button(__('Send Request'), ['class' => 'btn btn-primary']) ?>
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

    // $("#contractor-3").click(function(){
    //   $('input:checkbox').not(this).prop('checked', false);
    // });

    $("input[name=contractor]:radio").click(function() {
      if ($('input[name=contractor]:checked').val() == "2") {
        $('.allcheck').show();
        $('.alltext').show();
        $('input:checkbox').not(this).prop('checked', this.checked);
        $(".allcheck").click(function() {
          $('input:checkbox').not(this).prop('checked', this.checked);
        });

      }
      if ($('input[name=contractor]:checked').val() == "3") {
        $('.allcheck').hide();
        $('.alltext').hide();
        $('input:checkbox').not(this).prop('checked', false);
        $("input[type='checkbox']").change(function() {
          if ($('input[name=contractor]:checked').val() == "2") {

            $('#load').load('/projects/request-new-project #load')
          } else {

            var maxAllowed = 5;
            var cnt = $("input[type='checkbox']:checked").length;
            if (cnt > maxAllowed) {
              this.checked = false;
              alert('Select maximum ' + maxAllowed + ' Levels!');
            }
          }
        });
      }
    });
  });


  $(document).ready(function() {


    jQuery.validator.addMethod("noSpace",
      function(value, element) {
        return value == "" || value.trim().length != 0;
      },
      "**No space please fill the Character"
    );
    /********************************************************************************/
    jQuery.validator.addMethod("lettersonly",
      function(value, element) {
        return this.optional(element) || /^[a-z]/i.test(value);
      }, "**Please Letters only Not fill Space");


    $("#projects_form").validate({

      rules: {

        "owner_services[][service_id]": {
          required: true
        },
        contractor: {
          required: true
        },
        project_name: {
          required: true,
          noSpace: true,
          lettersonly: true,

        },

        project_address1: {
          required: true,
          noSpace: true,
          //lettersonly:true,
          // minlength: 6,
        },

        state: {
          required: true,
          noSpace: true,
          lettersonly: true,
        },
        city: {
          required: true,
          noSpace: true,
          lettersonly: true,

        },
        property_type: {
          required: true,
          noSpace: true,

        },

        pincode: {
          required: true,
          noSpace: true,
          digits: true,
          minlength: 6,
          maxlength: 6,


        },


      },

      messages: {

        "owner_services[][service_id]": {
          required: "Please select services",
        },
        contractor: {
          required: "Please select contractor",
        },
        project_name: {
          required: " **Please enter a First Name",

        },

        address1: {
          required: " **Please enter Address",

        },

        state: {
          required: "**Please enter your state",
        },
        city: {
          required: "**Please enter your city",
        },
        property_type: {
          required: "**Please enter construction type",
        },
        pincode: {
          required: "**please enter your pincode",
          digits: "**Only numbers are allowed",
          minlength: " **Your pincode must consist 6 Digits",
          maxlength: " **Phone pincode must consist 6 Digits",
        },

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
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": csrfToken,
          },
          url: "/projects/request-new-project",
          type: "JSON",
          method: "POST",
          data: formData,
          success: function(response) {
            var data = JSON.parse(response);
            if (data["status"] == 0) {
              // alert(data["message"]);
              swal("Error!", "Project request could not be saved!", "error");
            } else {
              $(".hide-spin").show();
              swal(
                "Success!",
                "New project request has been saved Successfully.!",
                "success"
              ).then(function() {
                window.location.href =
                  "/projects/requested-project-list";
              });
            }
          },
        });
        return false;
      },


    });
  });
</script>