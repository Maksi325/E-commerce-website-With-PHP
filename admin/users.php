<?php   include "includes/header.php";  ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php   include "includes/navigation.php";  ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>
                    <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else {
                            $source = 0;
                        }
                        
                        switch($source){
                            case '1': //add new user
                                include "includes/add_user.php";
                                break;
                            case '2': //delete the selected post
                                if(isset($_GET['delete'])){
                                    $delete_user_id = $_GET['delete'];
                                    deleteUserById($delete_user_id);
                                }
                                break;
                            case '3': //edit user details
                                include "includes/edit_user.php";
                                break;
                            case '4': //Change Role to Admin
                                if(isset($_GET['change'])){
                                    $change_user_role = $_GET['change'];
                                    changeToAdminById($change_user_role);
                                }
                                break;
                            case '5': //Change Role to User
                                 if(isset($_GET['change'])){
                                    $change_user_role = $_GET['change'];
                                    changeToUserById($change_user_role);
                                }
                                break;
                            default:
                                include "includes/view_all_users.php";
                                break;
                    }

                    ?>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php   include "includes/footer.php";   ?>