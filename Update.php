<?php
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
                        <a class="navbar-brand" href="#"> <?php echo $uname;?> <i class="fas fa-user-lock"></i> </a>
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
            <a class="nav-link " href="New.php" ><i class="fas fa-user-plus"></i> New user</a>
            <a class="nav-link active" href="Update.php"><i class="fas fa-user-edit"></i> Update user</a>
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
                          <h4 class="card-title">Update user</h4>
                          <p class="card-category">profile</p>
                          <?php
                          include_once './Connection.php';
                              if ($_SERVER["REQUEST_METHOD"] == "POST") 
                              {
                                  if (isset($_POST["btn_Update"]))
                                  {
                                      $user_id=$_POST["user_id"];
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
                                      $aadharNo=$_POST["aadharNo"];
                                      $panNo=$_POST["panNo"];
                                      /*
                                      $profile_pic=$_POST["profile_pic"];
                                      
                                      $file_name = $_FILES['profile_pic']['name'];
                                      $file_tmp = $_FILES['profile_pic']['tmp_name'];
                                      
                                      $target_file = "upload/".$file_name;
                                      move_uploaded_file($file_tmp, "upload/". $file_name);*/
                                      
                                      $query="UPDATE `tbl_usermaster` SET `First_Name`='$fname',`Last_Name`='$lname',`Middle_Name`='$mname',`Gender`='$gen',`countryid`='$country',`sid`='$state',`cid`='$city',`Pin_code`='$pin',`Date_of_birth`='$DOB',`Address`='$address',`Adharcard_number`='$aadharNo',`Pancard_number`='$panNo',`Insertted_on`='".date("Y-m-d \t h-i-s")."' WHERE id=$user_id;";
                                      $sql_insert = mysqli_query($con, $query);
                                      if ($sql_insert)
                                      {
                                          $last=$con->insert_id;

                                          echo "<p class='card-category text-success text-capitalize font-weight-bold'><i class='fab fa-connectdevelop'></i> Data Updated <i class='fas fa-flag-checkered'></i></p>";
                                          header("location:view.php?id=".$user_id);
                                      }
                                      else
                                      {
                                          echo ("<p class='card-category  text-warning text-capitalize font-weight-bold'><i class='fab fa-connectdevelop'></i> Data updation Failed <i class='fas fa-times'></i></p>").  mysqli_error($con);
                                      }
                                  }         
                              }
                          ?>
                       </div>
                        <div class="card-body">

                            <?php
                            if(isset($_GET['upid']))
                            {
                                $id=$_GET["upid"];
                            }
                            if(isset($_POST['btn_Fetch'])|isset($_GET['upid']))
                            {
                                if(!isset($_GET['upid'])){
                                    $id=$_POST['email1'];
                                }
                                $sql_email="SELECT `Id`, `Email_Id`, `First_Name`, `Last_Name`, `Middle_Name`, `Gender`, `countryid`, `sid`, `cid`, `Pin_code`, `Date_of_birth`, `Address`, `Profile_Photo`,`Adharcard_number`, `Pancard_number`, `Password`, `Insertted_on` FROM `tbl_usermaster` WHERE `Id`=$id ";
                                $result_email= mysqli_query($con, $sql_email);
                                
                                if($result_email->num_rows>0){
                                    while ($row = $result_email->fetch_assoc())
                                    {  
                                      $uid=$row["Id"];
                                      $fname=$row["First_Name"];
                                      $mname=$row["Middle_Name"];
                                      $lname=$row["Last_Name"];
                                      $gender=$row["Gender"];
                                      $country=$row["countryid"];                                      
                                      $state=$row["sid"];                                      
                                      $city=$row["cid"];                                      
                                      $pin=$row["Pin_code"];
                                      $address=$row["Address"];
                                      $DOB=$row["Date_of_birth"];
                                      $email=$row["Email_Id"];
                                     // $contact=$row["contact"];
                                      $aadharNo=$row["Adharcard_number"];
                                      $panNo=$row["Pancard_number"];
                                      //$pass=$row["pass"];
                                      //$profile_pic=$_POST["Profile_Photo"];
                                      
                                      //$file_name = $_FILES['profile_pic']['name'];
                                      //$file_tmp = $_FILES['profile_pic']['tmp_name'];
                                      
                                     // $target_file = "upload/".$file_name;
                                    }
                                }
                            }          
                            ?>
                            <form  method="Post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Email</label>

                                    <select class="form-control" name = 'email1' required>
                                        <option ></option> 
                                          <?php
                                          include './Connection.php';
                                          $sql_email="SELECT Id,`Email_Id` FROM `tbl_usermaster`;";
                                          $result_email= mysqli_query($con, $sql_email);

                                          if($result_email->num_rows>0){
                                              while ($row = $result_email->fetch_assoc())
                                              {      
                                                  echo"<option value='".$row["Id"]."' ";                                                  
                                                  if(isset($_POST['btn_Fetch'])|isset($_GET['upid']))
                                                  {
                                                    if ($row["Id"]==$uid)
                                                    {
                                                        echo "selected";
                                                    }                                                  
                                                  }
                                                  echo">".$row["Email_Id"]."</option>";

                                              }
                                          } 
                                          ?>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="bmd-label-floating">.</label><br>
                                      <button type="submit" class="btn btn-primary pull-right" name="btn_Fetch">Fetch <i class="fas fa-bolt"></i></button>
                                  </div>
                                </div>
                            </div>
                            </form>
                            <?php
                            if(isset($_POST['btn_Fetch'])|isset($_GET['upid']))
                            {?>
                            <form  method="Get" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <input type="hidden" name="user_id" value=<?php echo $uid;?> />
                                    <label class="bmd-label-floating">Fist Name</label>
                                    <input type="text" class="form-control" name="fname" value="<?php echo  $fname;?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Middel Name</label>
                                    <input type="text" class="form-control" name="mname" value="<?php  echo  $mname; ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="<?php  echo  $lname; ?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Gender</label><br>
                                    <?php
                                     if($gender=="M")
                                     {
                                        echo "<input type='radio' name='gender' value='Male'  Checked required>Male "
                                         . "<input type='radio' name='gender' value='Female' required>Female ";                                       
                                     }
                                     elseif ($gender=="F") 
                                     {
                                        echo "<input type='radio' name='gender' value='Male'  required>Male "
                                         . "<input type='radio' name='gender' value='Female' Checked required>Female ";
                                     }
                                    ?>

                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">DOB</label>
                                    <input type="date" class="form-control" name="DOB" value="<?php  echo  $DOB; ?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Email address</label>
                                    <input type="email" class="form-control" name="emailid" value="<?php  echo  $email; ?>" disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Address</label>
                                        <textarea name="address" class="form-control" rows="5"><?php  echo  $address; ?>
                                        </textarea>    
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Country</label>

                                        <select name="country" id="country-list" class="form-control" onChange="getState(this.value);">                                              
                                              <?php
                                              $sql_country="SELECT `contryid`, `cname` FROM `tbl_country` ORDER BY cname ;";

                                              $result_country= mysqli_query($con, $sql_country);
                                              if($result_country->num_rows>0){
                                                  while ($row = $result_country->fetch_assoc())
                                                  {      
                                                      echo"<option value='".$row["contryid"]."'";
                                                      if($row["contryid"]==$country)
                                                      {
                                                          echo "selected";
                                                      }
                                                      echo">".$row["cname"]."</option>";

                                                  }
                                              } 
                                              ?>
                                                
                                          </select>
                                      </div>
                                    </div>                                  
                                      <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">State</label>

                                          <select name="state" id="state-list" class="form-control" onChange="getCity(this.value);">
                                              <option  value="<?php  echo  $state; ?>"></option> 
                                              <?php
                                              $sql_state="SELECT `State_Id`, `Name`, `Country_Id` FROM `tbl_state` where Country_Id=$country ORDER BY Name ";
                                              $result_state= mysqli_query($con, $sql_state);

                                              if($result_state->num_rows>0){
                                                  while ($row = $result_state->fetch_assoc())
                                                  {      
                                                      echo"<option value='".$row["State_Id"]."'";
                                                      if($row["State_Id"]==$state)
                                                      {
                                                          echo "selected";
                                                      }
                                                      echo ">".$row["Name"]."</option>";
                                                  }
                                              } 
                                              ?>
                                              
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">City</label>

                                          <select name="city" class="form-control" id="city-list">
                                              
                                              <?php
                                              $sql_city="SELECT `City_Id`, `Name`, `State_Id` FROM `tbl_city`  where State_Id=$state ORDER BY Name;";
                                              $result_city= mysqli_query($con, $sql_city);

                                              if($result_city->num_rows>0){
                                                  while ($row = $result_city->fetch_assoc())
                                                  {      
                                                      echo"<option value='".$row["City_Id"]."'";
                                                      if($row["City_Id"]==$city)
                                                      {
                                                          echo "selected";
                                                      }    
                                                      echo">".$row["Name"]."</option>";
                                                  }
                                              } 
                                              ?>
                                              <option  value="<?php  echo  $city; ?>"></option> 
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Postal Code</label>
                                        <input type="text" class="form-control" name="pin" value="<?php  echo  $pin; ?>">
                                      </div>
                                    </div>
<!--                                    <div class="col-md-8">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Profile Photo</label>
                                        <input type="file" class="form-control" name="profile_pic"  value="<?php//  echo  $profile_pic; ?>">
                                      </div>
                                    </div>-->                                
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Aadhar card No</label>
                                    <input type="text" class="form-control" name="aadharNo" value="<?php  echo  $aadharNo; ?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Pan card No</label>
                                    <input type="text" class="form-control" name="panNo" value="<?php  echo  $panNo; ?>">
                                  </div>
                                </div>
                                  </div>
                                </div>
                              </div>
<!--                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Password</label>
                                    <input type="password" class="form-control" name="pass">
                                  </div>
                                </div>    
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Confirm Password</label>
                                    <input type="password" class="form-control" name="conPass">
                                  </div>
                                </div>
                              </div>-->
                                <button type="submit" class="btn btn-primary pull-right" name="btn_Update">Update Profile <i class="fas fa-check"></i></button>
                              <div class="clearfix"></div>
                            </form>
                            <?php
                            }
                            ?>
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
<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>