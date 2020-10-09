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
                                <table class="table table-hover ">
                                  <thead class="thead-dark">
                                    <tr>
                                <?php
                                $sql_Fetch_table="SELECT `Id`,`First_Name` ,`Middle_Name`,`Last_Name`, `Gender`, `Address`,"
                                        . "(SELECT tbl_country.cname from tbl_country where tbl_country.contryid=countryid) as `Country`,"
                                        . " (SELECT tbl_state.Name from tbl_state where tbl_state.State_Id=sid) as `State`,"
                                        . "(select tbl_city.Name FROM tbl_city where tbl_city.City_Id=cid)as `City` , "
                                        . "`Pin_code` as Pin, `Date_of_birth` as Birthdate,`Email_Id` as `E-mail`, `Profile_Photo` as Picture,"
                                        . " `Adharcard_number` as Aadhar, `Pancard_number` As Pan, MD5(`Password`) Password, `Insertted_on` FROM `tbl_usermaster`";
                                $result=  mysqli_query($con, $sql_Fetch_table);
//                                while ($row < mysql_num_fields($result) )
//                                {               
//                                    $meta = mysql_fetch_field($result, $row);
//                                    echo "<th scope='col'>$meta->Name</th>";
//                                    $row = $row + 1;
//                                }
                                    echo "<th scope='col'>#</th>";
                                    echo "<th scope='col'> <i class='fas fa-trash-alt'></i></th>";
                                    echo "<th scope='col'>Remove</th>";
                                    echo "<th scope='col'>Name</th>";
//                                    echo "<th scope='col'>Gender</th>";
//                                    //echo "<th scope='col'>Adress</th>";
//                                    echo "<th scope='col'>Country</th>";
//                                    echo "<th scope='col'>State</th>";
//                                    echo "<th scope='col'>City</th>";
//                                    echo "<th scope='col'>Pin</th>";
//                                    echo "<th scope='col'>Birthdate</th>";
                                    echo "<th scope='col'>E-Mail</th>";
//                                    echo "<th scope='col'>Picture</th>";
//                                    echo "<th scope='col'>Aadhar</th>";
//                                    echo "<th scope='col'>Pan</th>";
//                                    echo "<th scope='col'>Password</th>";
                                    //echo "<th scope='col'>Last update</th>";
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
                                            . "<td> <input type='checkbox' name='MDel_id[]' value='".$row['Id']."' /></td>"
                                            . "<td> <a class='text-danger mt-1 ml-3' id='remove' href='Delete.php?del_id=".$row['Id']."'><i class='fas fa-user-minus'></i></a></td>"
//                                            ."<input type='hidden' name='did' id='did' value='".$row['Id']."' />"
                                            . "<td>".$row['First_Name']." ".$row['Middle_Name']." ".$row['Last_Name']."</td>"
//                                            . "<td>".$gender."</td>"
                                            //. "<td>".$row['Address']."</td>"
//                                            . "<td>".$row['Country']."</td>"
//                                            . "<td>".$row['State']."</td>"
//                                            . "<td>".$row['City']."</td>"
//                                            . "<td>".$row['Pin']."</td>"
//                                            . "<td>".$row['Birthdate']."</td>"
                                            . "<td>".$row['E-mail']."</td>"
//                                            . "<td>".$row['Picture']."</td>"
//                                            . "<td>".$row['Aadhar']."</td>"
//                                            . "<td>".$row['Pan']."</td>"
//                                            . "<td>".$row['Password']."</td>"
                                            //. "<td>".$row['Insertted_on']."</td>"
                                       . "</tr>";
                                    $count=$count+1;
                                }
                                ?>
                                  </tbody>
                                </table>  