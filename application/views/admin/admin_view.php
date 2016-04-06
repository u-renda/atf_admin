<div class="marginbottom15">
    <form class="form-horizontal" id="form-product-view">
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label"><strong>Name</strong></label>
                <div class="col-md-9">
                    <p class="form-control-static">
                        <?php echo ucwords($result->name); ?>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><strong>Email</strong></label>
                <div class="col-md-9">
                    <p class="form-control-static"><?php echo $result->email; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><strong>Username</strong></label>
                <div class="col-md-9">
                    <p class="form-control-static"><?php echo $result->username; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><strong>Photo</strong></label>
                <div class="col-md-9">
                    <img src="<?php echo $result->photo; ?>" width="100%">
                </div>
            </div>
        </div>
    </form>
</div>
<div class="form-button right paddingtop15 border-top1">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>