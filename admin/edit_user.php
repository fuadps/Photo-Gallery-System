<?php include("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php") ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if (isset($_POST['update'])) {

    if ($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];

        if (empty($_FILES['user_image'])) {
            $user->save();
            redirect("users.php");
        } else {
            $user->delete_photo();
            $user->set_files($_FILES['user_image']);
            $user->upload_image();
            $user->save();
        }

    }
    
}

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->

        </nav>

        <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users
                        <small>Subheading</small>
                    </h1>

                    <div class="col-md-4">
                        <a href="" data-toggle="modal" data-target="#photo-modal"><img id="user-image" class="img-responsive" src="<?php echo $user->image_path(); ?>" alt=""></a> 
                    </div>

                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="user image">Image</label>
                            <input type="file" name="user_image"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="first name">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="last name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>"/>
                        </div>

                        <div class="form-group">
                            <a id="user-id" class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                            <input type="submit" name="update" class="btn btn-primary pull-right"/>
                        </div>
                    </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>