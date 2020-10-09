<?php
require_once("./Geo_Connection.php");
$db_handle = new DBController();
$query ="SELECT * FROM tbl_country";
$results = $db_handle->runQuery($query);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
    <label>Country:</label><br/>
    <select name="country" id="country-list" onChange="getState(this.value);">
    <option value disabled selected>Select Country</option>
    <?php
    foreach($results as $country) {
    ?>
    <option value="<?php echo $country["contryid"]; ?>"><?php echo $country["cname"]; ?></option>
    <?php
    }
    ?>
    </select>
    <br>
    <label>State:</label><br/>
    <select name="state" id="state-list"  onChange="getCity(this.value);">
    <option value="">Select State</option>
    </select>
    <br>
    <label>City:</label><br/>
    <select name="city" id="city-list" >
    <option value="">Select City</option>
    </select>
    </body>
</html>
