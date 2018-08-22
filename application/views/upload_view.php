<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">

    <div id="processing_div" class="panel panel-primary" style="display:none;">
        <div class="panel-heading">
            <h3>Uploading Data. Please Wait . . .
                <img src="<?php echo base_url("/assets/images/loading.gif"); ?>" width="60" height="60"/>
            </h3>
        </div>
    </div>

    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <h4><a href="<?php echo site_url('setting/download_template_csv'); ?>" class="btn btn-lg btn-primary"
               style="float: right;">Download Template File</a></h4>
        <legend>Upload File</legend>

        <fieldset>
            <?php echo $error; ?>

            <?php echo form_open_multipart('setting/do_upload'); ?>

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

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">

                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input onclick="run_glpk_csv()" type="submit" value="Upload"/>
                    </div>
                </div>
            </div>

            </form>

        </fieldset>
        <?php echo form_close(); ?>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Date & Time</th>
                <th>Records uploaded</th>
                <th>Records not uploaded</th>
                <th>Uploaded by</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($upload_list as $item): ?>
                <tr>
                    <td><?php echo $item->upload_date; ?></td>
                    <td><?php echo $item->records_uploaded; ?></td>
                    <td><?php echo $item->records_notuploaded; ?></td>
                    <td><?php echo $item->upload_by; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

