<?php

function deletePostById( $ID ) {
    global $connection;

    $query = "DELETE FROM `posts` WHERE `posts`.`post_id` = {$ID}";
    $result =  mysqli_query( $connection, $query );
    if ( !$result ) {
        die( 'Querry Falied: ' . mysqli_error( $connection ) );
    }
    header( "Location: posts.php" );
}

function deleteUserById( $ID ) {
    global $connection;

    $query = "DELETE FROM `users` WHERE `users`.`user_id` = {$ID}";
    $result =  mysqli_query( $connection, $query );
    if ( !$result ) {
        die( 'Querry Falied: ' . mysqli_error( $connection ) );
    }
    header( "Location: users.php" );
}

function deleteCommentById( $ID, $post_id ) {
    global $connection;

    $query = "DELETE FROM `comments` WHERE `comments`.`comment_id` = {$ID}";
    $result =  mysqli_query( $connection, $query );

    $decreasePost_comment_count = "Update posts SET post_coment_count = post_coment_count - 1 ";
    $decreasePost_comment_count .= " WHERE post_id = $post_id";
    $result =  mysqli_query( $connection, $decreasePost_comment_count );
    if ( !$result ) {
        die( 'Querry Falied: ' . mysqli_error( $connection ) );
    }
    header( "Location: comments.php" );
}

function UnapproveCommentById( $ID ) {
    global $connection;

    $query = "UPDATE `comments` SET `comment_status` = 'Unapprove' WHERE `comments`.`comment_id` = {$ID}";
    $result =  mysqli_query( $connection, $query );
    if ( !$result ) {
        die( 'Querry Falied: ' . mysqli_error( $connection ) );
    }
    header( "Location: comments.php" );
}

function ApproveCommentById( $ID ) {
    global $connection;

    $query = "UPDATE `comments` SET `comment_status` = 'Approve' WHERE `comments`.`comment_id` = {$ID}";
    $result =  mysqli_query( $connection, $query );
    if ( !$result ) {
        die( 'Querry Falied: ' . mysqli_error( $connection ) );
    }
    header( "Location: comments.php" );
}

function insert_categories() {
    global $connection;

    if ( isset( $_POST['submit'] ) ) {
        $add_cat_title = $_POST['cat_title'];
        if ( $add_cat_title == "" || empty( $add_cat_title ) ) {
            echo "This field should not be empty";
        } else {
            $querry = "INSERT INTO `categories`  (`cat_title`) ";
            $querry .= "VALUES ('{$add_cat_title}') ";
            $Add_Category = mysqli_query( $connection, $querry );
            if ( !$Add_Category ) {
                die( 'Querry Falied: ' . mysqli_error( $connection ) );
            }
        }
        header( "Location: categories.php" );
    }
}

function findAllCategories() {
    global $connection;

    $query = "Select * from categories ";
    $result = mysqli_query( $connection, $query );

    while( $row = mysqli_fetch_assoc( $result ) ) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td> {$cat_id} </td>";
        echo "<td> {$cat_title} </td>";
        echo "<td><a class = 'fa fa-fw fa-trash' href='categories.php?delete={$cat_id}'></a>  </td>";
        echo "<td><a class='fa fa-fw fa-edit' href='categories.php?edit={$cat_id}'></a>  </td>";
        echo"</tr>";

    }

}

function deleteCategories() {
    global $connection;
    if ( isset( $_GET['delete'] ) ) {
        $Delete_Id = $_GET['delete'];
        $Delete_querry  = "DELETE FROM `categories` WHERE `categories`.`cat_id` = {$Delete_Id}";
        mysqli_query( $connection, $Delete_querry );
        header( "Location: categories.php" );
    }

}

function changeToAdminById( $ID ) {
    global $connection;

    $query = "UPDATE `users` SET `role` = 'admin' WHERE `users`.`user_id` = {$ID}";
    $result =  mysqli_query( $connection, $query );
    if ( !$result ) {
        die( 'Querry Falied: ' . mysqli_error( $connection ) );
    }
    header( "Location: users.php" );
}

function changeToUserById( $ID ) {
    global $connection;

    $query = "UPDATE `users` SET `role` = 'user' WHERE `users`.`user_id` = {$ID}";
    $result =  mysqli_query( $connection, $query );
    if ( !$result ) {
        die( 'Querry Falied: ' . mysqli_error( $connection ) );
    }
    if ( $_SESSION['user_id'] === $ID ) {
        $_SESSION['user_role'] = "user";
    }
    header( "Location: users.php" );
}

function countRows( $table ) {
    global $connection;

    $querry = "Select * from {$table}";
    $result = mysqli_query( $connection, $querry );
    $count = mysqli_num_rows( $result );
    return $count;
}
