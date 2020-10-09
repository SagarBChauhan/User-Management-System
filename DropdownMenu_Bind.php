<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="ajaxData.php"></script>
<?php
include './Connection.php';
?>


<select name = 'Country' id="country">
<option value=""></option> 
<?php
$sql="SELECT `contryid`, `cname` FROM `tbl_country`;";
$result= mysqli_query($con, $sql);

if($result->num_rows>0){
    while ($row = $result->fetch_assoc())
    {      
        echo"<option value='".$row["contryid"]."'>".$row["cname"]."</option>";
    }
} 
?>
</select>

<select id="state">
    <option value="">Select country first</option>
</select>

<select id="city">
    <option value="">Select state first</option>
</select>
