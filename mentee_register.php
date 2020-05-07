<?php 
  require("connect_db.php");
  $error_msg = "";
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['username'])) {
      $error_msg = "Please enter username";
    }
    else if (empty($_POST['email'])) {
      $error_msg = "Please enter email";
    }
    else if (empty($_POST['password'])) {
      $error_msg = "Please enter password";
    }
    else if (strlen($_POST['password']) < 8) {
      $error_msg = "Password is not strong enough";
    }
    else if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])) {
      if (!empty($_POST['action']) && $_POST['action'] == 'register') {

        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $username = $_POST['username'];
        $is_mentor = 0;
  
        $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);
        // add mentor user information into user_info table
        add_user($username, $email, $hash_pwd, $is_mentor);
        header('Location: get_list.php');

      }
    }
  }

  
  function add_user($username, $email, $pass_word, $is_mentor)
  {
      global $db;
      $query = "INSERT INTO user_info (username, email, password, is_mentor) VALUES (:username, :email, :pass_word, :is_mentor)";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':email', $email);
      $statement->bindValue(':pass_word', $pass_word);
      $statement->bindValue(':is_mentor', $is_mentor);
      $statement->execute();
      $statement->closeCursor();
  
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
        
    <title>Mentee Register</title>
    
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
  </head>

  <!--check whether the register info is correct-->
  <!-- <script type="text/javascript">
          function myFunction(form) {
            var email = form.email.value;
            var password = form.password.value;
            var msg = document.getElementById("msg");
            if (email.length == 0 || password.length == 0) {
              msg.textContent = "Cannot leave blank!";
              return false;
            }
            else if (password.length < 8) {
              msg.textContent = "Password is not strong enough!";
              return false;

            }
            return true;
            return false;

          });
    </script> -->

  <body>


    <!--set navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand">Mentor Consulting</a>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="get_list.php">Mentor List</a>
                </li>
            </ul>
          </div>
    </nav>


    <!--mentee register form-->
    <section class="login">
      <div class="title">
        <h1> Mentee Register </h1>
      </div>

      <div>
        <h5 id="msg" class="mentee-msg"></h5>
      </div>
      <div class="login-form-div">

        <!-- <form class = "login-form col-7 name-form">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" class="form-control" placeholder="First name" id="first_name" name = "first_name">
            </div>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" placeholder="Last name" id="last_name" name = "last_name">
            </div>
          </div>
        </form> -->

        <form class="login-form col-7" aaction="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="form-group">
            <label for="username" class="form-word">Username</label>
            <input type="username" class="form-control" name = "username">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1" class="form-word">Email address</label>
            <input type="email" class="form-control" id="email" name = "email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name = "password">
          </div>
          <div>
          <span class="msg"><?php echo $error_msg ?></span>
          </div>
          <input type="submit" class="btn btn-primary" id="register" value="register" name="action"/>
        </form>


      </div>
    </section>


    
  </body>

</html>
