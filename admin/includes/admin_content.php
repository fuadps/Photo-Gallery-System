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

                        $photos = Photo::find_all();

                        foreach ($photos as $photo) {
                            echo $photo->title ."<br>";
                        }

                        echo SITE_ROOT;
                        echo INCLUDE_PATH;

                        // $user_info = User::find_user_by_id(7);
                        // $user_info->first_name = "Fes";
                        // $user_info->last_name = "La's";
                        // $user_info->update();
                        
                        //$user_info->delete();

                        // $photo = Photo::find_by_id(1);

                        // $photo->title = "solihin";
                        // $photo->update();

                        // $new_user = new User();

                        // $new_user->username = "asasasasa";
                        // $new_user->password = "123";
                        // $new_user->first_name = "ltop";
                        // $new_user->last_name = "pc";

                        // $new_user->create();

                        // $user_new = User::find_user_by_id($database->the_insert_id());

                        // echo $user_new->id."<br>";
                        // echo $user_new;

                        ?>




                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->