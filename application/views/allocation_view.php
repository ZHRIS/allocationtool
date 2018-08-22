<!-- Page Heading -->
<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<!-- /.row -->

<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <div id="processing_div" class="panel panel-primary" style="display:none;">
        <div class="panel-heading">
            <h3>Processing Data. Please Wait . . .
                <img src="<?php echo base_url("/assets/images/loading.gif"); ?>" width="60" height="60"/>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Step 1 - Generate Input Files
                </div>
                <div class="panel-body">
                    <div class="list-group">

                        <a href="<?php echo site_url('allocation/generate_glpk_csv'); ?>" class="list-group-item"
                           onclick="run_glpk_csv()">
                            <h4 class="list-group-item-heading">Generate Files </h4>
                            <p class="list-group-item-text">Generate input files
                                <code>
                                    Will Generate Allocation tool inputs.
                                </code>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Step 2 : Run GLPK
                </div>
                <div class="panel-body">
                    <div class="list-group">

                        <a href="<?php echo site_url('allocation/run_glpk_csv'); ?>" class="list-group-item"
                           onclick="run_glpk_csv()">
                            <h4 class="list-group-item-heading">Run GLPK </h4>

                            <p class="list-group-item-text">Run the GLPK solver to allocate HCW
                                <code>
                                    Will Generate Allocation tool outputs.
                                </code>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-red">
                <div class="panel-heading">
                    Step 3 : Read Results
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <a href="<?php echo site_url('allocation/read_glpk_output'); ?>" class="list-group-item"
                           onclick="run_glpk_csv()">
                            <h4 class="list-group-item-heading">Read Results</h4>
                        </a>
                        <p class="list-group-item-text">Read Allocation tool results
                            <code>
                                Last Run <span class="badge"><?php echo $last_modified_date; ?></span>
                            </code>
                        </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionA">Allocation Results</a></li>
        <li><a data-toggle="tab" href="#sectionB">Allocation Inputs</a></li>
    </ul>

    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <div class="panel-body">
                <?php include 'outputs.php'; ?>

            </div>
        </div>
        <div id="sectionB" class="tab-pane fade">
            <div class="panel-body">
                <?php include 'inputs.php'; ?>
            </div>
        </div>
    </div>

</div>
