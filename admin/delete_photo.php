<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in() || !$session->check_role(2)) {redirect("login.php");} ?>

<?php  

if (empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);

if ($photo) {
    $photo->delete_photo();
    $session->message = ("The comment with {$photo->photo_id} has been deleted");
    redirect("photos.php");
}
else {
    redirect("photos.php");
}

?>