<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
    <meta name="Xingchen Liu" content="author name">
    <meta name="Mengmeng Ye" content="author name">
        
    <title>Mentor List</title>
    
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
        <!--show the following content when user does not login-->
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
        <!--show the following content when user successfully login-->
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

    <div>
      <!-- show username when user login-->
      <h1>Welcome <font color="green" style="font-style:italic"><?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?></font></h1>
    </div>

   
    <!--add list of mentors from mentor table in th edatabase-->
    <section class="all row">
      <div class="grid">
      <?php foreach ($mentors as $mentor): ?>
        <section class="content my-col-3">
          <a href="mentor_info.php?data[username]=<?php echo $mentor['username']; ?>&data[company]=<?php echo $mentor['company']; ?>&data[university]=<?php echo $mentor['university']; ?>&data[field]=<?php echo $mentor['field']; ?>&data[mentor_id]=<?php echo $mentor['mentor_id']; ?>&data[title]=<?php echo $mentor['title']; ?>">
            <img src="images/mentor1.jpg">
          </a>
          <h6><?php echo $mentor['username']; ?> </h6>
          <h6><?php echo $mentor['company']; ?> </h6>
          <h6><?php echo $mentor['field']; ?> </h6>
        </section>
        <?php endforeach; ?>

      </div>
    </section>

 
  </body>
</html>