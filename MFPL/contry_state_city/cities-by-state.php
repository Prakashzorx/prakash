<?php
require_once "../controller/functions.php";
$state_id = $_POST["state_id"];
$result = getCities($state_id);
?>
<option value=""></option>
<?php
foreach ($result as $row) {
    //print_r($result);
?>
    <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
<?php
}
?>