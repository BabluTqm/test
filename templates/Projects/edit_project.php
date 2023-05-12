<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Update Project Details </h5>
          <div class="ibox-tools">
            <?php

            use function PHPSTORM_META\type;

            echo $this->Html->link(__('Back'), ['controller' => 'projects', 'action' => 'requested-project-list'], ['class' => 'btn btn-success']); ?>
            <input type="hidden" name="" id="gcsc" value="<?php echo $project->contractor ?>">
            <input type="hidden" name="" id="pid" value="<?php echo $project->id ?>">
          </div>
        </div>
        <div class="ibox-content">
          <?php echo $this->Form->create($project, ['id' => 'projects_form']) ?>
          <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">Project Name *</div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('id', ['required' => false, 'class' => 'form-control ', 'label' => false, 'id' => 'idd', 'type' => 'hidden']) ?>
                  <?php echo $this->Form->control('project_name', ['required' => false, 'class' => 'form-control ', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Project Address1 *</div>
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
                <div class="col-md-6">State *</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('state', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">City *</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('city', ['required' => false, 'class' => 'form-control ', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Pincode *</div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('pincode', ['required' => false, 'class' => 'form-control', 'label' => false]) ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">Property Type *</div>
                <div class="col-md-6">
                  <select name="property_type" id="" class="form-control p-1">
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
                <div class="col-md-6">Type of Contractor you will be require *</div>
                <div class="col-md-6">
                  <?php if ($project->contractor == 2) { ?>
                    <input type="radio" name="contractor" value="<?php echo 2; ?>" id="contractor-gc" checked>
                    <label for="">General Contractor</label>
                    <input type="radio" name="contractor" value="<?php echo 3; ?>" id="contractor-sc">
                    <label for="">Sub-Contractor</label>
                  <?php } else if ($project->contractor == 3) { ?>
                    <input type="radio" name="contractor" value="<?php echo 2; ?>" id="contractor-gc">
                    <label for="">General Contractor</label>
                    <input type="radio" name="contractor" value="<?php echo 3; ?>" id="contractor-sc" checked>
                    <label for="">Sub-Contractor</label>
                  <?php } ?>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <h4>Services *</h4>
                </div>
                <div class="col-md-6">
                  <?php foreach ($services as $service) { ?>

                    <?php if (!empty($service->owner_services)) { ?>
                      <input type="hidden" name="" id="project_id" value="<?php echo $project->id; ?>">
                      <input class="project_check" type="checkbox" name="owner_services[][service_id]" value="<?php echo $service->id ?>" style="margin-bottom:10px;margin-left:7px" checked>
                      <label for="" style="margin-left:1px;"> <?php echo $service->service ?></label>
                    <?php } else { ?>
                      <input class="" type="hidden" name="" id="project_id" value="<?php echo $project->id; ?>">
                      <input class="project_check" type="checkbox" name="owner_services[][service_id]" value="<?php echo $service->id ?>" style="margin-bottom:10px;margin-left:7px">
                      <label for="" style="margin-left:1px;"> <?php echo $service->service ?></label>
                  <?php }
                  } ?>
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
  $(document).ready(function(e) {
    var pid = $('#pid').val();

    var csrfToken = $('meta[name="csrfToken"]').attr('content');

    if ($('input[name=contractor]:checked').val() == "2") {
      $('input:checkbox').not(this).prop('checked', this.checked);
      if ($('#contractor-sc').click(e)) {

        // window.location.href="/projects/edit-project/2";
        var idsArr = [];
        $('#projects_form').find('input[type=checkbox]:checked').each(function() {
          idsArr.push(this.value);
        });
        var pid = $('#project_id').val();
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          url: '/projects/deteleAllServices',
          type: 'JSON',
          method: 'POST',
          data: {
            'id': idsArr,
            'pid': pid
          },
          success: function(response) {
            if (response == 1) {
              $('.checkit').checked = false;
            }

          }
        })
        return false;
      }

    }
    if ($('input[name=contractor]:checked').val() == "3") {

      $('#contractor-sc').on('click', function() {

        var maxAllowed = 5;
        var cnt = $("input[type='checkbox']:checked").length;
        var pid = $('#pid').val();

        if (cnt > maxAllowed) {
          this.checked = false;

          // alert(confirm('If you change the type of contractor then you will be able to select only ' + maxAllowed + ' services!',));
          window.location.href = '/projects/edit-project/' + pid;

        }

        var idsArr = [];
        $('#projects_form').find('input[type=checkbox]:checked').each(function() {
          idsArr.push(this.value);
        });
        var pid = $('#project_id').val();
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          url: '/projects/deteleAllServices',
          type: 'JSON',
          method: 'POST',
          data: {
            'id': idsArr,
            'pid': pid
          },
          success: function(response) {
            if (response == 1) {
              $('.checkit').checked = false;
            }

          }
        })
        return false;
      });
      $("input[type='checkbox']").change(function(e) {
        e.preventDefault();
        if ($('input[name=contractor]:checked').val() == "2") {

          $('#load').load('/projects/request-new-project #load')
        } else {

          var maxAllowed = 5;
          var cnt = $("input[type='checkbox']:checked").length;
          if (cnt > maxAllowed) {
            this.checked = false;
            alert('you can select only' + ' ' + maxAllowed + ' service!');
          }
        }
      });
    }



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

    $("input[name=contractor]:radio").click(function() {
      if ($('input[name=contractor]:checked').val() == "2") {
        $('input:checkbox').not(this).prop('checked', this.checked);

      }
      if ($('input[name=contractor]:checked').val() == "3") {
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
        },
        city: {
          required: true,
          noSpace: true,

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

      /* errorPlacement: function (error, element) {
         if (element.is(":radio")) {
           error.appendTo(".pr");
         } else {
           error.insertAfter(element);
         }
       },*/
      submitHandler: function(form) {
        var formData = $(form).serialize();
        var id = $('#idd').val();
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": csrfToken,
          },
          url: "/projects/edit-project/" + id,
          type: "JSON",
          method: "POST",
          data: formData,
          success: function(response) {
            var data = JSON.parse(response);
            if (data["status"] == 0) {
              // alert(data["message"]);
              swal("Error!", "Project request could not be updated!", "error");
            } else {
              $(".hide-spin").show();
              swal(
                "Success!",
                "Project request updated Successfully.!",
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