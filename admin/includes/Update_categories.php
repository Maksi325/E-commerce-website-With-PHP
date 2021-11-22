<form action="" method="post">
                                <label for="">Update Category</label>
                                <div class="form-group">
                            
                            <?php 
                                $Update_Id = $_GET['edit'];
                                $q = mysqli_query($connection , "SELECT * FROM `categories` WHERE cat_id = {$Update_Id};");
                                while($row = mysqli_fetch_assoc($q)){
                                    $Update_cat_title = $row['cat_title'];
                                ?>
                                
                                    <input class="form-control" value='<?php if(isset($Update_cat_title)){echo $Update_cat_title;} ?>' type="text" name="Update_cat_title">
                                <?php } ?>
                                
                                </div>
                                
                                <div class="form-group">
                                    <input class="btn btn-primary" type="SUBMIT" name="Update" value="Update category">
                                </div>
                            </form>
                            
                            <?php 
                                if(isset($_POST['Update'])){
                                    $Update_cat_title =  $_POST['Update_cat_title'];
                                    $Update_cat_query = "UPDATE `categories` SET `cat_title` = '{$Update_cat_title}' WHERE `categories`.`cat_id` = {$Update_Id}";
                                    $Update_result = mysqli_query($connection,$Update_cat_query);
                                    header("Location: categories.php");
                                }                            
                             ?>