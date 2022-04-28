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
                        Welcome Admin To Category Section
                        <small><?php echo $username; ?></small>
                    </h1>
                    <div class="col-xs-6">

                        <?php insert_categories();    ?>

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
                        if (isset($_GET['edit'])) {
                            include "includes/Update_categories.php";
                        } ?>
                    </div>

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
                                <?php
                                findAllCategories();
                                deleteCategories();
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
    <?php include "includes/footer.php";   ?>