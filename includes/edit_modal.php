<?php if ($session->is_signed_in()) : ?>
<?php

$user = User::find_by_id($session->user_id);

$message = "";
if (isset($_POST['update'])) {
    
    if ($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];

        if (empty($_FILES['user_image'])) {
            $user->save();
        } else {
            $user->delete_photo();
            $user->set_files($_FILES['user_image']);
            $user->upload_image();
            $user->save();
        }
    }
}

?>

<div class="modal fade" tabindex="-1" role="dialog" id="edit_profile">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Profile Update</h5>
            </div>
            <div class="modal-body">
            <div class="row">
            <div class="col-lg-12">
            <div class="col-md-4">
                <img id="user-image" class="img-responsive" src="admin/<?php echo $user->image_path(); ?>" alt="">
            </div>

            <form action="" method="post" enctype="multipart/form-data">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>"/>
                </div>

                <div class="form-group">
                    <label for="user image">Profile Image</label>
                    <input type="file" name="user_image"/>
                </div>
                
                <div class="form-group">
                    <label for="first name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>"/>
                </div>

                <div class="form-group">
                    <label for="last name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>"/>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>"/>
                </div>

                <div class="form-group">
                    <input type="submit" name="update" class="btn btn-primary pull-right" value="Update"/>
                </div>
            </div>
            </form>

            </div>
        </div>
            </div>
        </div>
    </div>
</div>
<?php endif ?>