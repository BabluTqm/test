<div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Assigned Contrctors </h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="/projects/requested-project-list">
                            Back
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table_id">
                            <thead>
                                <tr>

                                    <th class="text-uppercase">Contractor Name</th>
                                    <th class="text-uppercase">Contractor Email </th>
                                    <th class="text-uppercase">Contractor Phone </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($assignuser) != 0) {
                                    foreach ($assignuser as $assign) {
                                        foreach ($users as $user) {
                                            if ($assign->user_id == $user->id) {
                                ?>
                                                <tr>
                                                    <td><?php echo $user->user_profile->first_name . ' ' . $user->user_profile->last_name; ?></td>
                                                    <td><?php echo $user->email; ?> </td>
                                                    <td><?php echo $user->user_profile->phone; ?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr class="text-center">
                                        <td colspan="3">
                                            <h4>No Results To Show</h4>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>


</div>