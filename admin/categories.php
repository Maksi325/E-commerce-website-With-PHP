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
                        <div class="col-xs-6">
                           <?php 
                            if(isset($_POST['submit'])){
                                $add_cat_title = $_POST['cat_title'];
                                if($add_cat_title == "" || empty($add_cat_title)){
                                    echo "This field should not be empty";
                                } else {
                                 $querry = "INSERT INTO `categories`  (`cat_title`) ";
                                 $querry .= "VALUES ('{$add_cat_title}') ";
                                $Add_Category = mysqli_query($connection , $querry);
                                    if(!$Add_Category){
                                        die('Querry Falied: ' . mysqli_error($connection));
                                    }
                                }
                                header("Location: categories.php");
                            }
                            ?>
                           
                           
                            <form action="categories.php" method="post">
                               <label for="cat-title">Add Category</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                            
                            <?php     
                            // Updating categories  
                            if(isset($_GET['edit'])){
                                include "includes/Update_categories.php";
                            }?>
                            
                            
                            
                            
                        </div>
                        
                        
                        <?php
                                  

                        ?>
                        <div class="col_xs_6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php // Find all categories
                                    $query = "Select * from categories ";
                                    $result = mysqli_query($connection,$query);
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<tr>";
                                    echo "<td> {$cat_id} </td>";
                                    echo "<td> {$cat_title} </td>";
                                    echo "<td><a class = 'fa fa-fw fa-trash' href='categories.php?delete={$cat_id}'></a>  </td>";
                                    echo "<td><a class='fa fa-fw fa-edit' href='categories.php?edit={$cat_id}'></a>  </td>";
                                    echo"</tr>";
                                }
                                
                                ?>
                                <?php // delete post
                                if(isset($_GET['delete'])){
                                    $Delete_Id = $_GET['delete'];
                                    $Delete_querry  = "DELETE FROM `categories` WHERE `categories`.`cat_id` = {$Delete_Id}";
                                    mysqli_query($connection , $Delete_querry);
                                    header("Location: categories.php");
                                }
                                    
                                ?>
                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php   include "includes/footer.php";   ?>