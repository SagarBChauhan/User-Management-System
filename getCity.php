<?php
require_once ("./Geo_Connection.php");
$db_handle = new DBController();
if (! empty($_POST["state_id"])) {
    $query = "SELECT * FROM tbl_city WHERE State_Id = '" . $_POST["state_id"] . "' order by name asc";
    $results = $db_handle->runQuery($query);
    ?>
<option value disabled selected>Select City</option>
<?php
    foreach ($results as $city) {
        ?>
<option value="<?php echo $city["City_Id"]; ?>"><?php echo $city["Name"]; ?></option>
<?php
    }
}
?>