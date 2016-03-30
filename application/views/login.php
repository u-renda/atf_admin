<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?php echo $this->config->item('title'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images').'/icon.png'; ?>">
    <title><?php echo 'Login - '.$this->config->item('title'); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css').'/bootstrap.min.css'; ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/css').'/font-awesome.min.css'; ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css').'/login.css'; ?>" rel="stylesheet">
</head>
<body>
    <section class="body-sign">
        <div class="center-sign">
            <a href="#" class="logo pull-left">
                <img src="<?php echo base_url('assets/images').'/logo.png'; ?>" height="54" alt="<?php echo $this->config->item('title'); ?>">
            </a>
            <div class="panel panel-sign">
                <div class="panel-title-sign mt-xl text-right">
                    <h2 class="title text-uppercase text-weight-bold m-none">
                        <i class="fa fa-user mr-xs"></i> Sign In
                    </h2>
                </div>
                <div class="panel-body">
                    <form action="<?php echo $this->config->item('link_login'); ?>" method="post">
                        <div class="form-group mb-lg">
                            <label>Username</label>
                            <div class="input-group input-group-icon">
                                <input name="username" type="text" class="form-control input-lg">
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group mb-lg">
                            <label>Password</label>
                            <div class="input-group input-group-icon">
                                <input name="password" type="password" class="form-control input-lg">
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="text-danger"><?php echo validation_errors(); ?></div>
                        <div class="row mb-lg">
                            <div class="col-sm-4">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center text-muted mt-md mb-md">&copy Copyright <?php echo date('Y'); ?>. All Rights Reserved.</p>
        </div>
    </section>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url('assets/js').'/jquery.js'; ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('assets/js').'/bootstrap.min.js'; ?>"></script>
    <!-- Custom -->
    <script src="<?php echo base_url('assets/js').'/login.js'; ?>"></script>
</body>
</html>
