<!-- Page Heading -->
<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<?php echo $this->session->flashdata('msg'); ?>
<div id="processing_div" class="panel panel-primary" style="display:none;">
    <div class="panel-heading">
        <h3>Processing Data. Please Wait . . .
            <img src="<?php echo base_url("/assets/images/loading.gif"); ?>" width="60" height="60"/>
        </h3>
    </div>
</div>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#sectionA">Allocation Inputs</a></li>
    <li><a data-toggle="tab" href="#sectionB">Allocation Exports</a></li>
</ul>

<div class="tab-content">
    <div id="sectionA" class="tab-pane fade in active">
        <div class="panel-body">
            <?php include 'inputs.php'; ?>

            <a href="<?php echo site_url('user/listAll'); ?>" class="list-group-item">
                <h4 class="list-group-item-heading">System Users</h4>
                <p class="list-group-item-text">Controls for adding and removing Users
                </p>
            </a>

        </div>
    </div>
    <div id="sectionB" class="tab-pane fade">
        <div class="row">

            <div class="panel-body">
                <a href="<?php echo site_url('allocation/download_offline_allocation_tool_zip'); ?>"
                   class="list-group-item"
                   title=" This file includes the list of all HCWs, type, salary, and
                        particular assignment constraints, such as which potential location the HCW may be fixed to,
                        if the HCW should be fixed to that location, or if the HCW should only be assigned to one of
                        his/her preferred locations or not be assigned at all. <code> There is a row for each HCW. If
                        there is not a potential fixed location for the HCW, the file includes the legend 'NA' instead of
                        the value. The reason is that we cannot leave fields 'blank', since the user would get an error from GLPK.
                        Data Files contain current allocation inputs">
                    <h4 class="list-group-item-heading">Generate Data Files</h4>

                    <p class="list-group-item-text">Zip file containing data files.<i
                                class="glyphicon glyphicon-info-sign"></i></p>

                </a>

                <a href="<?php echo site_url('allocation/workers_csv/true'); ?>" class="list-group-item"
                   title="There is a row for each HCW. If there is not a potential fixed location for the HCW, the file includes the legend NA instead of
                the value. The reason is that we cannot leave fields 'blank', since the user would get an error from GLPK">

                    <h4 class="list-group-item-heading">Export Workers csv</h4>

                    <p class="list-group-item-text"> This file includes the list of all HCWs, type, salary, and
                        particular assignment constraints, such as which potential location the HCW may be fixed to,
                        if the HCW should be fixed to that location, or if the HCW should only be assigned to one of
                        his/her preferred locations or not be assigned at all.
                        <i class="glyphicon glyphicon-info-sign"></i>
                    </p>

                </a>

                <a href="<?php echo site_url('allocation/preferences_csv/true'); ?>" class="list-group-item"
                   title="There should be a row for each time a
                            different location (as listed in 'locations.csv') is reported as a preference by the HCW.
                For instance, if a worker reports three different preferences, there would be three rows for
                that worker. If the worker repeats locations in his/her preferences, the worker/location
                pair is only included once, with the highest weight. The reason is that if we repeat a
                worker/location pair, GLPK will not be able to know which the correct weight is, and the
                user would get an error. If there is not a weight particular to the HCW, a default weight
                should be considered (according to what is specified in the worksheet 'General Settings'),
                so that there are not 'blanks' in the weights values. If a HCW does not have any
                preferences, then this worker should not be listed in this file. If none of the HCWs have a
                preference, then this file still needs to be included, but it will only list the fields'
                titles and no additional data">
                    <h4 class="list-group-item-heading">Export Preference csv</h4>

                    <p class="list-group-item-text">This file includes the list of location preferences for each HCW
                        and its corresponding weight or preference score.</p>
                    <i class="glyphicon glyphicon-info-sign"></i>
                </a>

                <a href="<?php echo site_url('allocation/locations_csv/true'); ?>" class="list-group-item"
                   title=" There should be a row for each demand  location. If there is not a budget for the location, the file includes the legend 'NA'
                instead of the value. The reason is that we cannot leave fields 'blank', since the user would get an error from GLPK">
                    <h4 class="list-group-item-heading">Export Locations csv</h4>

                    <p class="list-group-item-text">This file includes the list of locations, budgets, and
                        penalties in case of unfulfilled demand. </p>
                    <i class="glyphicon glyphicon-info-sign"></i>
                </a>

                <a href="<?php echo site_url('allocation/demand_csv/true'); ?>" class="list-group-item"
                   title="There should be a row for each location (as listed in 'locations.csv) and worker type (as
                listed in 'types.csv') combination">
                    <h4 class="list-group-item-heading">Export Demand csv</h4>
                    <p class="list-group-item-text">This file includes the demand for each location and worker type.</p>
                    <i class="glyphicon glyphicon-info-sign"></i>
                </a>

                <a href="<?php echo site_url('allocation/types_csv/true'); ?>" class="list-group-item"
                   title="There should be a row for each worker type">
                    <h4 class="list-group-item-heading">Export Worker Types csv</h4>

                    <i class="glyphicon glyphicon-info-sign"></i>
                    <p class="list-group-item-text">This file includes the list of worker types or
                        occupations/categories (e.g., 'Enfermeira Saude Materno Infantil', 'Farmaceutico A', etc.)</p>
                </a>

                <a href="<?php echo site_url('allocation/general_csv/true'); ?>" class="list-group-item"
                   title="If there is not such budget, the file includes the legend 'NA' instead of the value. The reason is that we cannot leave
                fields 'blank', since we would get an error in GLPK">
                    <h4 class="list-group-item-heading">Export General csv</h4>

                    <p class="list-group-item-text">This file includes overall settings or parameters for the
                        optimization. There is only one setting in this file, "totalbudget", which represents the
                        total budget available (considering all the demand locations).</p>
                    <i class="glyphicon glyphicon-info-sign"></i>
                </a>

            </div>
        </div>
    </div>

    <div id="sectionC" class="tab-pane fade in active">
        <div class="panel-body">

            <a href="javascript: reset_worker_data()" class="list-group-item">
                <h4 class="list-group-item-heading">Reset Work Info Only </h4>
                <p class="list-group-item-text">Delete All (Worker Settings info)
                </p>
            </a>
        </div>
    </div>
    

    <div id="sectionD" class="tab-pane fade in active">
        <div class="panel-body">

            <a href="javascript: reset_app_data()" class="list-group-item">
                <h4 class="list-group-item-heading">Reset System Data</h4>
                <p class="list-group-item-text">Delete All data in the allocation tool
                </p>
            </a>
        </div>
    </div>

    <div id="sectionE" class="tab-pane fade in active">
        <div class="panel-body">

            <a href="<?php echo site_url('setting/upload_static_view'); ?>" class="list-group-item">
                <h4 class="list-group-item-heading">Upload Static Files</h4>
                <p class="list-group-item-text">Upload Single Static Files</p>
            </a>
        </div>
    </div>

</div>
