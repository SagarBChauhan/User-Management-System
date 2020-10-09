<?php
ob_start();
//$uname="unknown";
    session_start();
    if(isset($_SESSION['uname']))
    {
        $uname= $_SESSION['uname'];
    }
    else 
    {
        echo"<script>window.location.href='index.php?error=Login_first';</script>";
    }
?> 
<?php
require_once("./Geo_Connection.php");
$db_handle = new DBController();
$query ="SELECT * FROM tbl_country";
$results = $db_handle->runQuery($query);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Admin - Home</title>
    <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
    <script>
    function getState(val) {
            $.ajax({
            type: "POST",
            url: "getState.php",
            data:'country_id='+val,
            success: function(data){
                    $("#state-list").html(data);
                    getCity();
            }
            });
    }


    function getCity(val) {
            $.ajax({
            type: "POST",
            url: "getCity.php",
            data:'state_id='+val,
            success: function(data){
                    $("#city-list").html(data);
            }
            });
    }
$(document).ready(function(){
   $("div#sub_form").hide();      
   $("#sub_captcha").click(
        function()
        {
            $("div#sub_form").show(1000);
            $("#cap").animate({
                right: '250px',
                opacity: '0.5',
                height: '0',
                width: ''
            });$
            $("#cap").hide(1500);
            $("#cap1").animate({
                right: '250px',
                opacity: '0.5',
                height: '0',
                width: ''
            });
            $("#cap1").hide(1500)
            $("#cap2").animate({
                right: '250px',
                opacity: '0.5',
                height: '0',
                width: ''
            });
            $("#cap2").hide(1500);
        }
    );
//  $("#sub_captcha").click(function(){
//    $("#sub_form").hide();
//  });
//  $("#show").click(function(){
//    $("p").show();
//  });
});
//$(document).ready
//(
//    function()
//    {
//    $(":submit#sub_form").hide();
//    $(":submit#sub_form").click(
//            function ()
//            {
//               // alert("checked");
//                 $(":submit#sub_form").show();
//            }
//            )
//    }
//    );
    </script>
  </head>
  <body>

        <div class="row">
            <div class="col-12">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute bg-light">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" ><i class="fab fa-artstation"></i> Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse justify-content-end">
                        <a class="navbar-brand" href="#"> <?php  echo $uname;?> <i class="fas fa-user-lock"></i> </a>
                        <ul class="navbar-nav">
                            <li>
                                <a class="navbar-brand" href="Logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            </div>
        </div>
    <div class="row">
      <div class="col-2">
        <div class="nav flex-column nav-pills bg-light " id="v-pills-tab" role="tablist" aria-orientation="vertical" >
            <a class="nav-link " href="Home.php"><i class="fas fa-home"></i> Home</a>
            <a class="nav-link active" href="New.php" ><i class="fas fa-user-plus"></i> New user</a>
            <a class="nav-link" href="Update.php"><i class="fas fa-user-edit"></i> Update user</a>
            <a class="nav-link" href="View.php"><i class="fas fa-eye"></i> View user</a>
            <a class="nav-link " href="Search.php"><i class="fas fa-search"></i> Search user</a>
            <a class="nav-link " href="Delete.php"><i class="fas fa-user-minus"></i> Delete user</a>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <a class="nav-link"></a>
        </div>
      </div>
      <div class="col-10">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" >  
            <div class="content mt-3 ml-n5 mr-n3">
                <div class="container-fluid">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header card-header-primary">
                          <h4 class="card-title">Add user</h4>
                          <p class="card-category">Complete profile</p>
                          <?php
                          include_once './Connection.php';
                              if ($_SERVER["REQUEST_METHOD"] == "POST") 
                              {
                                  if (isset($_POST["btn_Add"]))
                                  {
                                        
//                                        // the message
//                                        $msg = "First line of text\nSecond line of text";
//
//                                        // use wordwrap() if lines are longer than 70 characters
//                                        $msg = wordwrap($msg,70);
//
//                                        // send email
//                                        mail("someone@example.com","My subject",$msg);
                                        
                                      if($_POST["gender"]=="Male")
                                      {
                                          $gen="M";
                                      }
                                      elseif ($_POST["gender"]=="Female") 
                                      {
                                          $gen="F";
                                      }
                                      
                                      $fname=$_POST["fname"];
                                      $mname=$_POST["mname"];
                                      $lname=$_POST["lname"];
                                      $country=$_POST["country"];                                      
                                      $state=$_POST["state"];                                      
                                      $city=$_POST["city"];                                      
                                      $pin=$_POST["pin"];
                                      $address=$_POST["address"];
                                      $DOB=$_POST["DOB"];
                                      $email=$_POST["emailid"];
                                      //$contact=$_POST["contact"];
                                      $aadharNo=$_POST["aadharNo"];
                                      $panNo=$_POST["panNo"];
                                      $pass=$_POST["pass"];
                                      //$profile_pic=$_POST["profile_pic"];
                                      
                                      $file_name = $_FILES['profile_pic']['name'];
                                      $file_tmp = $_FILES['profile_pic']['tmp_name'];
                                      
                                      $target_file = "upload/".$file_name;
                                      move_uploaded_file($file_tmp, "upload/". $file_name);
                                      
                                      $query="INSERT INTO `tbl_usermaster`( `Email_Id`, `First_Name`, `Last_Name`, `Middle_Name`, `Gender`, `countryid`, `sid`, `cid`, `Pin_code`, `Date_of_birth`, `Address`, `Profile_Photo`, `Adharcard_number`, `Pancard_number`, `Password`, `Insertted_on`) VALUES ('$email','$fname','$lname','$mname','$gen',$country,$state,$city,'$pin','$DOB','$address','$target_file','$aadharNo','$panNo',MD5('$pass'),'".date("Y-m-d \t h-i-s")."');";
                                      $sql_insert = mysqli_query($con, $query);
                                      if ($sql_insert)
                                      {
                                          $last=$con->insert_id;

                                          echo "<p class='card-category text-success text-capitalize font-weight-bold'><i class='fab fa-connectdevelop'></i> Data Inserted <i class='fas fa-flag-checkered'></i></p>";
                                          header("location: View.php?id=".$last);
                                      }
                                      else
                                      {
                                          echo ("<p class='card-category  text-warning text-capitalize font-weight-bold'><i class='fab fa-connectdevelop'></i> Data Insertion Failed <i class='fas fa-times'></i></p>").  mysqli_error($con);
                                      }
                                  }         
                              }
                          ?>
                       </div>
                        <div class="card-body">
                          <form  method="Post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Fist Name</label>
                                  <input type="text" class="form-control" pattern="[A-Z]{3,}*" title="Firstname Must be at least 3 Character." placeholder="Fistame" name="fname" required>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Middel Name</label>
                                  <input type="text" class="form-control" pattern="[A-Z]{3,}*" title="Middelname Must be at least 3 Character." placeholder="Middelname" name="mname" required>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Last Name</label>
                                  <input type="text" class="form-control" pattern="[A-Z]{3,}*" title="Lastname Must be at least 3 Character." placeholder="Lastname"name="lname" required>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Gender</label><br>
                                  <input type="radio" name="gender" value="Male" required>Male
                                  <input type="radio" name="gender" value="Female" required>Female
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="bmd-label-floating">DOB</label>
                                  <input type="date" class="form-control" name="DOB" required>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Email address</label>
                                  <input type="email" class="form-control" pattern="^[a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z){2,3})$" placeholder="Email" title="Email sould be vaild" name="emailid" required>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Profile Photo</label>
                                  <input type="file" class="form-control" name="profile_pic" required>
                                </div>
                              </div>
<!--                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Contact number</label>
                                  <input type="text" class="form-control" name="contact">
                                </div>
                              </div>-->
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Address</label>
                                      <textarea name="address" class="form-control" placeholder="Address" rows="5" required></textarea>    
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-9">
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Country</label>                                        
                                        <select name="country" id="country-list" class="form-control" onChange="getState(this.value);" required>
                                        <option value disabled selected>Select Country</option>
                                        <?php
                                        foreach($results as $country) {
                                        ?>
                                        <option value="<?php echo $country["contryid"]; ?>"><?php echo $country["cname"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                  </div>                                  
                                    <div class="col-md-4">
                                    <div class="form-group">          
                                        <label class="bmd-label-floating">State</label>
                                        <select name="state" id="state-list" class="form-control" onChange="getCity(this.value);" required>
                                            <option value="">Select State</option>
                                        </select>                                       
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">City</label>
                                        <select name="city" class="form-control" id="city-list" required >
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Postal Code</label>
                                      <input type="text" class="form-control" placeholder="Pin code" maxlength="6" name="pin" required>
                                    </div>
                                  </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Aadhar card No</label>
                                  <input type="text" class="form-control" maxlength="12" placeholder="Aadhar number" name="aadharNo" required>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Pan card No</label>
                                  <input type="text" class="form-control" maxlength="12"name="panNo" placeholder="Pan number" required>
                                </div>
                              </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Password</label>
                                  <input type="password" class="form-control" placeholder="********" name="pass" required>
                                </div>
                              </div>    
<!--                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Confirm Password</label>
                                  <input type="password" class="form-control" name="conPass">
                                </div>
                              </div>-->
<!--                          <form action="getting.php" method="post" autocomplete="off">-->
                              <div class="col-md-3"  id="cap">
                                <div class="form-group">
                                    <img src="captcha.php" alt="Captcha Image"><br><br>
                                    <?php // include './captcha.php';?>
                                </div>
                              </div>
                              <div class="col-md-2"  id="cap1">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Confirm captcha</label>
                                    <input type="text" name="captcha" class="form-control" >
                                </div>
                              </div>                            
                              <div class="col-md-1"  id="cap2">
                                <div class="form-group">
                                    <label class="bmd-label-floating">.</label><br>
                                    <input type="button" value="Submit" class="mt-1 btn btn-danger btn-sm pull-right" id="sub_captcha">
                                </div>
                              </div>                            
                            </div>
<!--                            </form>-->
                            <div id="sub_form">
                                <button type="submit" class="btn btn-primary pull-right" name="btn_Add" >Add Profile <i class="fas fa-check"></i></button>
                            </div>
                            <div class="clearfix"></div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>     
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php
ob_end_flush();
?>