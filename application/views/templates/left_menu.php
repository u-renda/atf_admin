<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="list-item">
                        <a href="<?php echo $this->config->item('link_dashboard'); ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-parent nav-grand" id="grand-member">
                        <a>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Member</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-item"><a href="<?php echo $this->config->item('link_member_lists'); ?>">Lists</a></li>
                            <li class="list-item"><a href="<?php echo $this->config->item('link_member_create'); ?>">Create New</a></li>
                        </ul>
                    </li>
                    <li class="nav-parent nav-grand">
                        <a>
                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                            <span>Movie</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-item"><a href="<?php echo $this->config->item('link_movie_lists'); ?>">Lists</a></li>
                            <li class="list-item"><a href="<?php echo $this->config->item('link_movie_create'); ?>">Create New</a></li>
                            <li class="nav-parent">
                                <a><span>Movie Cast</span></a>
                                <ul class="nav nav-children">
                                    <li class="list-item"><a href="<?php echo $this->config->item('link_movie_cast_lists'); ?>">Lists</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent nav-grand">
                        <a>
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span>Product</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-item"><a href="<?php echo $this->config->item('link_product_lists'); ?>">Lists</a></li>
                            <li class="list-item"><a href="<?php echo $this->config->item('link_product_create'); ?>">Create New</a></li>
                            <li class="nav-parent">
                                <a><span>Product Brand</span></a>
                                <ul class="nav nav-children">
                                    <li class="list-item"><a href="<?php echo $this->config->item('link_product_brand_lists'); ?>">Lists</a></li>
                                    <li class="list-item"><a href="<?php echo $this->config->item('link_product_brand_create'); ?>">Create New</a></li>
                                </ul>
                            </li>
                            <li class="nav-parent">
                                <a><span>Product Category</span></a>
                                <ul class="nav nav-children">
                                    <li class="list-item"><a href="<?php echo $this->config->item('link_product_category_lists'); ?>">Lists</a></li>
                                    <li class="list-item"><a href="<?php echo $this->config->item('link_product_category_create'); ?>">Create New</a></li>
                                </ul>
                            </li>
                            <li class="nav-parent">
                                <a><span>Product Flag</span></a>
                                <ul class="nav nav-children">
                                    <li class="list-item"><a href="<?php echo $this->config->item('link_product_flag_lists'); ?>">Lists</a></li>
                                    <li class="list-item"><a href="<?php echo $this->config->item('link_product_flag_create'); ?>">Create New</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                            <span>Admin</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="list-item"><a href="<?php echo $this->config->item('link_admin_lists'); ?>">Lists</a></li>
                            <li class="list-item"><a href="<?php echo $this->config->item('link_admin_create'); ?>">Create New</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
<!-- end: sidebar -->