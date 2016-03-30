<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Events - Edit</h3>
            </div>
            <div class="panel-body">
                <form role="form" action="events_edit" method="post" id="events-edit">
                    <input type="hidden" id="id" name="id" value="<?php echo $events->id_events; ?>"/>
                    <input type="hidden" id="title_default" name="title_default" value="<?php echo $events->title; ?>"/>
                    <div class="form-body padding10">
                        <div class="fontred"><?php if ($create_error) { print_r($create_error); } ?></div>
                        <div class="form-group">
                            <label>Title</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title', ucwords($events->title)); ?>">
                                <?php echo form_error('title', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group check-event">
                            <label>Date</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12 date">
                                <input type="text" class="form-control" name="date" id="date" value="<?php echo set_value('date', date('d M Y', strtotime($events->date))); ?>">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                <?php echo form_error('date', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="submit" value="Submit" class="btn blue">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>