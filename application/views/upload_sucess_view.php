<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
    <h2><label class="m">All Rows marked with a red label Will NOT BE IMPORTED</label></h2>
</div>

<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <table id="emp_table" class="table table-striped table-hover">
        <caption><h4><a href="<?php echo site_url('setting/save_success'); ?>" class="btn btn-lg btn-primary"
                        style="float: right;">Save Information</a></h4></caption>
        <thead>
        <tr>
            <th>Graduate #</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Study Location</th>
            <th>Worker Type</th>
            <th>Worker Level</th>
            <th>Gender</th>
            <th>Preference 1</th>
            <th>Preference 2</th>
            <th>Preference 3</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($csv as $i => $item) {
            echo '<tr>';
            echo '<td> ' . ($this->graduate_model->check_duplicate(trim($item[0])) ? '<label class="m">' . $item[0] . "</label>" : $item[0]) . ' </td>';
            echo '<td> ' . trim($item[1]) . ' </td>';
            echo '<td> ' . trim($item[2]) . ' </td>';
            echo '<td> ' . (!$this->location_model->check_duplicate(trim($item[3])) ? '<label class="m">' . $item[3] . "</label>" : $item[3]) . ' </td>';
            echo '<td> ' . (!$this->worker_type_model->check_duplicate(trim($item[4])) ? '<label class="m">' . $item[4] . "</label>" : $item[4]) . ' </td>';
            echo '<td> ' . (!$this->worker_level_model->check_duplicate(trim($item[5])) ? '<label class="m">' . $item[5] . "</label>" : $item[5]) . ' </td>';
            echo '<td> ' . trim($item[6]) . ' </td>';
            echo '<td> ' . (!$this->demand_location_model->check_duplicate(trim($item[7])) ? '<label class="m">' . $item[7] . "</label>" : $item[7]) . ' </td>';
            echo '<td> ' . (!$this->demand_location_model->check_duplicate(trim($item[8])) ? '<label class="m">' . $item[8] . "</label>" : $item[8]) . ' </td>';
            echo '<td> ' . (!$this->demand_location_model->check_duplicate(trim($item[9])) ? '<label class="m">' . $item[9] . "</label>" : $item[9]) . ' </td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
