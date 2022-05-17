   <!--connection-->
   <?php include "includes/db.php";   ?>
   <!--Header-->

   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Facebook-Login or Sign up</title>
       <link rel="stylesheet" href="css/style2.css">
   </head>

   <body>
       <main>
           <div class="row">
               <div class="colm-form">
                   <form class="form-container" action="includes/login.php" method="post">

                       <input name="username" type="text" placeholder="Username">
                       <input name="password" type="password" placeholder="Password">
                       <br>
                       <br>
                       <button name="login" type="submit" class="btn-login">Login</button>
                       <br>
                       <br>
                       <?php if (isset($_GET['e'])) {
                            echo "<p style='color: red;'>Usernamme Or password is incoret</p>";
                        } ?>
                       <hr>
                       <br>
                       <br>
                       <a href="/registration.php">
                           <input type="button" class="btn btn-new" value="Register Now" />
                           <!-- <button  class="btn-new">Register Now</button> -->
                       </a>
                   </form>
               </div>
           </div>
       </main>

   </body>

   </html>