<?php require_once("admin/includes/init.php"); ?>

<?php 

if (isset($_POST['signup'])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);

    $check_user = User::check_username($username);

    if (!$check_user) {
        $signup_user = new User();

        $signup_user->username = $username;
        $signup_user->password = $password;
        $signup_user->first_name = $first_name;
        $signup_user->last_name = $last_name;

        if ($signup_user->save()) {
            $user_found = User::verify_user($signup_user->username,$signup_user->password);

            if ($user_found) {
                $session->login($user_found);
                redirect("index.php");
            }
        } 
        else {
            $the_message = "They seems a problem with your account register.";
        }
    
    }
    else {
        $the_message = "Username already been taken.";
    }
}
else {
    $username = "";
    $password = "";
    $first_name = "";
    $last_name = "";
    $the_message = "";
}

?>

<?php if (!$session->is_signed_in()) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="signup">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Sign Up</h5>
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
                    <label for="first name">First Name</label>
                    <input type="text" class="form-control" name="password" value="<?php echo htmlentities($first_name); ?>">   
                </div>

                <div class="form-group">
                    <label for="last name">Last Name</label>
                    <input type="text" class="form-control" name="password" value="<?php echo htmlentities($last_name); ?>">   
                </div>
                
                <div class="form-group">
                    <input type="submit" name="signup" value="Sign Up" class="btn btn-primary">
                </div>
                </form>    

            </div>
            <div class="modal-footer">
                <p class="text-center"><a href="" data-dismiss="modal">Already have an account? Log In!</a></p>
            </div>
        </div>
    </div>
</div>

<?php endif ?>
