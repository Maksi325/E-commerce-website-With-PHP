<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!--search form-->
        <!-- /.input-group -->
    </div>


    




    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                                  
                                $query = "Select * from categories ";
//                                $query = "Select * from categories LIMIT 1";
                    
                                $result = mysqli_query($connection,$query);
                    
                                while($row = mysqli_fetch_assoc($result)){
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];
                                    
                                    echo "<li><a href='category.php?cat_id=$cat_id'> {$cat_title} </a> </li>";
                                }
                                
                                ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
</div>