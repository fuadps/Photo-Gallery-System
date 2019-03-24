<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in() || !$session->check_role(2)) {redirect("login.php");} ?>

<?php 


if (empty($_GET['id'])) {
    redirect("comments.php");
}

$comments = Comment::find_the_comments($_GET['id']);

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
                        Comments
                    </h1>
                    <!-- <a href="add_user.php" class="btn btn-primary">Add User</a> -->
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Body</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($comments as $comment) : ?>
                            <?php $user_info = User::find_by_id($comment->id); ?>
                                <tr>
                                    <td><?php echo $comment->comment_id ;?></td>
                                    <td><?php echo $user_info->username ;?>
                                        <div class="action_links">
                                            <a class="delete_links" href="delete_comment_photo.php?id=<?php echo $comment->comment_id ?>">Delete</a>
                                        </div>
                                    </td>
                                    <td><?php echo $comment->body ;?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>