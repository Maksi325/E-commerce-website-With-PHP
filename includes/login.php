<?php include "db.php";
session_start();
?>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);


    $loginQuerry = "Select * from users Where username = '{$username}' AND user_password = '{$password}'";

    $result = mysqli_query($connection, $loginQuerry);

    $db_user_password;


    while ($row = mysqli_fetch_array($result)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_image = $row['user_image'];
        $db_user_email = $row['user_email'];
        $db_user_role = $row['role'];
    }
    if ($username === $db_username && $password === $db_user_password) { // Nese logohet 
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_password'] = $db_user_password;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_image'] = $db_user_image;
        $_SESSION['user_email'] = $db_user_email;
        $_SESSION['user_role'] = $db_user_role;
        if ($db_user_role === "admin") {
            header("Location: ../admin/");
        } elseif ($db_user_role === "user") {
            header("Location: ../user/");
        }
    } else { //Nese esht User coje tek home page 
        header("Location: ../login.php?e=e");
    }
} else {
    header("Location: ../login.php");
}

?>
