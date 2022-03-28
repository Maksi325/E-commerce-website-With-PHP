<?php
    if(isset($_GET['edit_id'])){
     $post_id = $_GET['edit_id'];
        
    $query = "SELECT * FROM `posts` WHERE posts.post_id={$post_id};";
    $query_result = mysqli_query($connection,$query);
        
        while($row = mysqli_fetch_assoc($query_result)){
         $post_author = $row['post_author'];
         $post_title = $row['post_title'];
         $post_category_id = $row['post_category_id'];
         $post_status = $row['post_status'];
         $post_image = $row['post_image'];
         $post_tags = $row['post_tags'];
         $post_date = $row['post_date'];
         $post_content = $row['post_content'];
        }
    }
?>
 
<?php
    if(isset($_POST['edit_post'])){
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date =  date('d-m-y');
        
        if($_FILES['image']['error'] == 0){
            $path="../image/$post_image";
            unlink($path);
            $post_image = $_FILES['image']['name'] . '.jpg';
            $post_image_temp = $_FILES['image']['tmp_name'];
            $temp = explode(".", $_FILES['image']['name']);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            move_uploaded_file($_FILES['image']['tmp_name'], "../image/" . $newfilename);
            $post_image = $newfilename;
        }
        
        $updateQuery = "UPDATE `posts` SET";
        $updateQuery .="`post_title` = '{$post_title}' , ";
        $updateQuery .="`post_category_id` = '{$post_category_id}' , ";
        $updateQuery .="`post_date` = now(), ";
        $updateQuery .="`post_author` = '{$post_author}' , ";
        $updateQuery .="`post_status` = '{$post_status}' , ";
        $updateQuery .="`post_tags` = '{$post_tags}' , ";
        $updateQuery .="`post_content` = '{$post_content}' , ";
        $updateQuery .="`post_image` = '{$post_image}' ";
        $updateQuery .="WHERE `posts`.`post_id` = {$post_id}";
        
        $updatePost = mysqli_query($connection , $updateQuery);
        header( "Location: posts.php" );
    }
?>
  

  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value='<?php echo $post_title?>' type="text" class="form-control" name="title">
    </div>
   
     <div class="form-group">
        <label for="category">Post Category</label>
        <br>
         <select name="post_category" id="post_category">
             
             <?php
                
                $query = "Select * from categories ";
                $result = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($result)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    if($post_category_id == $cat_id){
                        echo "<option selected='selected' value='{$cat_id}'>{$cat_title}</option>";
                    }else{
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }
    
             ?>
         </select>
    </div>
    
    <div class="form-group">
        <label for="author">Post Author</label>
        <input value='<?php echo $post_author?>' type="text" class="form-control" name="post_author">
    </div>
    
     <div class="form-group">
        <label for="category">Post Status</label>
        <br>
         <select name="post_status" id="post_status">
            <?php
             if($post_status === 'draft'){
                 echo "<option selected='selected' value='{$post_status}'>{$post_status}</option>";
                 echo "<option  value='Published'>Published</option>";
             }else{
                 echo "<option selected='selected' value='{$post_status}'>{$post_status}</option>";
                 echo "<option  value='draft'>draft</option>";
             }
             ?>
         </select>
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <br>    
        <img src="../image/<?php echo $post_image?>" width="200" alt="">
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value='<?php echo $post_tags?>' type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control" ><?php echo $post_content?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Publish">
    </div>
    
</form>