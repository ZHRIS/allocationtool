<div class="row">

    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Search Results - <?php echo $key_word; ?>
            </div>
            <div class="panel-body">

                <table class="table table-striped table-hover">
                    <tbody>
                    <tr>
                        <td>
                            <a href="<?php echo site_url('graduate/get_search_list/' . $key_word); ?>"> Graduate</a>
                        </td>
                        <td>
                            <span class="badge"><?php echo $graduate_total; ?></span> <a href="#">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo site_url('location/get_search_list/' . $key_word); ?>"> Study
                                Location</a>
                        </td>
                        <td>
                            <span class="badge"><?php echo $location_total; ?></span> <a href="#">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?php echo site_url('demand_location/get_search_list/' . $key_word); ?>">Demand
                                Location</a>
                        </td>

                        <td>
                            <span class="badge"><?php echo $demand_location_total; ?></span> <a href="#">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?php echo site_url('worker_type/get_search_list/' . $key_word); ?>">Worker
                                Type</a>
                        </td>
                        <td>
                            <span class="badge"><?php echo $worker_type_total; ?></span> <a href="#">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?php echo site_url('worker_level/get_search_list/' . $key_word); ?>">Worker
                                Level</a>
                        </td>

                        <td><span class="badge"><?php echo $worker_level_total; ?></span> <a href="#">
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
