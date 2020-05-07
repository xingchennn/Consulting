<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
    <meta name="Xingchen Liu" content="author name">
    <meta name="Mengmeng Ye" content="author name">
        
    <title>Mentor Detailed Information</title>
    
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
  </head>

  <body>
  <?php session_start(); ?>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand">Mentor Consulting</a>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          <?php
          if (!isset($_SESSION['username'])) {
        ?>
            <li class="nav-item">
              <a class="nav-link" href="choose.html">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <?php
              }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="get_list.php">Mentor List</a>
            </li>
            <?php
              if (isset($_SESSION['username'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            <?php
              }
            ?>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

    <?php 
      require("connect_db.php"); 
      $mentor = $_GET["data"];
    ?>
    <!--show the mentor information from $mentor array that is get from thr previous page-->
    <section class = "detail">
        <div class = "mentor-photo">
            <img src="images/mentor1.jpg">
        </div>
        <div class= "mentor-info">
            <h6> Name: <?php echo $mentor['username']; ?> </h6>
            <h6> Education: <?php echo $mentor['university']; ?> </h6>
            <h6> Field: <?php echo $mentor['field']; ?> </h6>
            <h6> Company: <?php echo $mentor['company']; ?> </h6>
            <h6> Position: <?php echo $mentor['title']; ?>  </h6>
            <!-- <h6> Rating: 5 </h6>
            <h6> Reviews: </h6> -->

            <!-- if the user is a mentor, show the buttopn that can be clicked on to update the information-->
            <?php
              if (isset($_SESSION['username']) &&  $_SESSION['role'] == 1) {
            ?>
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="submit" value="Update Information" name="action" class="btn btn-primary" />  
                <input type="hidden" name="mentor_id" value="<?php echo $mentor['mentor_id'] ?>" />
              </form>
            <?php
              }
            ?>
        </div>
         
    </section>

    <section>
        <div class="consult-time">
            <h4> Available consulting time</h4>
            <a href="http://localhost:4200?data[mentor_id]=<?php echo $mentor['mentor_id']; ?>">
                <input type="submit" value="See available times" name="action" class="btn btn-primary" />  
            </a>
        </div>
    </section>
    

  </body>

</html>
