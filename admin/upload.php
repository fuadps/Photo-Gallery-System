<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in() || !$session->check_role(2)) {redirect("login.php");} ?>

<?php

$message = "";
if (isset($_POST['submit'])) {
    $photo = new Photo();

    $photo->title = $_POST['title'];
    $photo->set_files($_FILES['file_upload']);
    
    if ($photo->save()) {
        $message = "Photo upload successfully.";
    }
    else {
        $message = join("<br>",$photo->errors);
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
                        Upload
                        <small>Photo</small>
                    </h1>
                    <div class="col-md-6">
                        <form action="upload.php" method="post" enctype="multipart/form-data" >
                        
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <input type="file" name="file_upload"/>
                        </div>
                        
                        <input type="submit" name="submit"/>
                        <?php echo $message; ?>
                        </form>
                    </div>
                    
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>