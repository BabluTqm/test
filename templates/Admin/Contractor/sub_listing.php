<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins approve-request">
        <div class="ibox-title">
          <h5>Sub Contractor Details </h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-wrench"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-sm-9 m-b-xs">
            </div>
            <div class="col-sm-3">
              <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                  <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped" id="table">
              <thead>
                <tr>

                  <th>SR NO.</th>
                  <th>SUB-CONTRACTOR NAME </th>
                  <th>EMAIL </th>
                  <th>DELETE STATUS </th>
                  <th>ACTIVE/INACTIVE </th>
                  <th>APPROVE </th>
                  <th>PROXY</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
                <div class="sk-spinner sk-spinner-wave hide-spin">
                  <div class="sk-rect1"></div>
                  <div class="sk-rect2"></div>
                  <div class="sk-rect3"></div>
                  <div class="sk-rect4"></div>
                  <div class="sk-rect5"></div>
                </div>
                <?php
                $count = 1;
                if (count($data) != 0) {
                  foreach ($data as $user) {
                ?>
                    <tr>
                      <td><?php echo $count++; ?></td>
                      <td><?php echo ucfirst($user->user_profile->first_name . ' ' . $user->user_profile->last_name); ?> </td>
                      <td><?php echo $user->email; ?></td>
                      <td>
                        <?php if ($user->delete_status == 0) {
                          echo $this->Form->postLink(__(''), ['controller' => 'Contractor', 'prefix' => 'Admin', 'action' => 'subDeleteRecover', $user->id], ['class' => 'fa fa-recycle restore text-navy', 'data-toggle' => 'tooltip', 'title' => 'Restore', 'data-placement' => 'top', 'id' => 'recycle']);
                        } else {
                          echo $this->Form->postLink(__(''), ['controller' => 'Contractor', 'prefix' => 'Admin', 'action' => 'subDeleteRecover', $user->id], ['class' => 'fa fa-trash delete text-navy', 'data-toggle' => 'tooltip', 'title' => 'delete', 'id' => 'delete'],);
                        } ?>
                      </td>
                      <td>
                        <?php if ($user->status == 1) : ?>
                          <span class="badge badge-sm bg-gradient-success">
                            <?= $this->Form->postLink(__('Active'), ['controller' => 'Contractor', 'prefix' => 'Admin', 'action' => 'subActiveInactive', $user->id], ['class' => 'text text-light active text-navy']) ?>
                          </span>
                        <?php else : ?>
                          <span class="badge badge-sm bg-gradient-danger ">
                            <?= $this->Form->postLink(__("Deactive"), ['controller' => 'Contractor', 'prefix' => 'Admin', 'action' => 'subActiveInactive', $user->id], ['class' => 'text text-light inactive']) ?>
                          </span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php
                        if ($user->approve_status == 0) {
                        ?>
                          <a href="javascript:void(0)" class="btn-approve label label-primary" data-id="<?= $user->id ?>">Approve</a>
                        <?php } else { ?>
                          <i class="fa fa-check text-navy"></i>
                        <?php } ?>
                      </td>
                      <td>
                        <?php
                        if ($user->approve_status == 1) {
                        ?>
                          <span class="badge badge-sm bg-gradient-success">
                            <?= $this->Form->postLink(__('Proxy login'), ['controller' => 'users', 'prefix' => 'Admin', 'action' => 'proxylogin', $user->id], ['class' => 'text text-light proxy']) ?>
                          </span>
                        <?php
                        } else {
                          echo '<span class= "small text-navy">Firstly Approved <span>';
                        ?>
                        <?php } ?>
                      </td>
                      <td>
                        <?php
                        echo $this->Html->link(__(''), ['controller' => 'Contractor', 'prefix' => 'Admin', 'action' => 'subContractorEdit', $user->id], ['class' => 'fa fa-eye text-navy mx-3', 'data-toggle' => 'tooltip', 'title' => 'view', 'id' => $user->id]);
                        ?>
                      </td>
                    </tr>
                  <?php
                  }
                } else {
                  ?>
                  <tr class="text-center">
                    <td colspan="8">
                      <h4>No Results To Show</h4>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class=" btn-group text-center page-tab">
            <ul id="pagination-list" class="d-flex">
              <!-- Pagination links will be added dynamically here -->
            </ul>
          </div>

        </div>
      </div>
    </div>

  </div>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  function load() {
    $('#loader').css({
      'position': 'fixed',
      'left': '0px',
      'top': '0px',
      'opacity': '0.6',
      'width': '100%',
      'height': '100%',
      'z-index': '9999',
      'background': 'url("/img/smartparcel-mail.gif") 50% 50% no-repeat rgb(249,249,249)'
    });
  }


  $(document).ready(function() {

    $(document).on("click", ".btn-approve", function() {
      var csrfToken = $('meta[name="csrfToken"]').attr('content');

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': csrfToken // this is defined in app.php as a js variable
        }
      });
      var postdata = $(this).attr("data-id");

      swal({
          title: "Are you sure?",
          text: "You want to Approve account!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $(".hide-spin").show();
            $.ajax({
              url: "/admin/contractor/subApprov/" + postdata,
              data: postdata,
              type: "JSON",
              method: "post",
              success: function(response) {

                $(".approve-request").load(location.href + " .approve-request");
                window.location.reload(true);
                swal("User is approved successfully and mail sent!", "success!", "success");
              }
            });
          }
        })

    });
  })
</script>