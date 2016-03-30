<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Product</span></li>
            </ol>
        </div>
    </header>
	
	<!-- start: page -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Product - Create New</h2>
                </header>
                <form role="form" action="<?php echo $this->config->item('link_product_create'); ?>" method="post" id="product-create" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <label>Price</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="price" id="price" value="<?php echo set_value('price'); ?>">
                                    <?php echo form_error('price', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>URL</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <input type="text" class="form-control" name="url" id="url" value="<?php echo set_value('url'); ?>">
                                    <?php echo form_error('url', '<div class="fontred">', '</div>'); ?>
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
                            <div class="form-group">
                                <label>Movie</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <select class="form-control" name="id_movie" id="id_movie">
										<option value="">-- Select One --</option>
										<?php foreach ($movie_lists as $row) { ?>
										<option value="<?php echo $row->id_movie; ?>"><?php echo ucwords($row->title); ?></option>
										<?php } ?>
									</select>
                                    <?php echo form_error('id_movie', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Brand</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <select class="form-control" name="id_product_brand" id="id_product_brand">
										<option value="">-- Select One --</option>
										<?php foreach ($product_brand_lists as $row) { ?>
										<option value="<?php echo $row->id_product_brand; ?>"><?php echo ucwords($row->name); ?></option>
										<?php } ?>
									</select>
                                    <?php echo form_error('id_product_brand', '<div class="fontred">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-12">Category<span class="fontred"> *</span></label>
                                <div class="col-sm-6">
									<div class="input-group col-sm-12">
										<select class="form-control" name="id_product_category" id="id_product_category">
											<option value="">-- Select One --</option>
											<?php foreach ($product_category_lists as $row) { ?>
											<option value="<?php echo $row->id_product_category; ?>"><?php echo ucwords($row->name); ?></option>
											<?php } ?>
										</select>
										<?php echo form_error('id_product_category', '<div class="fontred">', '</div>'); ?>
									</div>
								</div>
                                <div class="col-sm-6">
									<div class="input-group col-sm-12">
										<select class="form-control" name="id_product_subcategory" id="id_product_subcategory">
											<option value="">-- Select One --</option>
											<?php foreach ($product_subcategory_lists as $row) { ?>
											<option value="<?php echo $row->id_product_subcategory; ?>"><?php echo ucwords($row->name); ?></option>
											<?php } ?>
										</select>
										<?php echo form_error('id_product_subcategory', '<div class="fontred">', '</div>'); ?>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" name="submit" value="Submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Create New
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
