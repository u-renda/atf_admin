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
    <div class="row" id="page_product_create">
        <div class="col-sm-12">
            <div class="panel panel-featured">
                <header class="panel-heading">
                    <h2 class="panel-title">Product - Create New</h2>
					<p class="panel-subtitle">
						<?php
						if (isset($movie_cast) == TRUE)
						{
							echo 'Movie Cast: '.ucwords($movie_cast->cast).' - '.ucwords($movie_cast->actor).'<br />';
							echo 'Movie: '.ucwords($movie_cast->movie->title);
						}
						?>
					</p>
                </header>
                <form role="form" action="<?php echo $this->config->item('link_product_create'); ?>" method="post" id="form-product-create" enctype="multipart/form-data">
                    <input type="hidden" name="id_movie_cast" value="<?php echo $id_movie_cast; ?>">
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
                                <label>Brand</label><span class="fontred"> *</span>
                                <div class="input-group col-sm-12">
                                    <select class="form-control" name="id_product_brand" id="id_product_brand">
										<option value="">-- Select One --</option>
										<?php foreach ($product_brand_lists as $row) { ?>
										<option value="<?php echo $row->id_product_brand; ?>" <?php echo  set_select('id_product_brand', $row->id_product_brand); ?>><?php echo ucwords($row->name); ?></option>
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
											<option value="">-- Select Category --</option>
											<?php foreach ($product_category_lists as $row) { ?>
											<option value="<?php echo $row->id_product_category; ?>" <?php echo  set_select('id_product_category', $row->id_product_category); ?>><?php echo ucwords($row->name); ?></option>
											<?php } ?>
										</select>
										<?php echo form_error('id_product_category', '<div class="fontred">', '</div>'); ?>
									</div>
								</div>
                                <div class="col-sm-6">
									<div class="input-group col-sm-12">
										<select class="form-control" name="id_product_subcategory" id="id_product_subcategory">
											<option value="">-- Select Subcategory --</option>
											<?php foreach ($product_subcategory_lists as $row) { ?>
											<option value="<?php echo $row->id_product_subcategory; ?>" <?php echo set_select('id_product_subcategory', $row->id_product_subcategory); ?>><?php echo ucwords($row->name); ?></option>
											<?php } ?>
										</select>
										<?php echo form_error('id_product_subcategory', '<div class="fontred">', '</div>'); ?>
									</div>
								</div>
                            </div>
                            <div class="form-group">
                                <label>Matched</label>
                                <?php foreach ($code_product_matched as $key => $val) { ?>
                                <div class="radio-custom">
                                    <input type="radio" class="form-control" name="matched" id="matched" value="<?php echo $key; ?>" <?php echo set_radio('matched', $key); if ($key == 0) { echo 'checked="checked"'; } ?>>
                                    <label><?php echo ucwords($val); ?></label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" name="submit_another" value="Submit" class="btn btn-info"> Create Another Product </button>
                                <button type="submit" name="submit" value="Submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Finish Create
                                </button>
								<button type="reset" class="btn btn-default">Reset</button>
								<a type="button" class="btn btn-danger" href="<?php echo $this->config->item('link_product_lists'); ?>">Cancel</a>
                            </div>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    </div>
	<!-- end: page -->
</section>
