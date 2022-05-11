    <!--connection-->
    <?php include "includes/db.php";   ?>
    <!--Header-->

    <?php include "includes/header.php";  ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php";  ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <!-- Here start Body -->
            <div class="sticky-top col-md-12 col-sm-8 " style="height: 4rem;">
                <?php
                if (isset($_SESSION['username']) && $_SESSION['username'] !== null) {
                ?>
                    <div class="col-md-2 col-xs-5" style="  background-color: blue; height: 3.6rem; border-radius: 25px;">
                        <a href="/user/posts.php?source= 1" class="btn" style="color:black; width: 40%;">+ Add Post</a>
                    </div>

                <?php } ?>

                <div class="ml-2 col-xs-7 col-md-4  " style=" position: absolute; right:0px; ">
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control" style="border-radius: 25px;">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit" style="border-radius: 30px;">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

            </div>

            <?php
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
            } else {
                header("Location: error_page.php");
            }
            $query = "Select * from posts where post_id = $the_post_id";

            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $post_user_id = $row['post_user_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>
                <div class="col-md-10">
                    <br>
                    <article style="margin-bottom: 3rem; margin-left: 30%; margin-right: 30%; width: 40%; background-color:  #f2ece5; border-radius:20px; ">
                        <br>
                        <h2 style="margin-left: 11%; margin-right: 11%; width: 78%;">
                            <?php echo $post_title    ?>
                        </h2>

                        <p class="lead" style="margin-left: 11%; margin-right: 11%; width: 78%;">
                            by <a href="user_profile.php?u_id=<?php echo $post_user_id ?>">
                                <?php echo $post_author    ?>
                            </a>
                        </p>
                        <p style="margin-left: 11%; margin-right: 11%; width: 78%;"><span class="glyphicon glyphicon-time"></span>
                            <?php echo $post_date    ?>
                        </p>
                        <img class="img-responsive" style="margin-left: 11%; margin-right: 11%; width: 78%; height: 200px " src="image/<?php echo $post_image ?>" alt="">
                        <p style="margin-top: 2rem; margin-left: 11%; margin-right: 11%; width: 78%;">
                            <?php echo $post_content    ?>
                        </p>
                        <a class="btn btn-primary" style="
                margin-bottom: 3rem; margin-left: 20%; margin-right: 20%; width: 60%;" href="post.php?p_id=<?php echo $the_post_id  ?>">
                            Read More <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </article>
                </div>
            <?php  }   ?>

            <!-- Blog Comments -->
            <!-- <?php
                    if (isset($_POST['create_comment'])) {
                        $the_post_id = $_GET['p_id'];

                        $comment_author = $_POST['comment_name'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        $insertQuery = "Insert into `comments` (`comment_post_id`, `comment_author` , `comment_email` , `comment_content` , `comment_status` , `comment_date`)";
                        $insertQuery .= " Values ($the_post_id, '{$comment_author}' , '{$comment_email}' , '{$comment_content}' , 'Unapproved' ,now())";

                        $result = mysqli_query($connection, $insertQuery);
                        if (!$result) {
                            die('Querry Falied: ' . mysqli_error($connection));
                        }
                        $QuerryIncreaseCommentCount = "Update posts SET post_coment_count = post_coment_count + 1 ";
                        $QuerryIncreaseCommentCount .= " WHERE post_id = $the_post_id";

                        $Increase = mysqli_query($connection, $QuerryIncreaseCommentCount);
                        if (!$Increase) {
                            die('Querry Falied: ' . mysqli_error($connection));
                        }
                    }
                    ?>   -->
        </div>
    </div>
    <!-- Footer -->
    <?php include "includes/footer.php";  ?>