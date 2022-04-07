    <!--connection-->
    <?php   include "includes/db.php";   ?>
    <!--Header-->

    <?php   include "includes/header.php";  ?>

    <!-- Navigation -->
    <?php   include "includes/navigation.php";  ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">
    
    
    <?php 
    if(isset($_GET['u_id'])){
        $user_id = $_GET['u_id'];
        $query = "Select * from users where user_id = {$user_id}";
        $result = mysqli_query($connection,$query);
                    
        while($row = mysqli_fetch_assoc($result) ){
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];        
        }
        
    }else{
        header( "Location: error_page.php" );
    }
    ?>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-4 mb-5 mb-lg-0 wow fadeIn">
                <div class="card border-0 shadow">
                    
                    <?php 
                        if( $user_image === ''){
                            echo "<img src='image/person.png' class='Profile-photo' alt='...'>";
                        }else{
                            echo "<img src='image/{$user_image}' class='Profile-photo' alt='...'>";
                        }
                    ?>
                    <div class="card-body p-1-9 p-xl-5">
                        <div class="mb-4">
                            <h3 class="h4 mb-0"><?php echo $user_firstname . "    " . $user_lastname; ?></h3>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3"><a href="#"><i class="far fa-envelope display-25 me-3 text-secondary"></i> <?php echo $user_email; ?></a></li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="ps-lg-1-6 ps-xl-5">
                    <div class="mb-5 wow fadeIn">
                        <div class="text-start mb-1-6 wow fadeIn">
                            <!-- Set firstname and last name of user  -->
                            <h2 class="h1 mb-0 text-primary"><?php echo $user_firstname . "    " . $user_lastname . "  Post's "?></h2>
                            <hr>
                        </div>
                        <?php 
                    if(isset($_GET['u_id'])){
                        $user_id = $_GET['u_id'];
                    $post_status=null;
                
                
                    
                    $query = "Select * from posts where post_status = 'Published' and post_user_id = {$user_id}";
                    
                    $result = mysqli_query($connection,$query);
                    
                    while($row = mysqli_fetch_assoc($result) ){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content =  substr($row['post_content'], 0 , 100)."...";
                        $post_status = $row['post_status'];
                        
                    ?>
                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php   echo $post_id  ?>">
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
                        <a class="btn btn-primary" href="post.php?p_id=<?php   echo $post_id  ?>">
                            Read More <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>

                        <?php  } 
                    if(!$post_status){
                        echo "<h1 class='text-center'> NO POST SORRY </h1>";
                    }
                }
                ?>
                        <hr>
                    </div>


                </div>
            </div>
        </div>
    </div>

   
    <link href="css/user_profile.css" rel="stylesheet">