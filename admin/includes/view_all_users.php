 <table class="table table-bordered table-hover">
     <thead>
         <tr>
             <th>Username</th>
             <th>First name</th>
             <th>Last name</th>
             <th>E - mail</th>
             <th>Role</th>
             <th>Change To Admin</th>
             <th>Change To User</th>
             <th>Edit</th>
             <th>Delete</th>
             
             
         </tr>
     </thead>
     <tbody>
        <?php
         $query = "Select * from users";
         $query_result = mysqli_query($connection,$query);
         while($row = mysqli_fetch_assoc($query_result)){
             $user_id = $row['user_id'];
             $username = $row['username'];
             $user_password = $row['user_password'];
             $user_firstname = $row['user_firstname'];
             $user_lastname = $row['user_lastname'];
             $user_email = $row['user_email'];
             $role = $row['role'];
             
             echo "<tr>";
             echo "<td>$username</td>";
             echo "<td>$user_firstname</td>";
             echo "<td>$user_lastname</td>";
             echo "<td>$user_email</td>";
             echo "<td>$role</td>";
             

             if($role=='user'){
                echo "<td><a class = 'fa fa-fw fa-regular fa-square' style='width:100px;'  href='users.php?change={$user_id}&source=4'></a>  </td>";
                echo "<td><a class = 'fa fa-fw fa-regular fa-check' style='width:100px;' href='users.php?change={$user_id}&source=5'></a>  </td>"; 
             }else{
                echo "<td><a class = 'fa fa-fw fa-regular fa-check' style='width:100px;' href='users.php?change={$user_id}&source=4'></a>  </td>";
                echo "<td><a class = 'fa fa-fw fa-regular fa-square'style='width:100px;'  href='users.php?change={$user_id}&source=5'></a>  </td>"; 
             }
             
             echo "<td><a class = 'fa fa-fw fa-edit' href='users.php?edit_id={$user_id}&source=3'></a>  </td>";
             echo "<td><a class = 'fa fa-fw fa-trash' href='users.php?delete={$user_id}&source=2'></a>  </td>";
             echo "</tr>";
         }
         ?>

     </tbody>
 </table>
 


