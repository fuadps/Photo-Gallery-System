<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php  

if (empty($_GET['id'])) {
    redirect("photos.php");
}

$user = User::find_by_id($_GET['id']);

if ($user) {
    if ($user->delete());
    $session->message = ("The comment with {$user->id} has been deleted");
    redirect("users.php");
}
else {
    redirect("users.php");
}

?>