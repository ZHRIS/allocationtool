<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Upload Static File</legend>

        <fieldset>
            <?php echo $error; ?>

            <?php echo form_open_multipart('setting/do_static_upload'); ?>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="type_name" class="control-label m">File *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input type="file" name="userfile" size="20"/>
                    </div>
                </div>
            </div>

            <br/>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="type_name" class="control-label m">Type Of Data *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">

                        <?php
                        $attributes = 'class = "form-control" id = "type_name"';
                        echo form_dropdown('type_list', $type_list, set_value('name'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('type_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">

                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input type="submit" value="Upload"/>
                    </div>
                </div>
            </div>

            </form>

        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>


<div class="row">

    <div class="panel-body">
        <a href="<?php echo site_url('setting/worker_type_template_csv'); ?>"
           class="list-group-item"
           title=" Worker Type ">
            <h4 class="list-group-item-heading">Download Worker Type Template</h4>

            <p class="list-group-item-text">Enter Worker type name in first column only.<i
                        class="glyphicon glyphicon-info-sign"></i></p>

        </a>


        <a href="<?php echo site_url('setting/worker_level_template_csv'); ?>"
           class="list-group-item"
           title=" Worker Level ">
            <h4 class="list-group-item-heading">Download Worker Level Template</h4>

            <p class="list-group-item-text">Enter Worker Level name in first column only.<i
                        class="glyphicon glyphicon-info-sign"></i></p>

        </a>

        <a href="<?php echo site_url('setting/study_location_template_csv'); ?>"
           class="list-group-item"
           title=" Study Location ">
            <h4 class="list-group-item-heading">Download Study location Template</h4>

            <p class="list-group-item-text">Enter Study Location name in first column only.<i
                        class="glyphicon glyphicon-info-sign"></i></p>

        </a>


        <a href="<?php echo site_url('setting/demand_location_template_csv'); ?>"
           class="list-group-item"
           title=" Demand Location ">
            <h4 class="list-group-item-heading">Download Demand Location Template</h4>

            <p class="list-group-item-text">Enter Demand Location name in first column only and upload file.<i
                        class="glyphicon glyphicon-info-sign"></i></p>

        </a>


        <a href="<?php echo site_url('setting/worker_demand_template_csv'); ?>"
           class="list-group-item"
           title=" Worker Demand ">
            <h4 class="list-group-item-heading">Download Worker Demand Template</h4>

            <p class="list-group-item-text">Enter Demand Location Name, Worker type and Total Demand required.<i
                        class="glyphicon glyphicon-info-sign"></i></p>

        </a>

    </div>
</div>
