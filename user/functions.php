<?php

function deletePostById($ID)
{
    global $connection;

    $query = "UPDATE `posts` SET `post_status` = 'deleted' WHERE `posts`.`post_id` = $ID";
    $result =  mysqli_query($connection, $query);
    if (!$result) {
        die('Querry Falied: ' . mysqli_error($connection));
    }
    header("Location: posts.php");
}
function countRows($table)
{
    global $connection;
    $querry = "Select * from {$table}";
    $result = mysqli_query($connection, $querry);
    $count = mysqli_num_rows($result);
    return $count;
}
