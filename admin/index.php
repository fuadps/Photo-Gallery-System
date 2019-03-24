<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in() || !$session->check_role(2)) {redirect("login.php");} ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->

        </nav>

        <div id="page-wrapper">
            <?php include("includes/admin_content.php");  ?>
            <?php print_r($session);"<br>".print_r($_SESSION);echo !$session->check_role(2) ? "true" : "false"; echo !$session->is_signed_in() ? "true" : "false" ?>
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>