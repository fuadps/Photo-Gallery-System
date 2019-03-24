<?php //if (!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

$message = "";
if (isset($_POST['upload'])) {
    $photo = new Photo();

    $photo->title = $_POST['title'];
    $photo->caption = $_POST['caption'];
    $photo->alternate_text = $_POST['alternate_text'];
    $photo->description = $_POST['description'];
    $photo->set_files($_FILES['file_upload'],$session->is_signed_in() ? $session->user_id : 0);
    
    if ($photo->save()) {
        $message = "Photo upload successfully.";
    }
    else {
        $message = join("<br>",$photo->errors);
    }
}

?>

<div class="modal fade" tabindex="-1" role="dialog" id="upload">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Photo Upload</h5>
            </div>
            <div class="modal-body">
                    
                <form action="" method="post" enctype="multipart/form-data" >
                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control"/>
                </div>

                <div class="form-group">
                    <input type="file" name="file_upload"/>
                </div>

                <div class="form-group">
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" class="form-control">
                </div>

                <div class="form-group">
                    <label for="caption">Alternate Text</label>
                    <input type="text" name="alternate_text" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="caption">Description</label>
                    <textarea name="description" id="summernote" cols="30" rows="10" class="form-control"></textarea>
                </div>
                
                <input type="submit" class="btn btn-primary" name="upload"/>
                <?php echo $message; ?>
                </form>   

            </div>
        </div>
    </div>
</div>