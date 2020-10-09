<?php
    $flag_error=0;
    session_start();
    include './Connection.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usName= $_POST["uname"];
        $pass =$_POST["pass"];

        $sql="SELECT * FROM `tbl_adminmaster` WHERE `username`='".$usName."' AND `password`='".$pass."' ";
        $result=$con->query($sql);
        if ($con->affected_rows >0)
        {
            $_SESSION['uname']=$usName;
            header("location:Home.php");
        }
        else 
        {
            $flag_error=1;
        }
    }
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Login</title>
    <style>
        html,
        body {
          height: 100%;
        }

        body {
          display: -ms-flexbox;
          display: flex;
          -ms-flex-align: center;
          align-items: center;
          padding-top: 40px;
          padding-bottom: 40px;
          background-color: #f5f5f5;
        }

        .form-signin {
          width: 100%;
          max-width: 400px;
          padding: 15px;
          margin: auto;
          box-shadow: 3px 3px 20px 3px gainsboro;
          border-radius: 5px;
        }
        .form-signin .checkbox {
          font-weight: 400;
        }
        .form-signin .form-control {
          position: relative;
          box-sizing: border-box;
          height: auto;
          padding: 10px;
          font-size: 16px;
        }
        .form-signin .form-control:focus {
          z-index: 2;
        }
        .form-signin input[type="email"] {
          margin-bottom: -1px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-light fixed-top bg-light flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">User Management</a>
<!--      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>-->
    </nav>
    <form class="form-signin" method="Post">
        <center><img class="mb-4 rounded-circle shadow" src="upload/download.jpg" alt="" height="150px;"></center>
<!--      <h1 class="h3 mb-3 font-weight-normal ">Please sign in</h1>-->
      <label for="inputEmail" class="sr-only">User name</label>
      <input name="uname" type="text" class="form-control shadow <?php if($flag_error==1){ echo "text-danger"; }else{echo "text-Primary";} ?> mb-3" placeholder="User name" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input name="pass" type="password" id="inputPassword" class="form-control <?php if($flag_error==1){ echo "text-danger"; }else{echo "text-Primary";} ?>  shadow" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class='btn btn-lg <?php if($flag_error==1){ echo "btn-danger"; }else{echo "btn-Primary";} ?> btn-block shadow' type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>
    </form>
    <?php echo "<script>alert('Incorrect Username or password')</script>"; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>