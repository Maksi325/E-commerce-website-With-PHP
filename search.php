    <!--connection-->
    <?php   include "includes/db.php";   ?>
    <!--Header-->

    <?php   include "includes/header.php";  ?>

    <!-- Navigation -->
    <?php   include "includes/navigation.php";  ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                if(isset($_POST['submit'])){
                    $search = $_POST['search'];
                    
                    $querry  = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                    $search_querry = mysqli_query($connection , $querry);
                    $count_row = mysqli_num_rows($search_querry);
                    
                    if($count_row == 0){
                        echo "<h1> No result found.</h1>";
                    }else{
                    while($row = mysqli_fetch_assoc($search_querry) ){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    
                    ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#">
                    <?php   echo $post_title    ?>
                    </a>
                </h2>
                <p class="lead">
                    by <a href="index.php">
                        <?php   echo $post_author    ?>
                    </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> 
                <?php   echo $post_date    ?>
                </p>
                <hr>
                <img class="img-responsive" src="image/<?php   echo $post_image ?>" alt="">
                <hr>
                <p>
                <?php   echo $post_content    ?>
                </p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

               <?php  
                        }    
                    }
                    
                }
                       ?>
                <hr>

          

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?PHP   include "includes/sidebar.php";   ?>
            
        </div>
        <!-- /.row -->

             
        <hr>

        <!-- Footer -->
       <?php    include "includes/footer.php";  ?>