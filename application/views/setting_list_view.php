<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>

    <div class="list-group">

        <a href="<?php echo site_url('setting/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">General Settings</h4>
            <p class="list-group-item-text">Enter the general settings for the input/data and the optimization model.
                Input Setting and Optimization Settings. Input Settings regarding the data input that apply
                generally to all other input data (unless otherwise specified) and Optimization Settings regarding how long the
                model is allowed to run in GLPK.
            </p>
        </a>
    </div>
</div>

<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>

    <table class="table table-striped table-hover">        
        <thead>
            <tr>
                <th>Maximum Running Time (Minutes)</th>
                <th>Optimality Gap</th>
                <th>Harvesine Formula</th>
                <th>Maximum Weight</th>
                <th>Total Budget</th>
                <th>Default Penalty Unfulfilled Demand</th>
                <th>Number of Preferences allowed</th>
                <th>Currency</th>
                <th>Plaform</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $item): ?>
                <tr>
                    <td><?php echo $item->maximum_running_time; ?></td>
                    <td><?php echo $item->optimality_gap; ?></td>
                    <td><?php echo $item->harvesine_formula; ?></td>
                    <td><?php echo $item->maximum_weight; ?></td>
                    <td><?php echo $item->total_budget; ?></td>
                    <td><?php echo $item->default_penalty_unfulfilled_demand; ?></td>
                    <td><?php echo $item->number_of_preferences_allowed; ?></td>
                    <td><?php echo $item->tool_currency; ?></td>
                    <td><?php echo $item->platform; ?></td>
                    <td>                        
                        <a href="<?php echo base_url(); ?>index.php/setting/update/<?php echo $item->setting_id; ?> " class="btn-sm btn-success">Edit</a>
                    </td> 
                    <td>                        
                        <a href="javascript: delete_setting(<?php echo $item->setting_id; ?>)" class="btn-sm btn-danger">Delete</a></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
