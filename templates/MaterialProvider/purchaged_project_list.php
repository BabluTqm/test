<div class="wrapper wrapper-content">

  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Purchased Projects </h5>
        </div>
        <div class="ibox-content">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>

                  <th class="text-uppercase">SR NO.</th>
                  <th class="text-uppercase">Project Name </th>
                  <th class="text-uppercase">Owner Name </th>
                  <th class="text-uppercase">Email </th>
                  <th class="text-uppercase">Phone </th>
                  <th class="text-uppercase">Created Date </th>
                  <th class="text-uppercase">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php $count = 0;
                if (count($purchedUsers) != 0) {
                  foreach ($purchedUsers as $purchedUsers) {
                    if ($purchedUsers->project->assigned_status == 1 && $purchedUsers->project->delete_status == 1) {
                ?>
                      <tr>
                        <td><?php echo ++$count; ?></td>

                        <td><?php echo $purchedUsers->project->project_name; ?></td>

                        <td><?php echo $purchedUsers->project->user_profile->first_name . " " . $purchedUsers->project->user_profile->last_name; ?></td>

                        <td><?php echo $purchedUsers->project->user->email; ?></td>
                        <td><?php echo $purchedUsers->project->user_profile->phone; ?></td>

                        <td><?php echo $purchedUsers->project->created_date; ?></td>

                        <td>

                          <?= $this->Html->link(__(''), ['controller' => 'Contractors', 'action' => 'projectDetails', $purchedUsers->id], ['class' => 'fa fa-eye']) ?>
                        </td>

                      </tr>
                  <?php }
                  }
                } else {
                  ?>
                  <tr class="text-center">
                    <td colspan="7">
                      <h4>No Results To Show</h4>
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