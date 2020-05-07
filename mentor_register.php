<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
    <meta name="Xingchen Liu" content="author name">
    <meta name="Mengmeng Ye" content="author name">
        
    <title>Mentor Register</title>
    
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
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="get_list.php">Mentor List</a>
            </li>
        </ul>
      </div>
    </nav>

    <div class="update">
        <h3>Mentor Register</h3>
    </div>

    <!--error message-->
    <div>
      <h5 id="msg" class="mentor-msg"></h5>
    </div>

    <!--register info-->
    <div class="info-form col-7">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <!-- <div class="form-row">
          <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="First name" id="first_name">
          </div>
          <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Last name" id="last_name">
          </div>
        </div> -->
  
        <div class="form-row">
        <div class="form-group col-md-4">
              <label>Username</label>
              <input class="form-control" name = "username">
          </div>
          <div class="form-group col-md-4">
            <label>Email Address</label>
            <input type="email" class="form-control" id="email" name = "email">
          </div>
          <div class="form-group col-md-4">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name = "password">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label>University</label>
            <input class="form-control" name="university">
          </div>
          <div class="form-group col-md-4">
            <label>Study Field</label>
            <input class="form-control" name="field">
          </div>
          <div class="form-group col-md-4">
            <label>Degree</label>
            <select id="inputState" class="form-control" name = "degree">
              <option selected>Bachelor's</option>
              <option>Master's</option>
            </select>
          </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
              <label>Company</label>
              <input class="form-control" name="company">
            </div>
            <div class="form-group col-md-4">
              <label>Title</label>
              <input class="form-control" name="title">
            </div>
            <div class="form-group col-md-4">
                <label>Phone</label>
                <input class="form-control" name="phone">
            </div>  
        </div>
        

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Experience</label>
            <textarea class="form-control" rows="8" id="experience"></textarea>
        </div>

        <input type="submit" class="btn btn-primary" id="register"  value="register" name="action"/>
      </form>

      <?php 
          require("connect_db.php");
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])) {
              if (!empty($_POST['action']) && $_POST['action'] == 'register') {
      
                $email = $_POST['email'];
                $pwd = $_POST['password'];
                $username = $_POST['username'];
                $is_mentor = 1;
                $university = $_POST['university'];
                $field = $_POST['field'];
                $degree = $_POST['degree'];
                $company = $_POST['company'];
                $title = $_POST['title'];
                $phone = $_POST['phone'];
              
                $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);
                // add username, email and pwd to user_info table
                add_user($username, $email, $hash_pwd, $is_mentor);
                // add detailed information of mentor into mentor table
                add_mentor($username, $email, $university, $field, $degree, $company, $title, $phone);
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

          function add_mentor($username, $email, $university, $field, $degree, $company, $title, $phone)
          {
              global $db;
              $query = "INSERT INTO mentor (username, email, university, field, degree, company, title, phone) VALUES (:username, :email, :university, :field, :degree, :company, :title, :phone)";

              $statement = $db->prepare($query);
              $statement->bindValue(':username', $username);
              $statement->bindValue(':email', $email);
              $statement->bindValue(':university', $university);
              $statement->bindValue(':field', $field);
              $statement->bindValue(':degree', $degree);
              $statement->bindValue(':company', $company);
              $statement->bindValue(':title', $title);
              $statement->bindValue(':phone', $phone);
              $statement->execute();
              $statement->closeCursor();

          }

      ?>    

    </div>


    <!--check whether the info is correct and valid-->
    <!-- <script>
      var blank = function(p_id) {
        if (document.getElementById(p_id).value.length == 0) {
          return true;
        }
      }

      var check_length = p_id => {
        if (document.getElementById(p_id).value.length < 8) {
          return true;
        }
      }

      function check_blank() {
        var msg = document.getElementById("msg");
        if (blank("first_name") || blank("last_name") || blank("email") || blank("password") || blank("university") || blank("field") || blank("experience") || blank("company") || blank("title") || blank("phone")) {
          msg.textContent = "Cannot leave blank!";
        }
        else if (check_length("password")) {
          msg.textContent = "Password is not strong enough!";
        }
        else {
          window.location.href="list.html";
        }
      }
    </script> -->
  </body>
</html>