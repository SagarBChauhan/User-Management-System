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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">    <link href="css/PROFILE.css" type="text/css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Admin - Home</title>
    <style>
        .card-footer a{
            border:transparent; 
            border-radius:10px; 
            padding: 5px; 
            color:white;
            box-shadow: 2px 2px 5px gray; 
           
        }
        .card-footer a:hover{
            transition: 1s;
            opacity: 1;
            border:transparent; 
            border-radius:10px; 
            padding: 5px; 
            color:white;
            box-shadow:  1px 1px 200px white, 0 0 25px white, 0 0 5px white;
            text-shadow: 1px 1px 200px white, 0 0 25px yellow, 0 0 5px white;          
        }
    </style>
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
        <div class="nav position-fixed flex-column nav-pills bg-light " id="v-pills-tab" role="tablist" aria-orientation="vertical" >
            <a class="nav-link " href="Home.php"><i class="fas fa-home"></i> Home</a>
            <a class="nav-link " href="New.php" ><i class="fas fa-user-plus"></i> New user</a>
            <a class="nav-link" href="Update.php"><i class="fas fa-user-edit"></i> Update user</a>
            <a class="nav-link active" href="View.php"><i class="fas fa-eye"></i> View user</a>
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
                        <div class="card-body">
                            <div class="container">                                
                                <div class="row justify-content-center">
                                    <a href="ViewTble.php">View in Table</a>
                                    <?php    
            include './Connection.php';
            if(isset($_GET['id']))
            {
                $sql_select="SELECT `Id`,`First_Name` ,`Middle_Name`,`Last_Name`, `Gender`, `Address`,"
                                            . "(SELECT tbl_country.cname from tbl_country where tbl_country.contryid=countryid) as `countryid`,"
                                            . " (SELECT tbl_state.Name from tbl_state where tbl_state.State_Id=sid) as `sid`,"
                                            . "(select tbl_city.Name FROM tbl_city where tbl_city.City_Id=cid)as `cid` , "
                                            . "`Pin_code`, `Date_of_birth`,`Email_Id`, `Profile_Photo`,"
                                            . " `Adharcard_number`, `Pancard_number`, MD5(`Password`) Password, `Insertted_on` FROM `tbl_usermaster` where Id=".$_GET['id'].";";
            }
            else {
                $sql_select="SELECT `Id`,`First_Name` ,`Middle_Name`,`Last_Name`, `Gender`, `Address`,"
                                            . "(SELECT tbl_country.cname from tbl_country where tbl_country.contryid=countryid) as `countryid`,"
                                            . " (SELECT tbl_state.Name from tbl_state where tbl_state.State_Id=sid) as `sid`,"
                                            . "(select tbl_city.Name FROM tbl_city where tbl_city.City_Id=cid)as `cid` , "
                                            . "`Pin_code`, `Date_of_birth`,`Email_Id`, `Profile_Photo`,"
                                            . " `Adharcard_number`, `Pancard_number`, MD5(`Password`) Password, `Insertted_on` FROM `tbl_usermaster` ;";     
            }
                $result=  mysqli_query($con, $sql_select);
                $count=1;
                while ($row=$result->fetch_assoc())
                {
                    $name= $row['First_Name']." ".$row['Middle_Name']." ".$row['Last_Name'];
                    if($row['Gender']=="M")
                    {
                        $gender="Male";
                        $sr="Mr.";
                    }
                    elseif ($row['Gender']=="F")
                    {
                        $gender="Female";
                        $sr="Mrs/Ms.";
                    }
                    $select_id=$row['Id'];
                    $country =$row['countryid'];
                    $state =$row['sid'];
                    $city =$row['cid'];
                    $pin=$row['Pin_code'];
                    $Date_of_birth=$row['Date_of_birth'];
                    $Address=$row['Address'];
                    $Profile_Photo=$row['Profile_Photo'];
                    $Adharcard_number=$row['Adharcard_number'];
                    $Pancard_number=$row['Pancard_number'];
                    $Insertted_on=$row['Insertted_on'];
            

        ?> 
                                    <div class="col-lg-6">                                  
                                        <div class="card hovercard">
                                            <div class="cardheader" style=" background:url('<?php echo $Profile_Photo;?>');background-size: cover; height: 250px;">
                                            </div>
                                            <div class="avatar">
                                            <?php if(isset($Profile_Photo)){?>
                                                <img alt="" src="<?php echo $Profile_Photo;?>"  style="object-fit: cover;">
                                            <?php }?>          
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    <a target="_blank" id="Name" href="#"><?php echo $sr." ".$name; ?></a>
                                                </div>
                                                <hr>
                                                <div class="desc"><strong>Date of Birth: </strong><?php echo $Date_of_birth; ?></div>
                                                <div class="desc"><strong>Address: </strong><?php echo $Address; ?></div>
                                                <div class="desc"><strong>Country: </strong><?php echo $country; ?></div>
                                                <div class="desc"><strong>State: </strong><?php echo $state; ?></div>
                                                <div class="desc"><strong>City: </strong><?php echo $city; ?></div>
                                                <div class="desc"><strong>Pin code: </strong><?php echo $pin; ?></div>
                                                <div class="desc"><strong>Aadhar Number: </strong><?php echo $Adharcard_number; ?></div>
                                                <div class="desc"><strong>Pan Number: </strong><?php echo $Pancard_number; ?></div>
                                                <div class="desc"><strong>Last Modified: </strong><?php echo $Insertted_on; ?></div>
                                            </div>
                                            <div class="card-footer">                                               
                                                <a class="btn btn-warning " href="Update.php?upid=<?php echo $select_id;?>"><i class="fas fa-user-edit"></i></a>
                                                <a class="btn btn-danger " href="Delete.php"><i class="fas fa-user-minus"></i></a>
                                            </div>
                                        </div>
                                  </div>

<!--                            <hr>-->
                        
    <?php
            
            }
    ?>                                </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        $(document).ready(
                function (){
                    $("div.container").hide();
                    alert("hidden");
                }
                $("a#view").hover(
                alert("Hovered");
            );
        );
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>