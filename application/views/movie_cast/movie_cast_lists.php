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
	<div class="row" id="page_movie_cast_lists">
		<div class="col-sm-12">
			<div class="panel panel-featured">
				<header class="panel-heading">
					<h3 class="panel-title">Movie Cast - Lists</h3>
					<p class="panel-subtitle">
						<?php
						if (isset($movie) == TRUE)
						{
							echo 'Movie: '.ucwords($movie->title);
						}
						?>
					</p>
				</header>
				<div class="panel-body">
					<?php if ($alert == TRUE) { ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="fa fa-times"></i>
						</button>
						<strong><?php echo $alert; ?></strong>
					</div>
					<div class="clearfix"></div>
					<?php } ?>
					<form>
						<input type="hidden" name="id_movie" id="id_movie" value="<?php echo $id_movie; ?>">
					</form>
					<div class="clearfix"></div>
					<div id="grid_movie_cast_lists"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
</section>