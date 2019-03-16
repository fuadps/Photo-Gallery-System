<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php  

if (empty($_GET['id'])) {
    redirect("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if ($comment) {
    if ($comment->delete());
    $session->message = ("The comment with {$comment->comment_id} has been deleted");
    redirect("comments.php");
}
else {
    redirect("comments.php");
}

?>