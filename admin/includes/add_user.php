<?php 
if(isset($_POST['create_user'])){
    $user_firstname =$_POST['user_firstname'];
    $user_lastname =$_POST['user_lastname'];
    $user_role =$_POST['user_role'];
    $username =$_POST['username'];
    
    $user_email =$_POST['user_email'];
    $user_password =$_POST['user_password'];
//    $post_image = $_FILES['image']['name'] . '.jpg';
//    $post_image_temp = $_FILES['image']['tmp_name'];
//    $temp = explode(".", $_FILES['image']['name']);
//    $newfilename = round(microtime(true)) . '.' . end($temp);
//    move_uploaded_file($_FILES['image']['tmp_name'], "../image/" . $newfilename);
//    $post_date = date('d-m-y');
    
    
    $query_add_user = "INSERT INTO `users` (`username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `role`)";
    $query_add_user.= "VALUES ( '{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '', '{$user_role}');";
    
    $add_result = mysqli_query($connection , $query_add_user);
    header("Location: users.php");
}
?>



<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
   
     <div class="form-group">
        <label for="post_category">Role</label>
        <br>
        <select name="user_role" id="user_role">
            <option value="user">Select User</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="author">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="post_status">E - mail</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
<!--
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
-->
    
    <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
    
</form>