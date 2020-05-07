<?php
require("connect_db.php");

$error_msg = "";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['email']) && isset($_GET['password'])) {
        $email = $_GET['email'];
        $pwd = $_GET['password'];
        // get corrsponding information in the user_info table with given email
        $info = get_db($email);

        // verify whether the pwd entered satisfy the data in the user_info database
        if (password_verify($pwd, $info['password'])){
            // if satisfy, login and start session object and store user information
            $_SESSION['email'] = $email;
            $_SESSION['pwd'] = $info['password'];
            $_SESSION['username'] = $info['username'];
            $_SESSION['role'] = $info['is_mentor'];
            header('Location: get_list.php');
        }
        else {
            // if not, provide error message
            $error_msg =  "Wrong password";
        }

    }
}


function get_db($email) {
    global $db;
    $query = "SELECT * FROM user_info where email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $results = $statement->fetch();
    $statement->closecursor();

    return $results;
}
?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
    <meta name="Xingchen Liu" content="author name">
    <meta name="Mengmeng Ye" content="author name">
        
    <title>Login</title>
    
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
  </head>

  <body>
    <!--set navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand">Mentor Consulting</a>
  
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="choose.html">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="get_list.php">Mentor List</a>
          </li>
        </ul>
      </div>
    </nav>

    <!--login form-->
    <section class="login">
      <div class="title">
        <h1> Login </h1>
      </div>
  
      <div class="login-form-div">
        <form class="login-form col-7" action="login.php" method="get">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name = "email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1", name = "password">
          </div>
            <input type="submit" class="btn btn-primary" />
        </form>
      </div>
      <span class="msg"><?php echo $error_msg; ?></span>
    </section>


</body>
</html>