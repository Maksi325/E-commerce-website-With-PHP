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
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];

                $querry  = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                $search_querry = mysqli_query($connection, $querry);
                $count_row = mysqli_num_rows($search_querry);

                if ($count_row == 0) {
                    echo "<h1> No result found.</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_querry)) {
                        $post_id = $row['post_id'];
                        $post_user_id = $row['post_user_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content =  substr($row['post_content'], 0, 100);

            ?>
                        <div class="col-md-10">
                            <br>
                            <article style="margin-bottom: 3rem; margin-left: 30%; margin-right: 30%; width: 40%; background-color:  white; border-radius:20px; ">
                                <br>
                                <h2 style="margin-left: 11%; margin-right: 11%; width: 78%;">
                                    <a href="post.php?p_id=<?php echo $post_id  ?>">
                                        <?php echo $post_title    ?>
                                    </a>
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
                margin-bottom: 3rem; margin-left: 20%; margin-right: 20%; width: 60%;" href="post.php?p_id=<?php echo $post_id  ?>">
                                    Read More <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </article>
                        </div>
            <?php
                    }
                }
            }
            ?>

        </div>
        <!-- /.row -->


        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php";  ?>