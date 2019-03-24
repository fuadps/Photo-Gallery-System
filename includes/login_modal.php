<?php require_once("admin/includes/init.php"); ?>

<?php 

if (isset($_POST['submit'])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $user_found = User::verify_user($username,$password);

    if ($user_found) {
        $session->login($user_found);
        redirect("index.php");
    }
    else {
        $the_message = "Wrong username or password.";
    }
}
else {
    $username = "";
    $password = "";
    $the_message = "";
}

?>

<?php if (!$session->is_signed_in()) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="login">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Log In</h5>
            </div>
            <div class="modal-body">
                
            <h4 class="bg-danger"><?php echo $the_message; ?></h4>
            
                <form id="login-form" action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">   
                </div>
                
                
                <div class="form-group">
                    <input type="submit" name="submit" value="Log In" class="btn btn-primary">
                </div>
                </form>    

            </div>
            <div class="modal-footer">
                <p class="text-center"><a href="" class="text-center" data-toggle="modal" data-target="#signup">Not on Photo Gallery System yet? Sign Up!</a></p>
            </div>
        </div>
    </div>
</div>
<?php endif ?>