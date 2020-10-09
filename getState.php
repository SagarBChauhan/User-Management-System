<?php
require_once ("./Geo_Connection.php");
$db_handle = new DBController();
if (! empty($_POST["country_id"])) {
    $query = "SELECT * FROM tbl_state WHERE Country_Id = '" . $_POST["country_id"] . "'";
    $results = $db_handle->runQuery($query);
    ?>
<option value disabled selected>Select State</option>
<?php
    foreach ($results as $state) {
        ?>
<option value="<?php echo $state["State_Id"]; ?>"><?php echo $state["Name"]; ?></option>
<?php
    }
}
?>