<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in() || !$session->check_role(2)) {redirect("login.php");} ?>

<?php  

if (empty($_GET['id'])) {
    redirect("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if ($comment) {
    if ($comment->delete());
    $session->message = ("The comment with {$comment->comment_id} has been deleted");
    redirect("comment_photo.php?id={$comment->photo_id}");
}
else {
    redirect("comment_photo.php?id={$comment->photo_id}");
}

?>