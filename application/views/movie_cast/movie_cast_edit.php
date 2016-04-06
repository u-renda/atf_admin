<section role="main" class="content-body">
    <header class="page-header">
        <h2>Movie Cast</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Movie</span></li>
                <li><span>Movie Cast</span></li>
            </ol>
        </div>
    </header>
	
	<!-- start: page -->
    <div class="row" id="page_movie_cast_edit">
        <div class="col-sm-12">
            <div class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Movie Cast - Edit</h2>
					<p class="panel-subtitle">
						<?php
						if (isset($movie_cast) == TRUE)
						{
							echo 'Movie: '.ucwords($movie_cast->movie->title);
						}
						?>
					</p>
                </header>
                <form role="form" action="<?php echo $this->config->item('link_movie_cast_edit'); ?>" method="post" id="form-movie-cast-edit" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="panel-body">
                        <div class="form-body">
                            <div class="fontred"><?php if ($create_error) { print_r($create_error); } ?></div>
                            <div class="form-group">
                                <label>Actor Name</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="actor" id="actor" value="<?php echo set_value('actor', ucwords($movie_cast->actor)); ?>">
                                    <?php echo form_error('actor', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Cast As</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="cast" id="cast" value="<?php echo set_value('cast', ucwords($movie_cast->cast)); ?>">
                                    <?php echo form_error('cast', '<div class="fontred">', '</div>'); ?>
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
                                <a href="<?php echo $this->config->item('link_movie_cast_lists'); ?>" type="button" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    </div>
	<!-- end: page -->
</section>
