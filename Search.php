<?php
    require_once './Connection.php';
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Admin - Home</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
                <div class="/*collapse navbar-collapse*/ justify-content-end">
                    <ul class="navbar-nav">
                        <li>                        
                            <a class="navbar-brand" href="#"> <?php echo $uname;?> <i class="fas fa-user-lock"></i> </a>
                        </li>
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
            <a class="nav-link" href="Update.php"><i class="fas fa-user-edit"></i> Update user</a>
            <a class="nav-link" href="View.php"><i class="fas fa-eye"></i> View user</a>
            <a class="nav-link active" href="Search.php"><i class="fas fa-search"></i> Search user</a>
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
                          <h4 class="card-title">Search</h4>
                          <p class="card-category">User</p>
                       </div>
                        <div class="card-body">
                            <form  method="post" action=""  class="form-inline" id="searchform"> 
                                <input  class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="name"> 
                                <button  type="submit" name="submit" value="Search " class="btn btn-primary pull-right">Search <i class="fas fa-search"></i></button>
                            </form> 
 <?php
if(isset($_POST['submit'])&&$_POST['name'])
{?>
    <div class="row">
        <div class="col-12" >
        <div class="table-responsive">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
            <?php
            $sql_Fetch_table="SELECT `Id`,`First_Name` ,`Middle_Name`,`Last_Name`, `Gender`, `Address`,"
                    . "(SELECT tbl_country.cname from tbl_country where tbl_country.contryid=countryid) as `Country`,"
                    . " (SELECT tbl_state.Name from tbl_state where tbl_state.State_Id=sid) as `State`,"
                    . "(select tbl_city.Name FROM tbl_city where tbl_city.City_Id=cid)as `City` , "
                    . "`Pin_code` as Pin, `Date_of_birth` as Birthdate,`Email_Id` as `E-mail`, `Profile_Photo` as Picture,"
                    . " `Adharcard_number` as Aadhar, `Pancard_number` As Pan, MD5(`Password`) Password, `Insertted_on` FROM `tbl_usermaster` WHERE`First_Name` Like '".$_POST['name']."%'";
            $result=  mysqli_query($con, $sql_Fetch_table);
                echo "<th scope='col'>#</th>";
                echo "<th scope='col'>View</th>";
//                echo "<th scope='col'>Remove</th>";
                echo "<th scope='col'>Name</th>";
//                echo "<th scope='col'>Gender</th>";
//                echo "<th scope='col'>Adress</th>";
//                echo "<th scope='col'>Country</th>";
//                echo "<th scope='col'>State</th>";
//                echo "<th scope='col'>City</th>";
//                echo "<th scope='col'>Pin</th>";
//                echo "<th scope='col'>Birthdate</th>";
                echo "<th scope='col'>E-Mail</th>";
//                echo "<th scope='col'>Picture</th>";
//                echo "<th scope='col'>Aadhar</th>";
//                echo "<th scope='col'>Pan</th>";
//                echo "<th scope='col'>Password</th>";
//                echo "<th scope='col'>Last update</th>";
            ?>
                 </tr>
              </thead>
              <tbody>

            <?php
            $count=1;
            while ($row=$result->fetch_assoc())
            {   if($row['Gender']=="M")
                {$gender="Male";}
                else
                {$gender="Female";}
                echo "<tr>"
                . "<th scope='row'>$count</th>"
//                      . "<td> <a class='btn btn-danger btn-sm' id='remove' href='Delete.php?del_id=".$row['Id']."'><i class='fas fa-user-minus'></i></a></td>"
                        ."<input type='hidden' name='did' id='did' value='".$row['Id']."' />"
                        ."<td> <a class='' href='View.php?id=".$row['Id']."'><div class='text-dark mt-1 ml-2'><i class='fas fa-eye'></i></div></a></td>"
                        . "<td>".$row['First_Name']." ".$row['Middle_Name']." ".$row['Last_Name']."</td>"
//                        . "<td>".$gender."</td>"
//                        . "<td>".$row['Address']."</td>"
//                        . "<td>".$row['Country']."</td>"
//                        . "<td>".$row['State']."</td>"
//                        . "<td>".$row['City']."</td>"
//                        . "<td>".$row['Pin']."</td>"
//                        . "<td>".$row['Birthdate']."</td>"
                        . "<td>".$row['E-mail']."</td>"
//                        . "<td>".$row['Picture']."</td>"
//                        . "<td>".$row['Aadhar']."</td>"
//                        . "<td>".$row['Pan']."</td>"
//                        . "<td>".$row['Password']."</td>"
//                        . "<td>".$row['Insertted_on']."</td>"
                   . "</tr>";
                $count=$count+1;
            }
            ?>
              </tbody>
            </table>  
        </div>
        </div>
    </div>

<?php
}
?>                         </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>