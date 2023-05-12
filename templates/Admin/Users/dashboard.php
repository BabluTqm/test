<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Owners</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins text-center">
                        <?php
                        $owner = 0;
                        foreach ($users as $user) {
                            if ($user->user_type == 1) {
                                $owner++;
                            }
                        }
                        echo $owner;
                        ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>General Contractor</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins text-center">
                        <?php
                        $gc = 0;
                        foreach ($users as $user) {
                            if ($user->user_type == 2) {
                                $gc++;
                            }
                        }
                        echo $gc;
                        ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <!-- <span class="label label-info pull-right">Annual</span> -->
                    <h5>Sub Contractor</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins text-center">
                        <?php
                        $sc = 0;
                        foreach ($users as $user) {
                            if ($user->user_type == 3) {
                                $sc++;
                            }
                        }
                        echo $sc;
                        ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Monthly income</h5>
                    <div class="ibox-tools">
                        <span class="label label-primary">Updated 12.2015</span>
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <div class="flot-chart m-t-lg" style="height: 55px;">
                        <div class="flot-chart-content" id="flot-chart1"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div>
                        <span class="pull-right text-right">
                            <small>Average value of sales in the past month in: <strong>United states</strong></small>
                            <br />
                            All sales: 162,862
                        </span>
                        <h3 class="font-bold no-margins">
                            Half-year revenue margin
                        </h3>
                        <small>Sales marketing.</small>
                    </div>

                    <div class="m-t-sm">

                        <div class="row">
                            <div class="col-md-8">
                                <div>
                                    <canvas id="lineChart" height="114"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <ul class="stat-list m-t-lg">
                                    <li>
                                        <h2 class="no-margins">2,346</h2>
                                        <small>Total orders in period</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 48%;"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins ">4,422</h2>
                                        <small>Orders in last month</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 60%;"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="m-t-md">
                        <small class="pull-right">
                            <i class="fa fa-clock-o"> </i>
                            Update on 16.07.2015
                        </small>
                        <small>
                            <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                        </small>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-warning pull-right">Data has changed</span>
                    <h5>User activity</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-4">
                            <small class="stats-label">Pages / Visit</small>
                            <h4>236 321.80</h4>
                        </div>

                        <div class="col-xs-4">
                            <small class="stats-label">% New Visits</small>
                            <h4>46.11%</h4>
                        </div>
                        <div class="col-xs-4">
                            <small class="stats-label">Last week</small>
                            <h4>432.021</h4>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-4">
                            <small class="stats-label">Pages / Visit</small>
                            <h4>643 321.10</h4>
                        </div>

                        <div class="col-xs-4">
                            <small class="stats-label">% New Visits</small>
                            <h4>92.43%</h4>
                        </div>
                        <div class="col-xs-4">
                            <small class="stats-label">Last week</small>
                            <h4>564.554</h4>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-4">
                            <small class="stats-label">Pages / Visit</small>
                            <h4>436 547.20</h4>
                        </div>

                        <div class="col-xs-4">
                            <small class="stats-label">% New Visits</small>
                            <h4>150.23%</h4>
                        </div>
                        <div class="col-xs-4">
                            <small class="stats-label">Last week</small>
                            <h4>124.990</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Owners</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-9">
                            <form method='post' action='' id="dateFilter">
                                Start Date <input type='date' name="startDate" id="startDate">
                                End Date <input type='date' name="endDate" id="endDate">
                                <input type='submit' value='Search' id="submitAction">
                            </form>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                        </div>
                    </div>

                    <!----->
                    <!-- <div class="form-group" id="data_5">
                        <label class="font-normal">Range select</label>
                        <form method='post' action='' id="dateFilter">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="startDate" id="startDate" placeholder="dd/mm/yyyy">
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" name="endDate" id="endDate" placeholder="dd/mm/yyyy">
                        </div>
                        <input type="submit" id="submitAction">
                        </form>
                    </div> -->
                    <!----->


                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Name </th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="fffff">
                                <?php
                                $counter = 0;
                                foreach ($owners as $owner) {
                                ?>
                                    <tr>
                                        <td><?php echo  ++$counter; ?></td>
                                        <td><?php echo ucfirst($owner->user_profile->first_name . ' ' . $owner->user_profile->last_name); ?> </td>
                                        <td><?php echo $owner->email; ?></td>
                                        <td><?php echo $owner->user_profile->phone; ?></td>
                                        <td><?php echo date_format($owner->created_at, "d-m-Y H:i"); ?></td>
                                        <td> <?php echo $this->Html->link(__(''), ['controller' => 'users', 'prefix' => 'Admin', 'action' => 'ownerEdit', $owner->id], ['class' => 'fa fa-eye text-navy', 'data-toggle' => 'tooltip', 'title' => 'view', 'id' => $owner->id]); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class=" btn-group text-center">
                        <ul id="pagination-list" class="d-flex">
                            <!-- Pagination links will be added dynamically here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!---SC GS Table ---->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Sub Contractors And General Contractors</h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped" id="gs-sc">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name </th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company </th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                foreach ($all_contractor as $contractor) {

                                    if ($contractor->user_type == 2 || $contractor->user_type == 3) {
                                        if ($contractor->complete_status == 0)
                                            continue;
                                ?>
                                        <tr>
                                            <td><?php echo  ++$counter; ?></td>
                                            <td><?php echo ucfirst($contractor->user_profile->first_name . ' ' . $contractor->user_profile->last_name); ?> </td>
                                            <td><?php echo $contractor->email; ?></td>
                                            <td><?php echo $contractor->user_profile->phone; ?></td>
                                            <td><?php echo $contractor->user_profile->company_name; ?></td>
                                            <!-- <td><?php echo date_format($contractor->created_at, "d-m-Y H:i"); ?></td> -->
                                            <td><?php if ($contractor->user_type == 2) {
                                                    echo "<span class ='badge badge-primary'>gc</span>";
                                                } else {
                                                    echo "<span class ='badge badge-success'>sc</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($contractor->user_type == 2) {
                                                    echo $this->Html->link(__(''), ['controller' => 'contractor', 'prefix' => 'Admin', 'action' => 'generalContractorEdit', $contractor->id], ['class' => 'fa fa-eye text-navy', 'data-toggle' => 'tooltip', 'title' => 'view', 'id' => $contractor->id]);
                                                } else {
                                                    echo $this->Html->link(__(''), ['controller' => 'contractor', 'prefix' => 'Admin', 'action' => 'subContractorEdit', $contractor->id], ['class' => 'fa fa-eye text-navy', 'data-toggle' => 'tooltip', 'title' => 'view', 'id' => $contractor->id]);
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class=" btn-group text-center">
                        <ul id="pagination-list-gc-sc" class="d-flex">
                            <!-- Pagination links will be added dynamically here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!------->
    </div>
</div>