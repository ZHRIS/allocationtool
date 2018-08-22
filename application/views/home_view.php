<!-- Page Heading -->
<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<!-- /.row -->

<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">

        <div class="col-lg-4">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Allocation Input
                </div>
                <div class="panel-body" style="height: 270px">
                    <?php include 'inputs_home.php'; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Allocation Status
                </div>
                <div class="panel-body" style="height: 270px">
                    <table class="table table-striped table-hover">
                        <tbody>
                        <tr>
                            <td>Last Allocation Run</td>
                            <td>                               <span
                                        class="badge"><?php echo $last_modified_date; ?></span> <a
                                        href="#">
                            </td>
                        </tr>
                        <tr>
                            <td>Total Number of Graduates</td>
                            <td>                               <span
                                        class="badge"><?php echo $total_number_of_graduates; ?></span> <a
                                        href="#">
                            </td>
                        </tr>

                        <tr>
                            <td>Total Number of Graduates Allocated</td>
                            <td>                               <span
                                        class="badge"><?php echo $total_allocated; ?></span> <a
                                        href="#">
                            </td>
                        </tr>

                        <tr>
                            <td>Total Number of Graduates Not Allocated</td>
                            <td>                               <span
                                        class="badge"><?php echo($total_number_of_graduates - $total_allocated); ?></span>
                                <a
                                        href="#">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><span class="badge"></span>
                                <a
                                        href="#">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><span class="badge"></span>
                                <a
                                        href="#">
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <p></p>

                </div>
            </div>
        </div>
    </div>
</div>

<br/>
<h3 style="text-align: center">Total Number of Workers Requested by Location</h3>
<h4 style="text-align: center">The pie chart is interactive, please hover over a section to see the results</h4>
<div id="requested_donut"></div>
<br/>
<h3 style="text-align: center">Total Number of Workers Allocated by Location</h3>
<h4 style="text-align: center">The pie chart is interactive, please hover over a section to see the results</h4>
<div id="allocated_donut"></div>

<div id="graph"></div>

<script type="text/javascript">
    $(document).ready(function () {
        var workers_requested = <?php echo json_encode($workers_requested) ?>;
        var workers_allocated = <?php echo json_encode($workers_allocated) ?>;

        requested_pie_data = new Array();
        $.each(workers_requested, function (i, elem) {
            requested_pie_data.push({
                value: parseInt(elem[0]),label: elem[1]
            });
        });

        allocated_pie_data = new Array();
        $.each(workers_allocated, function (i, elem) {
            allocated_pie_data.push({
                value: parseInt(elem[0]),label: elem[1]
            });
        });

        Morris.Donut({
            element: 'requested_donut',
            data: requested_pie_data
        });


        Morris.Donut({
            element: 'allocated_donut',
            data: allocated_pie_data
        });
    });
</script>
