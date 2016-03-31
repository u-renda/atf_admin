<section role="main" class="content-body">
    <header class="page-header">
        <h2>Member</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Member</span></li>
            </ol>
        </div>
    </header>
	
	<!-- start: page -->
    <div class="row" id="page_member_edit">
        <div class="col-sm-12">
            <div class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Member - Edit</h2>
                </header>
                <form role="form" action="<?php echo $this->config->item('link_member_edit'); ?>" method="post" id="member-edit">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="email_default" value="<?php echo $member->email; ?>">
                    <input type="hidden" name="name_default" value="<?php echo $member->name; ?>">
                    <div class="panel-body">
                        <div class="form-body">
                            <div class="fontred"><?php if ($create_error) { print_r($create_error); } ?></div>
                            <div class="form-group">
                                <label>Name</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name', ucwords($member->name)); ?>">
                                    <?php echo form_error('name', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email', $member->email); ?>">
                                    <?php echo form_error('email', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gender</label><span class="fontred"> *</span>
                                <?php foreach ($code_member_gender as $key => $val) { ?>
                                <div class="radio-custom">
                                    <input type="radio" class="form-control" name="gender" id="gender" value="<?php echo $key; ?>" <?php echo set_radio('gender', $key); if ($member->gender == $key) { echo 'checked'; } ?>>
                                    <label><?php echo ucwords($val); ?></label>
                                </div>
                                <?php }
                                echo form_error('gender', '<div class="fontred">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Birthday</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" data-plugin-datepicker name="birthday" id="birthday" value="<?php echo set_value('birthday', date('d-m-Y', strtotime($member->birthday))); ?>" data-date-format="dd-mm-yyyy">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <?php echo form_error('birthday', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group col-sm-12">
                                    <input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password'); ?>">
                                    <?php echo form_error('password', '<div class="fontred">', '</div>'); ?>
                                </div>
                                <span class="help-block">Kosongkan password jika tidak ada perubahan</span>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" name="submit" value="Submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Create New
                                </button>
                                <a href="<?php echo $this->config->item('link_member_lists'); ?>" type="button" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    </div>
	<!-- end: page -->
</section>
