<?php include("includes/header.php"); ?>
<?php 

//$photos = Photo::find_all();

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$total_pages_count = Photo::count_all();
$items_per_page = 4;

$pagination = new Pagination($page,$items_per_page,$total_pages_count);

$sql = "SELECT * FROM photos
        LIMIT {$pagination->items_per_page}
        OFFSET {$pagination->offset()}";

$photos = Photo::find_by_query($sql);

?>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                <div class="thumbnails row">
                <?php foreach($photos as $photo) : ?>

                        <div class="col-xs-6 col-md-3">
                            <a class="thumbnail" href="photo.php?id=<?php echo $photo->photo_id;?>">
                                <img class="img-responsive home_page_photo" src="admin/<?php echo $photo->picture_path();?>" alt="">
                            </a>
                            
                        </div>

                <?php endforeach; ?>
                </div>

            </div>


            <!-- Blog Sidebar Widgets Column -->
            <!--<div class="col-md-4">     
                 <?php //include("includes/sidebar.php"); ?>
            </div> -->


        </div>
        <!-- /.row -->

        <div class="row">
            <ul class="pager">

                <?php 
                
                if ($pagination->page_total() > 1) {
                    if ($pagination->has_next()) {
                        echo "<li class='next'><a href='?page={$pagination->next()}'>Next</a></li>";
                    }
                    
                    for ($i=1; $i <= $pagination->page_total(); $i++) { 
                        if ($i == $pagination->current_page) {
                            echo "<li class='active'><a class='active' href='?page={$i}'>{$i}</a></li>";
                        }
                        else {
                            echo "<li><a href='?page={$i}'>{$i}</a></li>";
                        }
                    }

                    if ($pagination->has_previous()) {
                        echo "<li class='previous'><a href='?page={$pagination->previous()}'>Previous</a></li>";
                    }
                } 
                
                ?>
                
            </ul>
        </div>

        <?php include("includes/footer.php"); ?>
