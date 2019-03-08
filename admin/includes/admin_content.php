<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>

                        <?php 

                        $users = User::find_all_users();

                        foreach ($users as $user) {
                            echo $user->first_name ."<br>";
                        }

                        $user_info = User::find_user_by_id(2);

                        echo $user_info->username;

                        ?>




                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->