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
                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
                }   
                    $query = "Select * from posts where post_id = $the_post_id";
                    
                    $result = mysqli_query($connection,$query);
                    
                    while($row = mysqli_fetch_assoc($result) ){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    
                    ?>

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

               <?php  }   ?>
                
                <!-- Blog Comments -->
                <?php
                if(isset($_POST['create_comment'])){
                    $the_post_id = $_GET['p_id'];
                    
                    $comment_author = $_POST['comment_name'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    $insertQuery = "Insert into `comments` (`comment_post_id`, `comment_author` , `comment_email` , `comment_content` , `comment_status` , `comment_date`)";
                    $insertQuery .= " Values ($the_post_id, '{$comment_author}' , '{$comment_email}' , '{$comment_content}' , 'Unapproved' ,now())";
                    
                    $result = mysqli_query($connection , $insertQuery);
                    if(!$result){
                        die('Querry Falied: '.mysqli_error($connection));
                    }
                    $QuerryIncreaseCommentCount = "Update posts SET post_coment_count = post_coment_count + 1 ";
                    $QuerryIncreaseCommentCount .=" WHERE post_id = $the_post_id";
                    
                    $Increase = mysqli_query($connection , $QuerryIncreaseCommentCount);
                    if(!$Increase){
                        die('Querry Falied: '.mysqli_error($connection));
                    }
                }
                ?>
                
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                           <label for="">Author</label>
                            <input type="text" name="comment_name" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="">E-mail</label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3" ></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                $commentquery = "SELECT * From comments WHERE comment_post_id = {$the_post_id}";
                $commentquery .= " AND comment_status = 'Approve' ";
                $commentquery .= " ORDER BY comment_id DESC ";
                
                $commentresult = mysqli_query($connection,$commentquery);
                if(!$commentresult){
                    die( 'Querry Falied: ' . mysqli_error( $connection ) );
                }
                while($row = mysqli_fetch_assoc($commentresult)){
                    $comment_date = $row['comment_date'];
                    $comment_author = $row['comment_author'] ;
                    $comment_content = $row['comment_content'];
                ?>
                
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" width='150' src="image/person.png" alt=" here is an foto">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php  echo $comment_author; ?>
                            <small> <?php  echo $comment_date; ?> </small>
                        </h4><?php  echo $comment_content; ?>
                    </div>
                </div>
                
                <?php } ?>
               

          

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?PHP   include "includes/sidebar.php";   ?>
            
        </div>
        <!-- /.row -->

             
        <hr>

        <!-- Footer -->
       <?php    include "includes/footer.php";  ?>