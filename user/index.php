
<?php   include "includes/header.php";
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php   include "includes/navigation.php"; ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row" style=" margin-right: auto; margin-left: auto">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome AdminTo Dashboard
                        <small><?php echo $name;?></small>
                    </h1>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php 
                                                $querry = "Select * from posts where post_user_id = {$_SESSION['user_id']}";
                                                $result = mysqli_query( $connection, $querry );
                                                $post_counts = mysqli_num_rows( $result );
                                            ?>
                                            <div class='huge'><?php echo $post_counts; ?></div>
                                            <div>All Your Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php 
                                                $querry = "Select * from posts where post_user_id = {$_SESSION['user_id']} and post_status = 'Published' ";
                                                $result = mysqli_query( $connection, $querry );
                                                $active_post_counts = mysqli_num_rows( $result );
                                            ?>
                                            <div class='huge'><?php echo $active_post_counts; ?></div>
                                            <div>Your Active  Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php 
                                                $querry = "Select * from comments";
                                                $result = mysqli_query( $connection, $querry );
                                                $comments_counts = mysqli_num_rows( $result );
                                            ?>
                                            <div class='huge'><?php echo $comments_counts; ?></div>
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- /.row -->
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'Count'],
                            <?php
                            $element_text = ['All Posts' , 'Active Post'  , 'Comments'];
                            $element_count = [$post_counts , $active_post_counts  , $comments_counts];
                            for($i=0; $i<3;$i++){
                                echo "['$element_text[$i]' , $element_count[$i]],";
                                
                            }
                            
                            ?>
                            
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 800px; height: 500px; margin-right: auto; margin-left: auto; "></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php   include "includes/footer.php";
?>