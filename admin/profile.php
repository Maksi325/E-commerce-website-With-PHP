<?php include "includes/header.php";  ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php";  ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome Admin To Profile
                        <small><?php echo $username; ?></small>
                    </h1>
                    <?php
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];

                        $query = "SELECT * FROM `users` WHERE username = '{$username}';";
                        $query_result = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($query_result)) {
                            $user_id = $row['user_id'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_role = $row['role'];
                            $user_email = $row['user_email'];
                            $user_image = $row['user_image'];
                            $user_password = $row['user_password'];
                        }
                    }
                    ?>

                    <?php
                    if (isset($_POST['update_profile'])) {
                        $user_role = $_POST['role'];
                        $username = $_POST['username'];
                        $user_email = $_POST['user_email'];
                        $user_password = $_POST['user_password'];

                        if ($_FILES['image']['error'] == 0) {
                            $path = "../image/$user_image";
                            unlink($path);
                            $post_image = $_FILES['image']['name'] . '.jpg';
                            $post_image_temp = $_FILES['image']['tmp_name'];
                            $temp = explode(".", $_FILES['image']['name']);
                            $newfilename = round(microtime(true)) . '.' . end($temp);
                            move_uploaded_file($_FILES['image']['tmp_name'], "../image/" . $newfilename);
                            $user_image = $newfilename;
                        }

                        $updateQuery = "UPDATE `users` SET";
                        $updateQuery .= "`role` = '{$user_role}' , ";
                        $updateQuery .= "`username` = '{$username}' , ";
                        $updateQuery .= "`user_email` = '{$user_email}' , ";
                        $updateQuery .= "`user_password` = '{$user_password}' , ";
                        $updateQuery .= "`user_image` = '{$user_image}' ";
                        $updateQuery .= "WHERE `users`.`user_id` = {$user_id}";

                        $updatePost = mysqli_query($connection, $updateQuery);
                        $_SESSION['username'] = $username;
                        $_SESSION['user_password'] = $user_password;
                        $_SESSION['firstname'] = $user_firstname;
                        $_SESSION['lastname'] = $user_lastname;
                        $_SESSION['user_image'] = $user_image;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_role'] = $user_role;

                        header("Location: users.php");
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div>
                                <?php if (empty($user_image)) { ?>
                                    <img src="../image/person.png" alt="">
                                <?php } else { ?>
                                    <img style="height: 200px;" src="../image/<?php echo $user_image; ?>" alt="">
                                <?php } ?>
                                <input style="margin-top: 2rem;" type="file" name="image">
                            </div>
                            <br>

                            <label for="role">Role</label>
                            <br>
                            <select name="role" id="post_category">
                                <?php
                                if ($user_role == "admin") {
                                    echo "<option selected='selected' value='admin'>Admin</option>";
                                    echo "<option  value='user'>User</option>";
                                } else {
                                    echo "<option  value='admin'>Admin</option>";
                                    echo "<option selected='selected' value='user'>User</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input value='<?php echo $username ?>' type="text" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="user_email">E - mail</label>
                            <input value='<?php echo $user_email ?>' type="email" class="form-control" name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="user_password">Old Password</label>
                            <input value='<?php echo $user_password ?>' type="password" class="form-control" name="user_password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/footer.php";   ?>