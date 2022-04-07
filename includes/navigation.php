<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
                   <?php 
                    
                    $query = "Select * from categories";
                    
                    $result = mysqli_query($connection,$query);
                    
                    while($row = mysqli_fetch_assoc($result)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?cat_id=$cat_id'> {$cat_title} </a> </li>";
                    }
                    
                    ?>
                    <li><a href='admin'>Admin</a> </li>

                    
            <!-- Top Menu Items -->
            
                    <?php
                        if(isset($_SESSION['username'])){
                            if(isset($_GET['p_id'])){
                                if($_SESSION['user_role'] === 'admin'){
                                    echo "<li><a href='admin/posts.php?source=3&edit_id={$_GET['p_id']}'>Edit Post</a></li>";
                                }else{
                                    echo "<li><a href='user/posts.php?source=3&edit_id={$_GET['p_id']}'>Edit Post</a></li>";
                                }
                            }
                        }
                    ?>
                    
                </ul>
            <?php 
            // if( Nese nuk je loguar.... )
            ?>
            



            
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
