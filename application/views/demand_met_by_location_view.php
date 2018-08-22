<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>

    <div class="list-group">
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Demand Met By Location</h4>
        </a>
    </div>
</div>

<div class="row">
<script type="text/javascript">

    var demand_met_by_location = <?php echo json_encode($demand_met_by_location) ?>;

    $(function () {
        $("#output").pivotUI(demand_met_by_location);
    });

</script>

<div id="output" style="margin: 30px;"></div>
</div>