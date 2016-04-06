<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs marginright20">
                <li>
                    <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row" id="page_dashboard">
        <div class="col-md-6 col-lg-12 col-xl-6">
            <div class="row">
                <!-- Total Member -->
                <div class="col-md-12 col-lg-4 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-primary">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Member</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $total_member; ?></strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase hand-pointer" href="<?php echo $this->config->item('link_member_lists'); ?>">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Total Movie -->
                <div class="col-md-12 col-lg-4 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-secondary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-secondary">
                                        <i class="fa fa-video-camera"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Movie</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $total_movie; ?></strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase hand-pointer" href="<?php echo $this->config->item('link_movie_lists'); ?>">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Total Product -->
                <div class="col-md-12 col-lg-4 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-tertiary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-tertiary">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Product</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $total_product; ?></strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase hand-pointer" href="<?php echo $this->config->item('link_product_lists'); ?>">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end: page -->
</section>