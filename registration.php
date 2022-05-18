<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<div class="container">


    <?php
    $MessageError = false;
    if (isset($_POST['register'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname =  mysqli_real_escape_string($connection, $lastname);
        $username =  mysqli_real_escape_string($connection, $username);
        $email =  mysqli_real_escape_string($connection, $email);
        $password =  mysqli_real_escape_string($connection, $password);

        $password = md5($password);


        $CheckQuery = "select * from users where username = '{$username}'";

        $result = mysqli_query($connection, $CheckQuery);
        $count = mysqli_num_rows($result);
        echo $count;

        if ($count != 0) {
            $MessageError = true;
        } else {
            $registrationQuerry = " INSERT INTO `users` ( `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `role`) VALUES ";
            $registrationQuerry .= "( '$username', '$password', '$firstname', '$lastname', '$email', 'user') ";

            $result = mysqli_query($connection, $registrationQuerry);
        }
    }
    ?>

    <br>
    <br>
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Your First Name">

                            </div>
                            <div class="form-group">
                                <label for="username">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Your Last Name">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                                <?php if ($MessageError) {
                                    echo "<p style='color: red;'>Already exist an account with this username </p>";
                                } ?>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>