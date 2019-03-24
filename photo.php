<?php

include("includes/header.php");

if (empty($_GET['id'])) {
    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

if (isset($_POST['post_comment'])) {
    $comment = new Comment();

    $comment->body = trim($_POST['body']);

    $post_comment = Comment::create_comment($photo->photo_id,$session->user_id,$comment->body);

    if ($post_comment && $post_comment->save()) {
        //redirect("photo.php?id=".$photo->photo_id);
    }
    else {
        $message = "It seems they are problem with posting comment.";
    }
}

$user = User::find_by_id($photo->id);
$comments = Comment::find_the_comments($photo->photo_id);

?>
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo !empty($photo->title) ? $photo->title : "No title"; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo empty($photo->id) ? "Guest" : $user->username; ?></a>
                </p>

                <hr>

                <div class="text-center">
                    <figure class="figure">

                    <!-- Preview Image -->
                    <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="<?php echo $photo->alternate_text; ?>"><br>
                    <figcaption class="figure-caption text-center"><?php echo $photo->caption; ?></figcaption>
                    </figure>
                </div>
                <hr>

                <!-- Post Content -->
                <p class="lead"></p>
                <p><?php echo $photo->description; ?></p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>

                    <?php if(isset($session->user_id)) :  ?>

                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="post_comment" class="btn btn-primary">Submit</button>
                    </form>

                    <?php else : ?>
                        <p>Please <a>login</a> or <a>sign up</a> to comment in this photo.</p>
                    <?php endif;?>

                </div>

                <hr>

                <!-- Posted Comments -->

                <?php foreach($comments as $comment) : ?>
                <?php $user_info = User::find_by_id($comment->id); ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object user_image" src="admin/<?php echo $user_info->image_path(); ?>" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $user_info->username; ?>
                            <small><?php echo date("jS F Y \a\\t g:i a", strtotime($comment->date_post." ".$comment->time_post)); ?></small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center">Copyright &copy; fuadps 2019</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
