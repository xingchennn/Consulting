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
      <span class="msg"><?php echo $error_msg ?></span>
    </section>


  </body>

</html>
