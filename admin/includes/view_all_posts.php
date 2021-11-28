 <table class="table table-bordered table-hover">
     <thead>
         <tr>
             <th>Id</th>
             <th>Author</th>
             <th>Title</th>
             <th>Category</th>
             <th>Status</th>
             <th>Image</th>
             <th>Tags</th>
             <th>Comments</th>
             <th>Dates</th>
         </tr>
     </thead>
     <tbody>
        <?php
         $query = "Select * from posts";
         $query_result = mysqli_query($connection,$query);
         while($row = mysqli_fetch_assoc($query_result)){
             $post_id = $row['post_id'];
             $post_author = $row['post_author'];
             $post_title = $row['post_title'];
             $post_category_id = $row['post_category_id'];
             $post_status = $row['post_status'];
             $post_image = $row['post_image'];
             $post_tags = $row['post_tags'];
             $post_coment_count = $row['post_coment_count'];
             $post_date = $row['post_date'];
             echo "<tr>";
             echo "<td>$post_id</td>";
             echo "<td>$post_author</td>";
             echo "<td>$post_title</td>";
             echo "<td>$post_category_id</td>";
             echo "<td>$post_status</td>";
             echo "<td> <img width='150' src='../image/$post_image' alt='Here Should have an image'> </td>";
             echo "<td>$post_tags</td>";
             echo "<td>$post_coment_count</td>";
             echo "<td>$post_date</td>";
             echo "<td><a class = 'fa fa-fw fa-trash' href='posts.php?delete_id={$post_id}&source=2'></a>  </td>";
             echo "</tr>";
         }
         ?>
         <img  src="" alt="">
     </tbody>
 </table>