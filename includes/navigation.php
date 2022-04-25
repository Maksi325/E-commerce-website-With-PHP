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
                    

                    



                    
                <li class="form-inline ml-auto" ><a href='admin'>Admin</a> </li>
                </ul>

                <ul class="nav navbar-right top-nav ">
               <!-- <li><a href='../'>Home Page</a> </li> -->
                <?php 
                    if(isset($_SESSION['username']) && $_SESSION['username'] !== null ){
                        $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php $name;  ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="admin/"><i class="fa fa-fw fa-user"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="admin/profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            <?php }else{ ?>
                 <li >
                    <a href="login.php" class="text-white">
                        <i class="fa fa-user"> </i> Log in
                    </a>
                </li>
            }
            <?php } ?>
            </ul>
            <?php 
            // if( Nese nuk je loguar.... )
            ?>
            



            
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
