<div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>General Contractor Details </h5>
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
                        <table class="table table-striped" id="table_id">
                            <thead>
                                <tr>

                                    <th class="text-uppercase">SR NO.</th>
                                    <th class="text-uppercase">Project Name </th>
                                    <th class="text-uppercase">Acceptance Status </th>
                                    <th class="text-uppercase">Assigned Status </th>
                                    <th class="text-uppercase">Created Date </th>
                                    <th class="text-uppercase">Assigned Contractor </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                if (count($projects) != 0) {
                                    foreach ($projects as $project) : ?>
                                        <tr>
                                            <td><?php echo ++$count; ?></td>
                                            <td><?php echo $project->project_name; ?> </td>
                                            <td>
                                                <?php if ($project->accept_status == 0) { ?>
                                                    <span class="badge badge-sm bg-warning text-xxs">
                                                        <?php echo 'Pending'; ?>
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="badge badge-pill bg-success text-xxs">
                                                        <?php echo 'Accepted'; ?>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($project->assigned_status == 0) { ?>
                                                    <span class="badge badge-sm bg-warning text-xxs">
                                                        <?php echo 'Not Assigned'; ?>
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="badge badge-pill bg-success text-xxs">
                                                        <?php echo h('Assigned') ?>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo h($project->created_date) ?> </td>
                                            <td>
                                                <?php echo $this->Html->link(__('<i style="font-size:15px" class="fa fa-eye"></i>'), ['controller' => 'projects', 'action' => 'view-contractor', $project->id], ['escape' => false,]) ?>

                                                <?php if ($project->assigned_status == 0 || $project->accept_status == 0) {
                                                    echo $this->Html->link(__('<i style="font-size:15px" class="fa fa-edit"></i>'), ['controller' => 'projects', 'action' => 'edit-project', $project->id], ['escape' => false,]);
                                                }

                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php
                                } else {
                                ?>
                                    <tr class="text-center">
                                        <td colspan="6">
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