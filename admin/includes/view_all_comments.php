 <table class="table table-bordered table-hover">
     <thead>
         <tr>
             <th>Id</th>
             <th>Author</th>
             <th>Comment</th>
             <th>E-mail</th>
             <th>Status</th>
             <th>Post</th>
             <th>In Response to</th>
             <th>Date</th>
             <th>Approve</th>
             <th>Unapprove</th>
             <th>Delete</th>
         </tr>
     </thead>
     <tbody>
        <?php
         $query = "Select * from comments";
         $query_result = mysqli_query($connection,$query);
         while($row = mysqli_fetch_assoc($query_result)){
             $comment_id = $row['comment_id'];
             $comment_post_id = $row['comment_post_id'];
             $comment_author = $row['comment_author'];
             $comment_email = $row['comment_email'];
             $comment_content = $row['comment_content'];
             $comment_status = $row['comment_status'];
             $comment_date = $row['comment_date'];
             
             echo "<tr>";
             echo "<td>$comment_id</td>";
             echo "<td>$comment_author</td>";
             echo "<td>$comment_content</td>";
             echo "<td>$comment_email</td>";
             echo "<td>$comment_status</td>";
             
             $query = "Select * from posts where post_id = {$comment_post_id} ";
                $result = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($result)){
                    $post_image = $row['post_image'];
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                }
             
             echo "<td> <img width='150' src='../image/$post_image' alt='Here Should have an image'> </td>";
             
             echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
             
             echo "<td>$comment_date</td>";
             
             echo "<td><a class = 'fa fa-fw fa-edit' href='comments.php?Approve={$comment_id}'>Approve</a>  </td>";
             echo "<td><a class = 'fa fa-fw fa-edit' href='comments.php?Unapprove={$comment_id}'>Unapprove</a>  </td>";
             
             echo "<td><a class = 'fa fa-fw fa-trash' href='comments.php?delete={$comment_id}'></a>  </td>";
             echo "</tr>";
         }
         ?>

     </tbody>
 </table>
 
 <?php
    if(isset($_GET['delete'])){
        deleteCommentById($_GET['delete']);
    }
    if(isset($_GET['Approve'])){
        ApproveCommentById($_GET['Approve']);
    }
    if(isset($_GET['Unapprove'])){
        UnapproveCommentById($_GET['Unapprove']);
    }

?>


