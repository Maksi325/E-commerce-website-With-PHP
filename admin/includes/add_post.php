<?php 
if(isset($_POST['create_post'])){
    $post_title =$_POST['title'];
    $post_category_id =$_POST['post_category'];
    $post_author =$_POST['post_author'];
    $post_status =$_POST['post_status'];
    
    
    $post_image = $_FILES['image']['name'] . '.jpg';
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags =$_POST['post_tags'];
    
    $post_content =$_POST['post_content'];
    $post_date = date('d-m-y');
    $post_coment_count = 0;
    $post_views_count = 0;
    $temp = explode(".", $_FILES['image']['name']);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file($_FILES['image']['tmp_name'], "../image/" . $newfilename);
    
    
    $query_add_post = "INSERT INTO `posts` (`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_coment_count`, `post_status`, `post_views_count`) ";
    
    $query_add_post.= "VALUES ( '{$post_category_id}', '{$post_title}', '{$post_author}',now(), '{$newfilename}', '{$post_content}', '{$post_tags}', '{$post_coment_count}', '{$post_status}','{$post_views_count}');";
    
    $add_result = mysqli_query($connection , $query_add_post);
    
    
}
?>
<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
   
     <div class="form-group">
        <label for="post_category">Post Category</label>
        <br>
        <select name="post_category" id="post_category">
             
             <?php
                
                $query = "Select * from categories ";
                $result = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($result)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                      echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
    
             ?>
         </select>
    </div>
    
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
        <label for="category">Post Status</label>
        <br>
         <select name="post_status" id="post_status">
            <?php
                 echo "<option selected='selected' value='draft'>draft</option>";
                 echo "<option  value='Published'>Published</option>";
             
             ?>
         </select>
    </div>
    
    
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control" ></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>
    
</form>