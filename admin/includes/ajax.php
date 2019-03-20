<?php 
require_once("init.php");

$user = new User;

if (isset($_POST['image_name']) && isset($_POST['user_id'])) {
    $user->ajax_save_image($_POST['image_name'],$_POST['user_id']);
}

if (isset($_POST['photo_id'])) {
    global $database;
    $photo_id = $database->escape_string($_POST['photo_id']);
    $photo = Photo::find_by_id($photo_id);

    echo "<a href='#' class='thumbnail'><img width='100' src={$photo->picture_path()}></a>";
    echo "<p>{$photo->filename}</p>";
    echo "<p>{$photo->type}</p>";
    echo "<p>{$photo->size}</p>";
}

?>