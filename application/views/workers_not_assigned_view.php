<?php

echo '<div class="row">';
echo $this->breadcrumbs->show();
echo '<caption> <h4> Workers Not Assigned </h4> </caption> ';
echo '<table id="etable" class="table table-striped table-hover">';
echo ' <thead>';
echo '<tr>';
echo '<th>Num</th>';
echo '<th>UID </th>';
echo '<th>First Name</th>';
echo '<th>Last Name</th>';
echo '<th>Gender</th>';
echo '<th>Worker Type</th>';
echo '<th>Worker Level</th>';
echo '</tr>';
echo ' </thead>';
foreach ($list as $i => $item) {
    echo '<tr>';
    echo '<td> ' . ($i + 1) . ' </td>';
    $worker = $this->graduate_model->get($item->graduate_id);
    $id = $worker->graduate_id;
    if (!is_null($worker)) {
        echo '<td> ' . $worker->graduate_no . ' </td>';

        echo '<td> ' . $worker->first_name .' </td>';
        echo '<td> ' . $worker->last_name . ' </td>';
        echo '<td> ' . $worker->gender . '</td>';
        echo '<td> ' . $worker->worker_type_name . ' </td>';
        echo '<td> ' . $worker->worker_level_name . ' </td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '</div">';
?>