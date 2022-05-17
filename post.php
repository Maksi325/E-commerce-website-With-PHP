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
                <div class="col-md-12">
                    <br>
                    <article style="margin-bottom: 3rem; margin-left: 30%; margin-right: 30%; width: 40%; background-color:  white; border-radius:20px; ">
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

                        <!-- Comments  -->
                        <hr>
                        <p style="text-align: center;">Comment Section</p>
                        <hr>
                        <!-- if you are not loged in  -->
                        <?php if (!isset($_SESSION['user_id'])) { ?>
                            <div style="display: inline-table;">
                                <h4 style="float: left;">Should be logged in to Comment here</h4>
                                <a href="/login.php">
                                    <button style="float: right;" class="btn btn-bg-primary">log in</button>
                                </a>
                            </div>

                            <!-- if you are logged in  -->
                        <?php } elseif ($_SESSION['user_role']) { ?>
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <?php if (isset($_SESSION['user_image'])) {
                                        $imageUrl = "image/" . $_SESSION['user_image'];
                                    } else {
                                        $imageUrl = "image/person.png";
                                    }
                                    ?>
                                    <img class="media-object" src="<?php echo $imageUrl; ?>" alt="" style="width: 10rem;">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <?php echo $_SESSION['username']; ?>
                                    </h4>
                                    <form role="form" action="" method="POST" style="display: inline-table;">
                                        <div class="form-group" style="float: left;">
                                            <textarea name="textt" class="form-control" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="comment" style="float: right;">Comment</button>
                                    </form>
                                </div>
                            </div>
                        <?php
                            if (isset($_POST['comment'])) {
                                $comment = $_POST['textt'];
                                $commentQuery = "INSERT INTO `comments` ( `comment_post_id`, `comment_user_id`, `comment_author`, `comment_email`, `comment_content`,  `comment_date`) ";
                                $commentQuery .= " values ( {$the_post_id} , {$_SESSION['user_id']} , '{$_SESSION['username']}' , '{$_SESSION['user_email']}' ,  '{$comment}'  , now())";
                                $result = mysqli_query($connection, $commentQuery);
                            }
                        } ?>





                        <!-- Make dynamic Comment -->
                        <?php
                        $takecommentsQuerry = "Select * FROM comments , users where comment_user_id = user_id and comment_post_id = {$the_post_id} ";

                        $result = mysqli_query($connection, $takecommentsQuerry);

                        while ($row = mysqli_fetch_array($result)) {
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                            $comment_user_id = $row['comment_user_id'];
                        ?>

                            <div class="media" style="margin-bottom: 2rem; margin-top: 3rem;">
                                <a class="pull-left" href="user_profile.php?u_id=<?php echo $comment_user_id; ?>">
                                    <?php if (isset($row['user_image'])) {
                                        $imageUrl = "image/" . $row['user_image'];
                                    } else {
                                        $imageUrl = "image/person.png";
                                    }
                                    ?>
                                    <img class="media-object" src="<?php echo $imageUrl; ?>" alt="" style="width: 10rem;">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <h4><?php echo $comment_author; ?></h4>
                                        <small><?php echo $comment_date; ?></small>
                                    </h4>
                                    <p>
                                        <?php echo $comment_content; ?>
                                    </p>
                                </div>
                            </div>

                        <?php } ?>

                    </article>
                </div>
            <?php  }   ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include "includes/footer.php";  ?>