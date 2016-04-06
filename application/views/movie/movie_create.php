<section role="main" class="content-body">
    <header class="page-header">
        <h2>Movie</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Movie</span></li>
            </ol>
        </div>
    </header>
	
	<!-- start: page -->
    <div class="row" id="page_movie_create">
        <div class="col-sm-12">
            <div class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Movie - Create New</h2>
                </header>
                <form role="form" action="<?php echo $this->config->item('link_movie_create'); ?>" method="post" id="form-movie-create" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="form-body col-sm-6">
                            <div class="fontred"><?php if ($create_error) { print_r($create_error); } ?></div>
                            <div class="form-group">
                                <label>Title</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>">
                                    <?php echo form_error('title', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Photo</label><span class="fontred"> *</span>
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
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" name="submit" value="Submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Create New
                                </button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    </div>
	<!-- end: page -->
</section>
