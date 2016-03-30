<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Admin - Edit</h3>
            </div>
            <div class="panel-body">
                <form role="form" action="admin_edit" method="post" enctype="multipart/form-data" id="admin-edit">
                    <input type="hidden" id="id" name="id" value="<?php echo $admin->id_admin; ?>"/>
                    <input type="hidden" id="email_default" name="email_default" value="<?php echo $admin->email; ?>"/>
                    <input type="hidden" id="name_default" name="name_default" value="<?php echo $admin->name; ?>"/>
                    <input type="hidden" id="username_default" name="username_default" value="<?php echo $admin->username; ?>"/>
                    <div class="form-body padding10">
                        <div class="fontred"><?php if ($create_error) { print_r($create_error); } ?></div>
                        <div class="form-group">
                            <label>Username</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username', $admin->username); ?>">
                                <?php echo form_error('username', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Name</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name', ucwords($admin->name)); ?>">
                                <?php echo form_error('name', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email', $admin->email); ?>">
                                <?php echo form_error('email', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Admin Initial</label>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="admin_initial" id="admin_initial" value="<?php echo set_value('admin_initial', $admin->admin_initial); ?>">
                                <?php echo form_error('admin_initial', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <div class="input-group col-sm-12">
                                <input type="file" class="form-control" name="photo" id="photo">
                                <?php echo form_error('photo', '<div class="fontred">', '</div>'); ?>
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