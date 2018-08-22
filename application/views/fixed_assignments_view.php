<?php
echo '<div class="row">';
echo $this->breadcrumbs->show();
echo '<caption> <h4> Fixed Assignments  </h4> </caption> ';
echo '<table id="etable" class="table table-striped table-hover">';
echo ' <thead>';
echo '<th>Num </th>';
echo '<th>Demand Location</th>';
echo '<th>Allocated Budget by FIXED</th>';
echo '<th>% Allocated Budget by FIXED Location</th>';
foreach ($worker_type_list as $worker) {
    echo '<th>' . $worker->worker_type_name . '</th>';
}
echo '</tr>';
echo '</thead>';

foreach ($list as $i => $item) {
    echo '<tr>';
    echo '<td> ' . ($i + 1) . ' </td>';
    echo '<td> ' . $item->demand_location_name . ' </td>';
    echo '<td> ' . $item->location_budget . ' </td>';
    echo '<td> ' . $item->location_budget . ' </td>';
    foreach ($worker_type_list as $worker) {
        $total = $this->results_x_model->get_count_fixed_assigned_worker_type_by_demand_location($worker->worker_type_id, $item->demand_location_id);
        echo '<td> ' . $total . ' </td>';
    }
    echo '</tr>';
}
echo '<tfoot>';
echo '<tr>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
foreach ($worker_type_list as $worker) {
    echo '<th title="Total Fixed">';
    $total = $this->results_x_model->get_total_count_fixed_assigned_worker_type($worker->worker_type_id);
    echo $total;
    '</th>';
}
echo '</tfoot>';
echo '</tr>';
echo '</table>';
echo '</div">';
?>