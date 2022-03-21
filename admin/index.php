<?php   include "includes/header.php";
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php   include "includes/navigation.php";
?>

    <?php
if ( isset( $_SESSION['username'] ) ) {
    $username = $_SESSION['username'];
    $user_firstname =  $_SESSION['firstname'] ;
    $user_lastname = $_SESSION['lastname']  ;
    $user_role = $_SESSION['user_role']  ;

} else {
    header( "Location: ../" );
}
?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome To Admin Panel
                        <small><?php echo $user_firstname." ".$user_lastname;?></small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php   include "includes/footer.php";
?>