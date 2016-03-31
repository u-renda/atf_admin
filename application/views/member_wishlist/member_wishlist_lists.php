<section role="main" class="content-body">
    <header class="page-header">
        <h2>Member Wishlists</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Member</span></li>
                <li><span>Member Wishlists</span></li>
            </ol>
        </div>
    </header>
	
	<!-- start: page -->
	<div class="row" id="page_member_wishlist_lists">
		<div class="col-sm-12">
			<div class="panel panel-featured">
				<header class="panel-heading">
					<h3 class="panel-title">Member Wishlists - Lists</h3>
					<p class="panel-subtitle">
						<?php
						if (isset($member) == TRUE)
						{
							echo 'Member: '.ucwords($member->name);
						}
						else
						{
							echo 'Product: '.ucwords($product->name);
						}
						?>
					</p>
				</header>
				<div class="panel-body">
					<form>
						<input type="hidden" name="id_member" id="id_member" value="<?php echo $id_member; ?>">
						<input type="hidden" name="id_product" id="id_product" value="<?php echo $id_product; ?>">
					</form>
					<div class="clearfix"></div>
					<div id="grid_member_wishlist_lists"></div>
					<div class="clearfix"></div>
					<div class="row margintop15">
						<div class="col-sm-12">
							<a href="<?php echo $back_button; ?>" type="button" class="btn btn-default">Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
</section>