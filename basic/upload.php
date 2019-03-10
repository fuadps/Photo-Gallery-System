<?php

if (isset($_POST['submit'])) {
    print_r($_FILES['file_upload']);

    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    if ($_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['file_upload']['name'],__DIR__);
    }
    else {
        echo $phpFileUploadErrors[$_FILES['file_upload']['error']];
    }


}

?>

<!DOCTYPE html>
<html>

<form action="upload.php" enctype="multipart/form-data" method="post">
    <input type="file" name="file_upload"/>
    <input type="submit" name="submit"/>
</form

</html>