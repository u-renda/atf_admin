<section role="main" class="content-body">
    <header class="page-header">
        <h2>Admin</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
            </ol>
        </div>
    </header>
    
    <div class="row" id="page_admin_edit">
        <div class="col-sm-12">
            <div class="panel panel-featured">
                <header class="panel-heading">
                    <h3 class="panel-title">Admin - Edit</h3>
                </header>
                <form role="form" action="<?php echo $this->config->item('link_admin_edit'); ?>" method="post" enctype="multipart/form-data" id="form-admin-edit">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="username_default" value="<?php echo $admin->username; ?>">
                    <input type="hidden" name="email_default" value="<?php echo $admin->email; ?>">
                    <input type="hidden" name="name_default" value="<?php echo $admin->name; ?>">
                    <div class="panel-body">
                        <div class="form-body col-sm-6">
                            <div class="fontred"><?php if ($create_error) { print_r($create_error); } ?></div>
                            <div class="form-group">
                                <label class="control-label">Name</label><span class="fontred"> *</span>
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
                                <label>Username</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username', $admin->username); ?>">
                                    <?php echo form_error('username', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group col-sm-12">
                                    <input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password'); ?>">
                                    <span class="help-block">Kosongkan password jika tidak ada perubahan</span>
                                    <?php echo form_error('password', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Photo</label>
                                <div class="input-group col-sm-12">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fa fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileupload-exists">Change</span>
                                                <span class="fileupload-new">Select file</span>
                                                <input type="file" name="photo" id="photo" />
                                            </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                    <?php echo form_error('photo', '<div class="fontred">', '</div>'); ?>
                                </div>
                                <span class="help-block">Kosongkan foto jika tidak ada perubahan</span>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" name="submit" value="Submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Update
                                </button>
                                <a href="<?php echo $this->config->item('link_admin_lists'); ?>" type="button" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    </div>
    <!-- end: page -->
</section>