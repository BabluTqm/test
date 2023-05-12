<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h4>Unassign Projects </h4>
          <div class="ibox-tools"></div>
        </div>
        <!-------->
        <div class="col-sm-9">
          <form method='post' action='' id="dateFilter">
            From <input type='date' name="startDate" id="startDate">
            To <input type='date' name="endDate" id="endDate">
            <input type='submit' value='Search' id="submit">
          </form>
        </div>
        <!-------->
        <div class="ibox-content">
          <div class="table-responsive">
            <table class="table table-striped" id="table_id">
              <thead>
                <tr>
                  <th class="text-uppercase">SR NO.</th>
                  <th class="text-uppercase">Project Name </th>
                  <th class="text-uppercase">Owner Name </th>
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
              <tbody id="unassignProject">
                <?php
                $count = $this->Paginator->counter('{{start}}');
                if (count($projects) != 0) {
                  foreach ($projects as $project) {
                ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $project->project_name; ?> </td>
                      <td><?php echo $project->user_profile->first_name . ' ' . $project->user_profile->last_name; ?></td>
                      <td><?php echo date_format($project->created_date, "d-m-Y H:i");  ?></td>
                      <td>
                        <?php
                        echo $this->Html->link(__(''), ['controller' => 'Projects', 'prefix' => 'Admin', 'action' => 'projectView', $project->id], ['class' => 'fa fa-eye  mx-3 text-navy']);
                        if ($project->delete_status == 0) {
                          echo $this->Form->postLink(__(''), ['controller' => 'Projects', 'prefix' => 'Admin', 'action' => 'unassignProjectDeleteRecover', $project->id], ['class' => 'fa fa-recycle restore text-navy', 'id' => 'recycle']);
                        } else {
                          echo $this->Form->postLink(__(''), ['controller' => 'Projects', 'prefix' => 'Admin', 'action' => 'unassignProjectDeleteRecover', $project->id], ['class' => 'fa fa-trash delete text-navy']);
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
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>


</div>