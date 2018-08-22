<?php

$numberOfPreferenceAllowed = $this->setting_model->get_number_of_preferences_allowed();
echo '<div class="row">';
echo $this->breadcrumbs->show();
echo '<caption> <h4> Workers Assignments  </h4> </caption> ';
echo '<table id="etable" class="table table-striped table-hover">';
echo ' <thead>';
echo '<tr>';
echo '<th>Num</th>';
echo '<th>UID </th>';
echo '<th>Last Name</th>';
echo '<th>First Name</th>';
echo '<th>Assigned Location</th>';
echo '<th>Assignment Preference</th>';
echo '<th>Gender</th>';
echo '<th>Adjusted Distance (km)</th>';
echo '<th>Worker Type</th>';
echo '<th>Worker Level</th>';
echo '<th>Salary (Allocated)</th>';
echo '</tr>';
echo ' </thead>';
foreach ($list as $i => $item) {
    echo '<tr>';
    echo '<td> ' . ($i + 1) . ' </td>';
    $worker = $this->graduate_model->get($item->graduate_id);
    $id = $worker->graduate_id;
    if (!is_null($worker)) {
        echo '<td> ' . $worker->graduate_no . ' </td>';
        echo '<td> ' . $worker->last_name . ' </td>';
        echo '<td> ' . $worker->first_name . ' </td>';
        echo '<td> ' . $this->demand_location_model->get($item->demand_location_id)->demand_location_name . ' </td>';
        echo '<td> ' . $this->preference_model->get_preference_choice($id, $item->demand_location_id) . ' </td>';
        echo '<td> ' . $worker->gender . '</td>';
        echo '<td> ' . 0 . ' </td>';
        echo '<td> ' . $worker->worker_type_name . ' </td>';
        echo '<td> ' . $worker->worker_level_name . ' </td>';
        echo '<td> ' . $this->worker_salary_model->get_default_salary($worker->worker_type_id, $worker->worker_level_id) . ' </td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '</div">';
?>