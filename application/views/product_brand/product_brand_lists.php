<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Brand</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Product</span></li>
                <li><span>Product Brand</span></li>
            </ol>
        </div>
    </header>
	
	<!-- start: page -->
	<div class="row" id="page_product_brand_lists">
		<div class="col-sm-12">
			<div class="panel panel-featured">
				<header class="panel-heading">
					<h3 class="panel-title">Product Brand - Lists</h3>
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
					<div id="grid_product_brand_lists"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
</section>