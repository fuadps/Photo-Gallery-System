    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Photo Gallery</a>
            </div>
            <ul class="nav navbar-right top-nav">
            <?php if ($session->is_signed_in()) : ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $session->username;?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>

            <?php else : ?>
                <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">Log In</button></li>
            <?php endif; ?>
            </ul>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#upload">Upload</a>
                    </li>
                    <?php if ($session->is_signed_in() && $session->check_role(2)) : ?>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#upload">Admin</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
            