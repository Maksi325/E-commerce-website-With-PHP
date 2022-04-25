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
                $post_status=null;
                
                
                    
                    $query = "Select * from posts where post_status = 'Published'";
                    
                    $result = mysqli_query($connection,$query);
                    
                    while($row = mysqli_fetch_assoc($result) ){
                        $post_id = $row['post_id'];
                        $post_user_id = $row['post_user_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content =  substr($row['post_content'], 0 , 100)."...";
                        $post_status = $row['post_status'];
                        
                    ?>

                    <?php
                        if(isset($_SESSION['username']) && $_SESSION['username'] !== null ){
                    ?>
                        <div style="background-color: blue; height: 3.6rem; width: 95px; margin-right: 40px; margin-left: auto;  ">
                            <a href="" class="btn" style="color:black;" >+ Add Post</a>
                        </div>

                    <?php }?>
                <article>
                <h2>
                    <a href="post.php?p_id=<?php   echo $post_id  ?>">
                    <?php   echo $post_title    ?>
                    </a>
                </h2>
                
                <p class="lead">
                    by <a href="user_profile.php?u_id=<?php echo $post_user_id?>">
                        <?php   echo $post_author    ?>
                    </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> 
                <?php   echo $post_date    ?>
                </p>
                <img class="img-responsive" src="image/<?php   echo $post_image ?>" alt="">
                <p style="padding-top: 1.5rem;" >
                <?php   echo $post_content    ?>
                </p>
                <a class="btn btn-primary" href="post.php?p_id=<?php   echo $post_id  ?>">
                    Read More <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                </article>
                

               <?php  } 
                if(!$post_status){
                    echo "<h1 class='text-center'> NO POST SORRY </h1>";
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
