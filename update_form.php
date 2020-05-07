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
  <?php session_start(); ?>
    <!--set navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand">Mentor Consulting</a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <?php
          if (!isset($_SESSION['username'])) {
        ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <?php
              }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="get_list.php">Mentor List</a>
            </li>
        </ul>
      </div>
    </nav>

    <div class="update">
        <h3>Update Information</h3>
    </div>

    <!--error message-->
    <div>
      <h5 id="msg" class="mentor-msg"></h5>
    </div>


    <!--put the retrieved data into the update_form as current value-->
    <div class="info-form col-7">
      <form action="mentor_info.php" method="post">

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">University</label>
            <input class="form-control" name="university" value="<?php if (!empty($user_to_update)) echo $user_to_update['university'] ?>">
          </div>
          <div class="form-group col-md-4">
            <label for="inputPassword4">Study Field</label>
            <input class="form-control" name="field" value="<?php if (!empty($user_to_update)) echo $user_to_update['field'] ?>">
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">Degree</label>
            <select id="inputState" class="form-control" name = "degree">
              <option <?php if (!empty($user_to_update) && $user_to_update['degree']=="Bachelor's")
                  { ?> 
                     selected 
            <?php } ?>>Bachelor's</option>
              <option <?php if (!empty($user_to_update) && $user_to_update['degree']=="Master's")
                  { ?> 
                     selected 
            <?php } ?>>Master's</option>
            </select>
          </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Company</label>
              <input type = "text" class="form-control" name="company" value="<?php if (!empty($user_to_update)) echo $user_to_update['company'] ?>"/>
            </div>
            <div class="form-group col-md-4">
              <label for="inputPassword4">Title</label>
              <input type="text" class="form-control" name="title" value="<?php if (!empty($user_to_update)) echo $user_to_update['title'] ?>"/>
            </div>
            <div class="form-group col-md-4">
                <label>Phone</label>
                <input class="form-control" name="phone" value="<?php if (!empty($user_to_update)) echo $user_to_update['phone'] ?>"/>
            </div>  
        </div>
        

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Experience</label>
            <textarea class="form-control" rows="8" id="experience"></textarea>
        </div>


          <input type="hidden" name="mentor_id" value="<?php if (!empty($user_to_update)) echo $user_to_update['mentor_id'] ?>" />     
          <input type="submit" value="Update Information" name="action"  class="btn btn-primary" title="Update task" />   


      </form>


        </div>


  </body>
</html>