<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Assign Projects </h5>
          <div class="ibox-tools"></div>
        </div>
        <div class="ibox-content">

          <div class="table-responsive">
            <table class="table table-striped" id="table">
              <thead>
                <tr>

                  <th class="text-uppercase">SR NO.</th>
                  <th class="text-uppercase">Project Name </th>
                  <th class="text-uppercase">Owner Name </th>
                  <th class="text-uppercase">Project Delete </th>
                  <th class="text-uppercase">Created Date </th>
                  <th class="text-uppercase">ACTION</th>
                </tr>
              </thead>
              <div class="sk-spinner sk-spinner-wave hide-spin">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
              </div>
              <tbody>
                <?php
                $count = $this->Paginator->counter('{{start}}');
                if (count($projects) != 0) {
                  foreach ($projects as $project) {
                ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $project->project_name; ?> </td>
                      <td><?php echo $project->user_profile->first_name . ' ' . $project->user_profile->last_name; ?></td>
                      <td>
                        <?php if ($project->delete_status == 1) { ?>
                          <span class="text">
                            <?php
                            echo 'Active';
                            ?>
                          </span>
                        <?php } else { ?>
                          <span class="text">
                          <?php echo "Deleted";
                        } ?>
                          </span>
                      </td>
                      <td><?php echo $project->created_date; ?></td>
                      <td>
                        <?php
                        echo $this->Html->link(__(''), ['controller' => 'Projects', 'prefix' => 'Admin', 'action' => 'projectAssignView', $project->id], ['class' => 'fa fa-eye ']);
                        if ($project->delete_status == 0) {
                          echo $this->Form->postLink(__(''), ['controller' => 'Projects', 'prefix' => 'Admin', 'action' => 'projectDeleteRecover', $project->id], ['class' => 'fa fa-recycle restore', 'id' => 'recycle',]);
                        } else {
                          echo $this->Form->postLink(__(''), ['controller' => 'Projects', 'prefix' => 'Admin', 'action' => 'projectDeleteRecover', $project->id], ['class' => 'fa fa-trash delete', 'id' => 'delete']);
                        }
                        ?>
                      </td>
                    </tr>
                  <?php
                    $count++;
                  }
                } else {
                  ?>
                  <tr class="text-center text-muted">
                    <td colspan="6">
                      <h4>No Results to show</h4>
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