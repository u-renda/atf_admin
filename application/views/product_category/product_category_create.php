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
    <div class="row" id="page_product_category_create">
        <div class="col-sm-12">
            <div class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Product Category - Create New</h2>
                </header>
                <form role="form" action="<?php echo $this->config->item('link_product_category_create'); ?>" method="post" id="form-product-category-create">
                    <div class="panel-body">
                        <div class="form-body">
                            <div class="fontred"><?php if ($create_error) { print_r($create_error); } ?></div>
                            <div class="form-group">
                                <label>Name</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>">
                                    <?php echo form_error('name', '<div class="fontred">', '</div>'); ?>
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
