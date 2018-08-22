<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<?php $total_number_of_times_selected = 0 ?>
<?php $total_top_choice = 0 ?>
<?php $total_top_selection = 0 ?>
<div class="row">
    <table id="etable" class="table table-striped table-hover">
        <caption><h4>Preferences by Location</h4></caption>
        <thead>
        <tr>
            <th>Demand Location</th>
            <th>Selected in Preferences</th>
            <th>% Preference Selections</th>
            <th>Selected as Top Preference</th>
            <th>% Selections as Top Preference</th>
            <th>Selected as Top 3 Preference</th>
            <th>% Selections as Top 3 Preference</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($preferences_by_location as $item): ?>
            <?php $total_number_of_times_selected = $item->Selected + $total_number_of_times_selected; ?>
            <?php $total_top_choice = $item->SelectedAsTopPreference + $total_top_choice; ?>
            <?php $total_top_selection = $item->SelectedMoreThanOnce + $total_top_selection; ?>
            <tr>
                <td><?php echo $item->DemandLocation; ?></td>
                <td><?php echo $item->Selected; ?></td>
                <td>
                    <?php echo get_percentage($item->TotalNumberOfPreferences, $item->Selected) . '%' ?>
                </td>
                <td><?php echo $item->SelectedAsTopPreference; ?></td>
                <td>
                    <?php echo get_percentage($item->TotalTopPreferences, $item->SelectedAsTopPreference) . '%' ?>
                </td>
                <td><?php echo $item->SelectedMoreThanOnce; ?></td>
                <td>
                    <?php echo get_percentage($item->Selected, $item->SelectedMoreThanOnce) . '%' ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tfoot>
        <tr>
            <th></th>
            <th title="Selected in Preferences"> <?php echo $total_number_of_times_selected; ?> </th>
            <th></th>
            <th title="Selected as Top Preference"> <?php echo $total_top_choice; ?></th>
            <th></th>
            <th title="Selected as Top 3 Preference"> <?php echo $total_top_selection; ?></th>
            <th></th>
        </tr>
        </tfoot>
        </tbody>
    </table>
</div>


