<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Category</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Product</span></li>
                <li><span>Product Category</span></li>
            </ol>
        </div>
    </header>
	
	<!-- start: page -->
	<div class="row" id="page_product_category_lists">
		<div class="col-sm-12">
			<div class="panel panel-featured">
				<header class="panel-heading">
					<h3 class="panel-title">Product Category - Lists</h3>
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
					<div id="grid_product_category_lists"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
</section>