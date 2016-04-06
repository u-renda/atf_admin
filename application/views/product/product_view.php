<div class="marginbottom15">
    <form class="form-horizontal" id="form-product-view">
        <div class="form-body">
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-product-view-product" data-toggle="tab">Product</a></li>
                    <li><a href="#tab-product-view-movie" data-toggle="tab">Movie</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-product-view-product" class="tab-pane active">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Name</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php
                                    echo ucwords($result->name);
                                    if ($result->matched == 1)
                                    {
                                        echo ' <span class="label label-success" title="Matched"><i class="fa fa-thumbs-up"></i></span>';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Price</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?php echo 'Rp '.number_format($result->price,0,'','.'); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Matched</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?php echo $result->matched; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Url</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?php echo $result->url; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Product Brand</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?php echo $result->brand->name; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Product Category</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?php echo $result->category->name.' - '.$result->subcategory->name; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Photo</strong></label>
                            <div class="col-md-9">
                                <img src="<?php echo $result->photo; ?>" width="100%">
                            </div>
                        </div>
                    </div>
                    <div id="tab-product-view-movie" class="tab-pane">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Movie Title</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?php echo ucwords($result->movie->title); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Cast as</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?php echo ucwords($result->movie_cast->cast); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Actor Name</strong></label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?php echo ucwords($result->movie_cast->actor); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Photo</strong></label>
                            <div class="col-md-9">
                                <img src="<?php echo $result->movie_cast->photo; ?>" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="form-button right paddingtop15 border-top1">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>