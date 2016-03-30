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
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-featured">
				<header class="panel-heading">
					<h3 class="panel-title">Movie Cast - Lists</h3>
				</header>
				<div class="panel-body">
					<form class="row marginbottom15" id="form-movie-cast-lists">
						<div class="form-group col-sm-3">
							<select class="form-control" name="id_movie" id="id_movie">
								<option value="">-- All Movie --</option>
								<?php
								foreach ($movie_lists as $row)
								{
									echo '<option value="'.$row->id_movie.'"';
									if ($row->id_movie == $id_movie)
									{
										echo 'selected="selected"';
									}
									echo '>'.ucwords($row->title).'</option>';
								} ?>
							</select>
						</div>
						<input type="submit" class="btn btn-primary" value="Submit" />
					</form>
					<div class="clearfix"></div>
					<div id="grid_movie_cast_lists"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
</section>