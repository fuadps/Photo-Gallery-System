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
                        /*
                        $result_set = User::find_all_users();

                        while($row = mysqli_fetch_array($result_set)) {
                            echo $row['username'] ."<br>";
                        }

                        $found_user = User::find_user_by_id(2);

                        echo $found_user['username'];
                        */

                        $user = new User();
                        $user_info = User::find_user_by_id(2);

                        $user->id = $user_info['id'];
                        $user->username = $user_info['username'];
                        $user->password = $user_info['password'];
                        $user->first_name = $user_info['first_name'];
                        $user->last_name = $user_info['last_name'];

                        echo $user->id;

                        ?>




                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->